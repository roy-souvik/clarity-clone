<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Appointment;
use App\Expertise;
use App\Call;
use Input;
use Session;
use Response;

/**
 * @Middleware("auth")
 */
class DashboardController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
	public $user 		  = null;
	public $userRole 	= null;
	public $userName 	= null;

  public function __construct()
  {
  	$this->user = Auth::user();

  	// if($this->user)
  	// {
  	// 	$this->userName =  ucfirst($user->first_name).' '.ucfirst($user->last_name);
    //
  	// 	//$userObj = User::findOrFail($this->user->id);
    //
  	// 	if($this->user->hasRole('admin')){
  	// 		$this->userRole =  "Admin";
  	// 	} else if($this->user->hasRole('user')){
  	// 		$this->userRole =  "User";
  	// 	}else if($this->user->hasRole('expert')){
  	// 		$this->userRole =  "Expert";
  	// 	}
  	// }
		//$user->level()
		//$user->is('expert|user', false);

  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */

	public function accessdenied()
  {
    return view('dashboard.accessdenied');
  }

  /**
   * Displays main dashboard
   * @return \Illuminate\View\View
   * @Get("/dashboard", as="dashboard")
   */
  public function index()
  {
   //return view('dashboard.index', ['userRole' => $this->userRole, 'userName' => $this->userName]);
   return view('dashboard.index');
  }

  /**
   * Displays Live page
   * @return \Illuminate\View\View
   * @Get("/live", as="live")
   */
  public function live()
  {
    return view('live.index');
  }

  /**
   * Displays Call Requests page
   * @Middleware("role:expert")
   * @return \Illuminate\View\View
   * @Get("/dashboard/callrequests", as="callrequests")
   */
  public function callRequests()
  {
    $expertises   = $this->user->expertise;
    $appointments = [];

    //PUSH ALL UNCONFIRMED APPOINTMENTS OF EACH EXPERTISE IN A FRESH NEW ARRAY
    foreach ($expertises as $expert) {
      foreach ($expert->appointments as $appointment) {

        if (! $appointment->isConfirmed()) {
          $appointments[] = $appointment;
        }

      }     
    }

    $appointments = collect($appointments);
    
    return view('call.callrequests', compact('appointments'));
  }

}
