<?php

namespace App\Http\Controllers\Auth;

use App\UserRole as UserRole;
use Input;
use Session;
use Response;
use Mail;

//use Bican\Roles\Models\Role;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Email;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use DB;

class AuthController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Registration & Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users, as well as the
  | authentication of existing users. By default, this controller uses
  | a simple trait to add these behaviors. Why don't you explore it?
  |
  */

  use AuthenticatesAndRegistersUsers, ThrottlesLogins;

  /**
  * Where to redirect users after login / registration.
  *
  * @var string
  */
  protected $redirectTo = '/dashboard';

  /**
  * Create a new authentication controller instance.
  */
  public function __construct()
  {
    $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
  }

  /**
  * Get a validator for an incoming registration request.
  *
  * @param array $data
  *
  * @return \Illuminate\Contracts\Validation\Validator
  */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'first_name' => 'required|max:50',
      'last_name' => 'required|max:50',
      'email' => 'required|email|max:255|unique:users',
      'password' => 'required|min:6|confirmed',
    ]);
  }

  /**
  * SEND VERIFICATION EMAIL
  */
  protected function sendVerificationEmail($data)
  {
    $data['mail'] = Email::getUserVerifyEmail();
    Mail::send('auth.emails.verify', $data, function ($message) {
      $message->to(Input::get('email'), Input::get('username'))
      ->subject('Verify your email address');
    });
  }

  /**
  * Create a new user instance after a valid registration.
  *
  * @param array $data
  *
  * @return User
  */
  protected function create(array $data)
  {
    $data['confirmation_code'] = str_random(30);
    $user = User::create([
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'email' => $data['email'],
      'password' => bcrypt($data['password']),
      'confirmation_code' => $data['confirmation_code'],
    ]);

    $this->sendVerificationEmail($data);

    return $user;
  }

  public function register(Request $request)
  {
    $validator = $this->validator($request->all());

    $msg = array();
    $msg['status'] = 0;
    $msg['text'] = '';

    // process the login
    if ($validator->fails()) {
      $msg['status'] = 0;
      $msg['text'] = 'Validation Failed...';

      foreach ($validator->errors()->all() as $error) {
        $msg['text'] .= "\n".$error;
      }
    } else {

      // store
      try {
        DB::beginTransaction();
        $role = UserRole::all()->where('slug', 'user')->first();
        $user = $this->create($request->all());
        $user->attachRole($role->id); // you can pass whole object, or just an id
        $credentials = $this->getCredentials($request);
        $msg['status'] = 1;
        $msg['text'] = 'User created successfully...';
        DB::commit();
      } catch (Exception $ex) {
        DB::rollback();
        $msg['status'] = 0;
        $msg['text'] = $ex->getMessage();
      }
    }

    Session::flash('message', $msg['text']);

    if ($msg['status'] == 1) {
      Session::flash('alert-class', 'alert-success');
    } else {
      Session::flash('alert-class', 'alert-danger');
    }

    return Response::json($msg);

    //return redirect($this->redirectPath());
  }

  public function login(Request $request)
  {
    $msg = array();
    $msg['status'] = 0;
    $msg['text'] = '';
    $statusCode = 400;
    // check for verified account
    $login = $request['email'];
    $user = User::where('email', '=', $request['email'])->first();
    if($user->is_social == 0 && $user->confirmed == 0) {
      $msg['status'] = 0;
      $msg['text'] = 'We did not recieve your email confirmation';
      return Response::json($msg, $statusCode);
    }
    try {
      $this->validateLogin($request);

      // If the class is using the ThrottlesLogins trait, we can automatically throttle
      // the login attempts for this application. We'll key this by the username and
      // the IP address of the client making these requests into this application.
      $throttles = $this->isUsingThrottlesLoginsTrait();

      if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
        $this->fireLockoutEvent($request);

        $this->sendLockoutResponse($request);

        $msg['status'] = 0;
        $msg['text'] = 'Too Many Login Attempts';

        //return $this->sendLockoutResponse($request);
      }

      $credentials = $this->getCredentials($request);

      if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {

        //$this->handleUserWasAuthenticated($request, $throttles);

        $msg['status'] = 1;
        $msg['text'] = 'success';
        $statusCode = 200;
        //return Response::json($msg);

        //return $this->handleUserWasAuthenticated($request, $throttles);
      } else {

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && !$lockedOut) {
          $this->incrementLoginAttempts($request);
        }

        $this->sendFailedLoginResponse($request);

        $msg['status'] = 0;
        $msg['text'] = 'Invalid Login';
      }
    } catch (Exception $ex) {
      $msg['status'] = 0;
      $msg['text'] = $ex->getMessage();
    }
    return Response::json($msg, $statusCode);

    //return $this->sendFailedLoginResponse($request);
  }

  /**
  * Confirm a user account
  * @param  String $confirmation_code this string is send to user via email and stored in confirmatiuon_code field
  * @return void
  */
  public function confirm($confirmation_code)
  {
    if( ! $confirmation_code)
    {
      $message = 'An error ocurred, your account is not verified.';
    }
    $user = User::where('confirmation_code', '=', $confirmation_code)->first();
    if ( ! $user)
    {
      $message = 'An error ocurred, your account is not verified.';
    }
    else {
      $user->confirmed = 1;
      $user->confirmation_code = null;
      $user->save();
      $message = 'Thank you for verifying your account, You can login now.';
      $data = array();
      $data['mail'] = Email::getUserVerifiedEmail();
      $data['first_name'] = $user->first_name;
      $data['email'] = $user->email;
      $data['message'] = $message;

      Mail::send('auth.emails.confirm', $data, function ($message) use ($user) {
        //dd($user->email);
        $message->to($user->email, $user->first_name)->subject('Thank you for verifying your account, You can login now.');
      });
    }
    return redirect('/')->with('message', $message);
  }
}
