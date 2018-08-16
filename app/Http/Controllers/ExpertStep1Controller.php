<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;

class ExpertStep1Controller extends Controller{

    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }
  /**
   * Create the view of expert step 1 form
   *
   * @param  none
   * @return view
   */
  public function getStep1(){
      return view('expertise.step1', [
          'user' => $this->user
      ]);
  }

  /**
   * Save step 1 form data
   *
   * @param  Request $request
   * @return view
   */
  public function postStep1(Request $request){
      $user = $this->user;

      $this->validate($request, [
          'username'    =>  'required|unique:users,username,' . $user->id,
          'timezone'    =>  'required',
          'phone'       =>  'required|digits:10'
      ]);

      $user->fill($request->all())->save();
      return redirect()->action('ExpertStep2Controller@getStep2');

  }
}
