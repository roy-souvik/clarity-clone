<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserRole as UserRole;
use Input;
use Session;
use Response;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;
use DB;

class SocialController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }


    /**
     * Create a new social user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function fbCreate(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'is_social' => $data['is_social'],
            'fb_name' => $data['fb_name'],
            'fb_id' => $data['fb_id'],
            'fb_image' => $data['fb_image']
        ]);
    }

    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return Response
     */
    public function fbRedirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return Response
     */
    public function fbHandleProviderCallback()
    {
        $user_fb = Socialite::driver('facebook')->user();
        
        $name = $user_fb->getName();
        $parts = explode(" ", $name);

        $lastname = array_pop($parts);
        $firstname = implode(" ", $parts);
        
        $data = array();
        $data['first_name'] = $firstname;
        $data['last_name'] = $lastname;
        $data['email'] = $user_fb->getEmail();
        $data['is_social'] = 1;
        $data['fb_name'] = $name;
        $data['fb_id'] = $user_fb->getId();
        $data['fb_image'] = $user_fb->getAvatar();

        $rules = array('email' => 'unique:users,email');

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            //echo 'That email address is already registered. You sure you don\'t have an account?';

            $user = User::where('email', $data['email'])->first();

            $user->fill($data)->save();

            Auth::login($user);
            Session::save();

            return redirect('/dashboard');
        }
        else {
            $newUser = $this->fbCreate($data);
            $role = UserRole::all()->where('slug','user')->first();
            $newUser->attachRole($role->id);
            Auth::login($newUser);
            Session::save();
            //echo '<pre>';
            //print_r($newUser);
            return redirect('/dashboard');
        }
    }
    
    /**
     * Create a new social user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function liCreate(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'is_social' => $data['is_social'],
            'li_name' => $data['li_name'],
            'li_id' => $data['li_id'],
            'li_image' => $data['li_image']
        ]);
    }
    
    /**
     * Redirect the user to the linkedin authentication page.
     *
     * @return Response
     */
    public function liRedirectToProvider()
    {
        return Socialite::driver('linkedin')->redirect();
    }
    
    /**
     * Obtain the user information from linkedin.
     *
     * @return Response
     */
    public function liHandleProviderCallback()
    {
        $user_li = Socialite::driver('linkedin')->user();

        $name = $user_li->getName();
        $parts = explode(" ", $name);

        $lastname = array_pop($parts);
        $firstname = implode(" ", $parts);
        
        $data = array();
        $data['first_name'] = $firstname;
        $data['last_name'] = $lastname;
        $data['email'] = $user_li->getEmail();
        $data['is_social'] = 1;
        $data['li_name'] = $name;
        $data['li_id'] = $user_li->getId();
        $data['li_image'] = $user_li->avatar_original;

        $rules = array('email' => 'unique:users,email');

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            //echo 'That email address is already registered. You sure you don\'t have an account?';

            $user = User::where('email', $data['email'])->first();

            $user->fill($data)->save();

            Auth::login($user);
            Session::save();

            return redirect('/dashboard');
        }
        else {
            $newUser = $this->liCreate($data);
            $role = UserRole::all()->where('slug','user')->first();
            $newUser->attachRole($role->id);
            Auth::login($newUser);
            Session::save();
            //echo '<pre>';
            //print_r($newUser);
            return redirect('/dashboard');
        }
    }
}
