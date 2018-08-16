<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use DB;



use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\User;

use Input;
use Session;
use Response;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public $user 		= null;
	public $userRole 	= null;
	public $userName 	= null;
	
	
    public function __construct()
    {
        $this->middleware('auth');
		$user = Auth::user();
		
		$this->user = $user;
		
		
		if($this->user)
		{
			$this->userName =  ucfirst($user->name);
		
			if($this->user->hasRole('admin')){
				$this->userRole =  "Admin";
			} else if($this->user->hasRole('user')){
				$this->userRole =  "User";
			}else if($this->user->hasRole('expert')){
				$this->userRole =  "Expert";
			}
		}
		
		//$user->level()
		//$user->is('expert|user', false);

    }

	
    public function testAPICall($id)
    { 
		
		$data = [];
		$statusCode = 200;
		try {
			
			$userObj = User::findOrFail($id);
			
			$data['status'] 	= 1;
			$data['text'] 		= 'success';
			$data['output'] 	=  $userObj;
			
		} catch(Exception $ex) {
			
			$statusCode = 400;
			
			$msg['status'] 		= 0;
			$msg['text'] 		= $ex->getMessage();
			$data['output'] 	=  null;
			
		}
		
		
		return Response::json(['data' => $data], $statusCode);
	}

	
}
