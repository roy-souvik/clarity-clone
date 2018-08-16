<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
//use Twilio;
//use TwilioClass;
/**
 * @Middleware("auth")
 */
class AccountController extends Controller
{
  private $user;

  public function __construct()
  {
    $this->user = Auth::user();

    //Working with laravel-twilio package : examples are written below
    // $twilio = new TwilioClass(getenv('TWILIO_SID'), getenv('TWILIO_TOKEN'), getenv('TWILIO_FROM'));
    //
    // dd($twilio);
    //
    // $twilio->message('+919831568037', 'This is a Test message.');
    //
    // $twilio->call('+919831568037', function ($message) {
    //   $message->say('This is a Test call');
    //   $message->play('https://api.twilio.com/cowbell.mp3', ['loop' => 5]);
    // });
    //$twilio = Twilio::getTwilio();
    //dd($twilio);
    // try {
    //     // Initiate a new outbound call
    //     $call = $twilio->account->calls->create(
    //         '+16104008782', // The number of the phone initiating the call
    //         '+919831568037', // The number of the phone receiving call
    //         'http://demo.twilio.com/welcome/voice/' // The URL Twilio will request when the call is answered
    //     );
    // } catch (Exception $e) {
    //     echo 'Error: ' . $e->getMessage();
    // }

    //$call = $twilio->call("+919831568037", "http://demo.twilio.com/docs/voice.xml");
    //dd($twilio);
    //dd( Twilio::message('+919831568037', 'Hi this is SOUVIK testing the TWILIO API') );
    //Twilio::call('+919831568037', 'https://api.twilio.com/cowbell.mp3');
  }

//==============================================================================

  /**
   * Go to account landing page
   * @Get("account", as="account")
   */
  public function index()
  {
    $user = $this->user;
    return view('account.index', compact('user'));
  }

//==============================================================================

  /**
   * Go to settings page
   * @Get("settings", as="settings")
   */
  public function settings()
  {
    return view('account.settings.index');
  }

//==============================================================================

  /**
   * Go to change password page
   * @Get("account/change-password", as="changePassword")
   * @return view
   */
  public function changePassword()
  {
    return view('account.settings.changePassword');
  }

//==============================================================================

  /**
   * Update new password
   * @Patch("account/update-password", as="updatePassword")
   * @return view
   */
  public function updatePassword(Request $request)
  {
    $this->validate($request, $this->user->updatePasswordRules);
    $credentials = $request->only(
      'new_password', 'new_password_confirmation'
    );

    $user = $this->user;
    $user->password = bcrypt($credentials['new_password']);
    $user->save();

    return redirect()
            ->route('settings')
            ->with('flash_message', ucwords('password changed.'));
  }

//==============================================================================

/**
 * Go to change password page
 * @Get("account/notifications", as="notifications")
 * @return view
 */
  public function notifications()
  {
    $user = $this->user;
    return view('account.settings.notifications', compact('user'));
  }

//==============================================================================

  /**
   * Saves notifications in DB
   * @Patch("account/update-notifications", as="updateNotifications")
   * @param  Request $request
   * @return view
   */
  public function updateNotifications(Request $request)
  {
    $this->validate($request, $this->user->notificationsRules);

    $user = $this->user;
    $user->fill($request->all())->save();

     return redirect()
            ->route('settings')
            ->with('flash_message', ucwords('notifications updated.'));
  }
//==============================================================================

  /**
   * Go to billing address page
   * @Get("account/billing-address", as="billingAddress")
   * @return view
   */
  public function billingAddress()
  {
    $user = $this->user;
    return view('account.settings.billingAddress', compact('user'));
  }

//==============================================================================

  /**
   * Saves billing information in DB
   * @Patch("account/update-billinginfo", as="updateBillingInfo")
   * @param  Request $request
   * @return view
   */
  public function updateBillingInfo(Request $request)
  {
    $this->validate($request, $this->user->billingInfoRules);

    $user = $this->user;
    $user->fill($request->all())->save();

     return redirect()
            ->route('settings')
            ->with('flash_message', ucwords('billing information updated.'));
  }

//==============================================================================

  /**
   * Go to credit card page
   * @Get("account/credit-card", as="creditCard")
   * @return view
   */
  public function creditCard()
  {
    $user = $this->user;
    return view('account.settings.creditCard', compact('user'));
  }

//==============================================================================

  /**
   * Saves credit-card information in DB
   * @Patch("account/update-ccinfo", as="updateCCInfo")
   * @param  Request $request
   * @return view
   */
  public function updateCCInfo(Request $request)
  {
    $validationRules = array_merge($this->user->creditCardInfoRules, $this->user->billingInfoRules);

    $this->validate($request, $validationRules);

    $user = $this->user;
    $user->fill($request->all())->save();

     return redirect()
            ->route('settings')
            ->with('flash_message', ucwords('payment information updated.'));
  }

//==============================================================================

  /**
   * [Displays the page where user can export money to PAYPAL and view transactions]
   * @return [void] [view]
   * @Get("account/money", as="money")
   */

  public function showMoneyForm()
  {
    return view('account.settings.money');
  }



} //END CONTROLLER
