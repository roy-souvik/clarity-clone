<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;
use Redirect;
use Auth;

class TagsController extends Controller
{
  private $user;

  public function __construct()
  {
    $this->user = Auth::user();
  }

  /**
	* Associate a user with her tags
	* @param Request
	* @return Response
	*/
  public function store(Request $request)
  {
     $loggedInUser = $this->user;
     $loggedInUser->tags()->detach(); //Delete all tags of the user
     $tagsFromUI          = $request->get('tags');
     $countTagsToBeSaved  = count($tagsFromUI);

     if ($countTagsToBeSaved > 0) {
       foreach ($tagsFromUI as $tag) {
         $insertThisTag = [ 'name' => $tag ];
         $tag      = Tag::firstOrCreate($insertThisTag);
         $loggedInUser->tags()->attach($tag);
        }
     }

     $message =  ($countTagsToBeSaved > 0) ? 'added' : 'cleared.';

      return redirect()->route('my_profile')
                       ->with('flash_message', ucwords('topics ' . $message));
  }

   /**
 	* Get all tags associated with the current user
 	* @param void
 	* @return tags
 	*/
  private function getMyTags()
  {
    return $this->user->tags();
  }

} //END OF CONTROLER
