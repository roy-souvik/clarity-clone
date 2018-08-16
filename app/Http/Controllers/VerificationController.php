<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;


class VerificationController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Redirect the user to the facebook authentication page.
     * @Get("verification/facebook", as="facebook_verification")
     * @return Response
     */
    public function fbRedirectToProvider()
    {
        $fb_verification_callback = \Config::get('monster_call.facebook_verification_callback');
        \Config::set('services.facebook.redirect', $fb_verification_callback);
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from facebook.
     * @Get("verification/facebook/callback", as="facebook_verification_callback")
     * @return Response
     */
    public function fbHandleProviderCallback()
    {
        $fb_verification_callback = \Config::get('monster_call.facebook_verification_callback');
        \Config::set('services.facebook.redirect', $fb_verification_callback);

        $user_li = Socialite::driver('facebook')->user();

        $logged_in_user = Auth::user();

        $data = array();
        $data['is_social'] = 1;
        $data['fb_name'] = $user_li->getName();
        $data['fb_id'] = $user_li->getId();
        $data['fb_image'] = $user_li->avatar_original;

        $logged_in_user->fill($data)->save();
        return redirect()->action('ProfileController@verifications');
    }

    /**
     * Redirect the user to the linkedin authentication page.
     * @Get("verification/linkedin", as="linkedin_verification")
     * @return Response
     */
    public function liRedirectToProvider()
    {
        $li_auth_callback = \Config::get('monster_call.linkedin_verification_callback');
        \Config::set('services.linkedin.redirect', $li_auth_callback);
        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * Obtain the user information from linkedin.
     * @Get("verification/linkedin/callback", as="linkedin_verification_callback")
     * @return Response
     */
    public function liHandleProviderCallback()
    {
        $li_auth_callback = \Config::get('monster_call.linkedin_verification_callback');
        \Config::set('services.linkedin.redirect', $li_auth_callback);

        $user_li = Socialite::driver('linkedin')->user();

        $logged_in_user = Auth::user();

        $data = array();
        $data['is_social'] = 1;
        $data['li_name'] = $user_li->getName();
        $data['li_id'] = $user_li->getId();
        $data['li_image'] = $user_li->avatar_original;

        $logged_in_user->fill($data)->save();
        return redirect()->action('ProfileController@verifications');
    }

    /**
     * Redirect the user to the twitter authentication page.
     * @Get("verification/twitter", as="twitter_verification")
     * @return Response
     */
    public function twRedirectToProvider()
    {
        $tw_auth_callback = \Config::get('monster_call.twitter_verification_callback');
        \Config::set('services.twitter.redirect', $tw_auth_callback);
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from twitter.
     * @Get("verification/twitter/callback", as="twitter_verification_callback")
     * @return Response
     */
    public function twHandleProviderCallback()
    {
        $tw_auth_callback = \Config::get('monster_call.twitter_verification_callback');
        \Config::set('services.twitter.redirect', $tw_auth_callback);

        $user_tw = Socialite::driver('twitter')->user();

        $logged_in_user = Auth::user();

        $data = array();
        $data['is_social'] = 1;
        $data['tw_name'] = $user_tw->getName();
        $data['tw_id'] = $user_tw->getId();
        $data['tw_image'] = $user_tw->avatar_original;

        $logged_in_user->fill($data)->save();
        return redirect()->action('ProfileController@verifications');
    }
}
