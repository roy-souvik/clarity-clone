<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;

class ExpertStep2Controller extends Controller{

    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
    * Create the view of expert step 2 form
    *
    * @param  none
    * @return view
    */
    public function getStep2(){
        return view('expertise.step2', [
            'user' => $this->user
        ]);
    }

    /**
    * Save step 2 form data
    *
    * @param  Request $request
    * @return view
    */
    public function postStep2(Request $request){
        $user = $this->user;
        $this->validate($request, [
            'short_bio'     =>  'max:50',
            'mini_resume'   =>  'required|min:80',
            'hourly_rate'   =>  'required|numeric|min:0'
        ]);

        $user->fill($request->all())->save();
        return redirect()->action('ExpertStep3Controller@getStep3');
    }
}
