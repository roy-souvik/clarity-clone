<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Appointment;
use App\Feedback;
use Redirect;
use Carbon;

/**
 * @Middleware("auth")
 */

class FeedbackController extends Controller
{
   private $user, $feedback;

  public function __construct()
  {
    $this->user 	 = Auth::user();
    $this->feedback  = new Feedback();
  }

/**
   * Go to homepage
   * @Get("/feedback/{appointment_id}/{call_id}", as="feedback")
   */  
  public function index($appointment_id,$call_id)
  {
    $appointment = Appointment::whereIdAndRequesterId($appointment_id, $this->user->id)->firstOrFail();
    $data                 = new \stdClass;
    $data->user           = $this->user;     
    $data->appointment    = $appointment;
    $data->call_id        = $call_id;
    return view('call.feedback', compact('data'));
  }

  /**
   * Go to feedback page
   * @Post("/saveFeedback", as="saveFeedback")
   */
  public function store(Request $request)
  {
          $this->validate($request, $this->feedback->getfeedbackRules());

          $user                 	= $this->user;
          $feedback             	= $this->feedback;
          $feedback->call_id        = $request->get('call_id');
          $feedback->appointment_id = $request->get('appointment_id');
          $feedback->title   		= $request->get('title') ;
          $feedback->description 	= $request->get('description');
          $feedback->rating         = $request->get('rating');
          $feedback->save();
          return redirect()->route('my_profile')
              ->with('flash_message', ucwords('Feedback Saved Successfully.'));
                  
  }
}
