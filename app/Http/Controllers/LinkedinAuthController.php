<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;
use App\User;
use DB;

class LinkedinAuthController extends Controller
{
    /**
     * Redirect the user to the linkedin authentication page.
     *
     * @return Response
     */
    public function liRedirectToProvider()
    {
        $li_auth_callback = \Config::get('monster_call.linkedin_auth_callback');
        \Config::set('services.linkedin.redirect', $li_auth_callback);
        return Socialite::driver('linkedin')->redirect();
    }
    
    /**
     * Obtain the user information from linkedin.
     *
     * @return Response
     */
    public function liHandleProviderCallback()
    {
        $li_auth_callback = \Config::get('monster_call.linkedin_auth_callback');
        \Config::set('services.linkedin.redirect', $li_auth_callback);
        
        $user_li = Socialite::driver('linkedin')->user();

        $logged_in_user = Auth::user();

        $data = array();
        $data['is_social'] = 1;
        $data['li_name'] = $user_li->getName();
        $data['li_id'] = $user_li->getId();
        $data['li_image'] = $user_li->avatar_original;

        $logged_in_user->fill($data)->save();
        return redirect()->action('ExpertStep1Controller@getStep1');
    }
}
