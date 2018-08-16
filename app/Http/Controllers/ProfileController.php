<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Auth;
use Image;
use File;
use Redirect;
use Validator;
use App\Tag;
use App\User as User;
use App\Charity as Charity;
use Bican\Roles\Models\Role;

/**
 * @Middleware("auth")
 */
class ProfileController extends Controller
{
    private $user;

    public function __construct()
    {
      $this->user = Auth::user();
    }

//==============================================================================
  /**
   * Show profile landing page
   * @Get("/profile", as="my_profile")
   * @return view
   */
    public function index()
    {
      $user = $this->user;
      return view('profile.index', compact('user'));
    }

//==============================================================================
  /**
   * Update basic info form
   * @Get("/edit_basic_info", as="basic_info")
   * @return [void] [view]
   */
    public function basicInfo()
    {
      $user            = $this->user;
      $user->timezones = \Config::get('monster_call.timezones');
      return view('profile.edit_basic_info', compact('user'));
    }

//==============================================================================

  /**
   * [updateBasicInfo description]
   * @param  Request $request
   * @return [void] view
   */
  public function updateBasicInfo(Request $request)
  {
    $user = Auth::user();
    $this->validate($request, [
        'first_name'  =>  'required',
        'last_name'   =>  'required',
        'email'       =>  'required',
        'username'    =>  'required|unique:users,username,' . $user->id,
        'short_bio'   =>  'max:50',
        'mini_resume' =>  'required|min:80',
        'phone'       =>  'required|digits:10',
        'location'    =>  'required',
        'timezone'    =>  'required'
    ]);

    $user->fill($request->all())->save();
     return redirect()->route('my_profile')
              ->with('flash_message', ucwords('basic information updated.'));
  }

//==============================================================================

  /**
   * [User can change their profile picture here]
   * @Get("/edit_profile_img", as="profile_img")
   * @return [void] [view]
   */
  public function profileImg()
  {
    $user = $this->user;
    return view('profile.edit_profile_img', compact('user'));
  }

//==============================================================================
  /**
   * Updates the user profile image in DB and saves the images [thumb & normal] in Disk
   * @param  Request $request [PATCH request object]
   * @return [view]           [redirects to specific views]
   */
    public function updateProfileImg(Request $request)
    {
      $file      = $request->file('profile_picture');
      $fileArray = array('profile_picture' => $file);

      // Now pass the input and rules into the validator
      $validator = Validator::make($fileArray, $this->user->profilePicRule);

      //Check to see if validation fails or passes
      if ($validator->fails())
      {
        return Redirect::route('profile_img')->withErrors($validator);
      }
      else
      {
        if ($request->hasFile('profile_picture')) {

          // Prepare the files
          $profile_picture = $request->file('profile_picture');
          $newFileName     = time(). '.' . $profile_picture->getClientOriginalExtension();
          $oldImageName    = $this->user->profile_picture;

          // Prepare file paths for new image
          $newPicFilePathNormal  = public_path('/uploads/profile-pictures/normal/' . $newFileName);
          $newPicFilePathThumbs  = public_path('/uploads/profile-pictures/thumbs/' . $newFileName);

          // Prepare file paths for old image
          $oldPicFilePathNormal  = public_path('/uploads/profile-pictures/normal/' . $oldImageName);
          $oldPicFilePathThumbs  = public_path('/uploads/profile-pictures/thumbs/' . $oldImageName);

          // Save the files in Directory
          $this->storeProfilePictures($profile_picture, $newPicFilePathNormal); //Save Normal
          $this->storeProfilePictures($profile_picture, $newPicFilePathThumbs, 50, 50); // Save Thumbnail

          // Update User Table
          $user = Auth::user();
          $user->profile_picture  = $newFileName;
          $user->save();

          //Delete Old files
          $this->deleteOldProfilePictures($oldPicFilePathNormal, $oldImageName); //Delete Normal
          $this->deleteOldProfilePictures($oldPicFilePathThumbs, $oldImageName); // Delete Thumbnail

          return redirect()
                  ->route('my_profile')
                  ->with('flash_message', ucwords('Profile picture updated.'));
        } //END IF

      }// END ELSE

       return Redirect::route('profile_img')->with('message', 'Unable to update profile picture');
    }

//==============================================================================
  /**
   * Save an image to disk
   * @param  [file]  $image               [image file]
   * @param  [string]  $destinationFilePath [path where the image will be saved]
   * @param  integer $width               [description]
   * @param  integer $height              [description]
   * @return [void]
   */
    private function storeProfilePictures($image, $destinationFilePath, $width = 200, $height = 200)
    {
      $img = Image::make($image);

      if ($height === null) {
        //Set Auto Height
        $img->resize($width, null, function ($constraint) {
          $constraint->aspectRatio();
        });
      } else {
        $img->resize($width, $height);
      }

      $img->save($destinationFilePath);
    }

//==============================================================================
  /**
   * Deletes the image saved in the disk
   * @param  [string] $fullFilePath [path where the image is stored]
   * @param  string $oldImageName [image to be removed]
   * @return boolean
   */
    private function deleteOldProfilePictures($fullFilePath, $oldImageName = 'default-user.jpg')
    {
      if ($oldImageName != 'default-user.jpg') {
        return File::Delete($fullFilePath);
      }
      return false;
    }

//==============================================================================
  /**
   * show verifications view
   * @Get("/profile/verifications", as="verifications")
   * @param Request $request
   * @return void view
   */
    public function verifications(Request $request)
    {
        $user = $this->user;

        if($request['social']!='') {
            $this->validate($request, [
                'social' => 'required|In:fb,li,tw',
                'action' => 'required|In:connect,disconnect'
            ]);

            $social = $request['social'];
            $action = $request['action'];

            if($action=='disconnect'){
                $data = array();

                $data[$social.'_name'] = '';
                $data[$social.'_id'] = '';
                $data[$social.'_image'] = '';

                $user->fill($data)->save();

                return redirect()->action('ProfileController@verifications');
            }
            else{
                if($social=='li'){
                    return redirect()->action('VerificationController@liRedirectToProvider');
                }
                elseif($request['social']=='fb'){
                    return redirect()->action('VerificationController@fbRedirectToProvider');
                }
                else{
                    return redirect()->action('VerificationController@twRedirectToProvider');
                }
            }
        }

        return view('profile.verifications', compact('user'));
    }

//==============================================================================

/**
 * Go to profile settings
 * @Get("profile/topics", as="topics")
 */

  public function topics(Tag $tag)
  {
    $tags     = $this->user->getVisibleTags();
    return view('tags.tags', compact('tags'));
  }

//==============================================================================

  /**
   * Returns json encoded array of tags [called by select2 plugin via ajax]
   * @Get("get_topics", as="get_topics")
   */

    public function getTopics(Request $request)
    {
      $returnTagNames = array();
        if($request->ajax()) {
          $searchParam  = $request->get('q');
          $tags =  Tag::where([['name', 'LIKE', '%' . $searchParam . '%'],['visibility', 1]])->get()->toArray();
          foreach ($tags as $tag) {
            $data             = new \stdClass;
            $data->name       = $tag["name"];
            $data->id         = $tag["id"];
            $returnTagNames[] = $data;
          }
          echo json_encode($returnTagNames);
        }
    }
//==============================================================================
/**
 * Go to expert settings
 * @Middleware("role:expert")
 * @Get("profile/video", as="video")
 */
  public function video()
  {
    $user = $this->user;
    return view('profile.addvideo', compact('user')) ;
  }

//==============================================================================
/**
 * Go to expert settings
 * @Middleware("role:expert")
 * @Patch("profile/video", as="save_video")
 */
  public function storeVideo(Request $request)
  {
    $this->validate($request, [
      'video_link'  =>  'required|url',
    ]);

    $this->user->fill($request->all())->save();
    return redirect()->route('my_profile')
            ->with('flash_message', ucwords('video link added.'));
    }

//==============================================================================

  /**
   * Go to add hourly page
   * @Middleware("role:expert")
   * @Get("profile/rate", as="rate")
   */
    public function hourly_rate()
    {
      $data              = new \stdClass;
      $data->user        = $this->user;
      $data->hourlyRates = \Config::get('monster_call.hourlyRates');
      $data->charity_db  = Charity::whereVisibility(1)->lists('name', 'id');
      $data->charity     = $data->charity_db->toArray();

      return view('profile.add_hourly_rate', compact('data')) ;
    }

//==============================================================================

/**
 * Go to add hourly page
 * @Middleware("role:expert")
 * @Patch("profile/hourly_rate", as="save_hourly_rate")
 */

  public function storeHourlyRate(Request $request)
  {
    $this->validate($request, [
      'hourly_rate'  =>  'required|integer',
    ]);
    $user               = $this->user;
    $user->hourly_rate  = $request->get('hourly_rate');
    $charity            = Charity::find($request->get('charity'));
    $user->charity()->associate($charity);
    $user->save();
    return redirect()->route('my_profile')
            ->with('flash_message', ucwords('hourly rate updated.'));
    }

//==============================================================================

  /**
   * Go to add charity page
   * @Middleware("role:expert")
   * @Get("addcharities", as="addcharities")
   */
  public function addcharity()
  {
    return view('profile.addnewcharity');
  }

 /**
   * Persist a charity URL in DB by associating it with user
   * @Middleware("role:expert")
   * @Patch("addcharities", as="savecharities")
 */
   public function storeCharities(Request $request , Charity $charity)
   {
     $this->validate($request, [
        'url'  =>  'required|url|unique:charities'
     ]);

     $user              = $this->user;
     $charity           = new Charity;
     $charity->url      = $request->get('url');
     $charity->user_id  = $user->id;
     $charity->save();
     return redirect()->route('rate')->with('flash_message', ucwords('new charity added.'));
   }

    /**
     * @Get("profile/change-role", as="change_role")
     */
    public function change_role(){
        $user = $this->user;

        try
        {
            $user_role = Role::where('slug', 'user')->firstOrFail();
            $expert_role = Role::where('slug', 'expert')->firstOrFail();
        }
        catch(ModelNotFoundException $e)
        {
            $message = 'Roles are not available!!!';
            return redirect()->action('ProfileController@index')->with('flash_message', $message);
        }

        if($user->is('user')){
            if($user->switchUserRole($user_role, $expert_role)){
                $message='You are now a expert.';
            }
            else {
                $message = 'An error occurred';
            }
        }
        elseif($user->is('expert')){
            if($user->switchUserRole($expert_role, $user_role)){
                $message='You are now a member.';
            }
            else {
                $message = 'An error occurred';
            }
        }

        return redirect()->action('ProfileController@index')->with('flash_message', $message);
    }
/**
 * Go to expert settings
 * @Get("profile/share", as="share")
 */
  public function share()
   {
     return view('profile.share');
   }


    } //END CONTROLLER
