<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Expertise;
use App\Appointment;
use Redirect;
use Carbon;
use Mail;
use App\Email;
/**
 * @Middleware("auth")
 */
class AppointmentController extends Controller
{
  private $user;

  public function __construct()
  {
    $this->user = Auth::user();
  }

  /**
   * Go to request call page
   * The 'username' in below url is the username of an expert
   * @Get("/call/request/{username}", as="precall")
   */
  public function index(Request $request, $username)
  {
    //Get all expertises of the user recieved from the url(the username)
    $expertises       = User::whereUsername($username)->firstOrFail()->expertise()->get();
    $data             = new \stdClass;
    $data->user       = $this->user;
    $data->expertuser = $expertises->first()->user;
    $data->expertises = $expertises->lists('title', 'id');
    $data->callLength = \Config::get('monster_call.callLength');

    //dd($data);
    return view('appointment.index', compact('data'));
  }

  /**
   * Go to request call page
   * @Post("/call/request", as="save_precall")
   */
  public function store(Request $request)
  {
          $this->validate($request, $this->user->requestAppointmentRules);

          $user   = $this->user;
          $appointment = new Appointment;
          $appointment->requester_id = $user->id;
          $appointment->expert_id = $request->get('id');
          $appointment->message = $request->get('message');
          $appointment->requested_call_length = $request->get('call_length');
          $date1  = $request->get('date1');
          $time1  = $request->get('time1');
          $date2  = $request->get('date2');
          $time2  = $request->get('time2');
          $date3  = $request->get('date3');
          $time3  = $request->get('time3');
          $appointment->time_preference_1 = $this->parseRawStringIntoDateTime($date1, $time1);
          $appointment->time_preference_2 = $this->parseRawStringIntoDateTime($date2, $time2);
          $appointment->time_preference_3 = $this->parseRawStringIntoDateTime($date3, $time3);
          $appointment->expertise_id = $request->get('expertise_id');
          $appointment->save();
          $this->notifyExpert($appointment);
          return view('appointment.success');
          // TODO: Redirect user to the page after submission of form
          // return redirect()
          //         ->action('BrowseController@category')
          //         ->with('flash_message', ucwords('call request successfully saved.'));
  }

  private function parseRawStringIntoDateTime($date = '' , $time = '', $format  = 'Y/m/d H:i:s')
  {
    if (isset($date, $time)) {
      return Carbon\Carbon::parse($date. " " . $time)->format($format);
    }
      return Carbon\Carbon::now()->format($format);
  }

  protected function notifyExpert($appointment)
  {
    $expert = User::whereId($appointment->expert_id)->get()->first();
    $requesteruser = User::whereId($appointment->requester_id)->get()->first();
    $email = Email::getAppointmentRequestEmail();
    $data             = new \stdClass;
    $data->mail =$email;
    $data->expert = $expert;
    $data->user = $requesteruser;
    $data->appointment = $appointment;
    if($expert->hasAcceptedCallRequestEmail()){
      Mail::send('emails._appointmentRequest', ['data' => $data], function ($message) use ($data) {
      $message->to($data->expert->email, $data->expert->first_name)->subject('New appointment requested');
      });
    }
  }

  /**
   * [Show the PRECALL form with readonly fields and option to take an action]
   * @Get("/call/decision/{appointment_id}", as="preCallDecision")
   * @Middleware("role:expert")
   * @return void [view]
   */
  public function takeCallDecision($appointment_id)
  {
    $appointment  = Appointment::whereId($appointment_id)
                                ->whereExpert_id($this->user->id)->firstOrFail();
    return view('appointment.decide', compact('appointment'));
  }

  /**
   * [Update expert's decision for the PRECALL (Appointmnet)]
   * @Patch("/call/update-precall", as="updatePreCallDecision")
   * @Middleware("role:expert")
   * @return [void] [view]
   */
  public function updatePreCallDecision(Request $request)
  {
    $messages = array('selected_slot.required' => 'Please select a time slot.');
    $this->validate($request, ['selected_slot'  =>  'required'], $messages);

    $id           = $request->get('id');
    $slot         = intval($request->get('selected_slot'));
    $appointment  = Appointment::whereId($id)->whereExpert_id($this->user->id)->firstOrFail();
    $email        = Email::getAppointmentReplyEmail();

    $appointment->selected_slot =  $slot;
    //$appointment->is_confirmed  =  ($slot >= 1 && $slot <= 3) ? 1 : 0;
    $appointment->is_confirmed  =  1;
    $appointment->updated_at    =  Carbon\Carbon::now();

    $msg  = 'There is a problem';
    if ( $appointment->save() ) {
      $this->notifyUserAboutExpertDecision($appointment,$email);
      $msg  = 'User notified about your decision';
    }

    return redirect()->route('callrequests')->with('flash_message', ucwords($msg));
  }

  private function notifyUserAboutExpertDecision($appointment,$email)
  {
     return Mail::send('emails._expertsDecision', ['appointment' => $appointment, 'email' => $email], function ($message) use ($appointment) {
      $message->to($appointment->user->email, $appointment->user->getFullName())
      ->subject( $appointment->expert->getFullName() . ' replied for your appointment.');
    });
  }

}
