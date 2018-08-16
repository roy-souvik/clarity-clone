<?php

namespace App\Http\Controllers;

use App\Expertise;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use Auth;
use Mail;
use App\Http\Requests;
use App\User;
use Yajra\Datatables\Datatables;
use Redirect;
use Validator;
use DB;
use App\Tag;
use App\Charity;
use App\Page;
use Image;
use File;
use App\Email;
use App\Album;
use App\Photo;
use Toastr;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * @Middleware("auth")
 * @Middleware("role:admin")
 */
class AdminController extends Controller
{

  private $user, $charity;

  public function __construct(Charity $charity)
  {
    $this->user     = Auth::user();
    $this->charity  = $charity;
  }

//==============================================================================

  public function index()
  {
    return view('admin.index');
  }

//==============================================================================

  public function expertApply()
  {
    $users = User::where(['expert_applied' => 1, 'is_approved' => 0])->paginate(10);
    return view('admin.apply_as_expert', compact('users'));
  }

//==============================================================================

    /**
     * @param $user_id
     * @return mixed
     * @Get("/admin/approve-expert/{user_id}", as="approve_expert")
     */
    public function approve_expertise($user_id)
    {
        try
        {
            $user = User::findOrFail($user_id);
        }
        catch(ModelNotFoundException $e)
        {
            $message = 'Not a valid user!!!';
            Toastr::error($message);
            return redirect()->action('AdminController@expertApply')->with('flash_message', $message);
        }

        try
        {
            $user_role = Role::where('slug', 'user')->firstOrFail();
            $expert_role = Role::where('slug', 'expert')->firstOrFail();
        }
        catch(ModelNotFoundException $e)
        {
            $message = 'Roles are not available!!!';
            Toastr::error($message);
            return redirect()->action('AdminController@expertApply')->with('flash_message', $message);
        }

        if($user->switchUserRole($user_role, $expert_role))
        {
            $user->is_approved = 1;
            $user->save();

            Mail::send('admin.emails.expert', ['user' => $user], function ($message) use ($user) {
              $message->to($user->email, $user->first_name)->subject('Expert application approved');
            });
            $message = $user->first_name.' '.$user->last_name.' is now an expert!!!';
            Toastr::success($message);

            return redirect()->action('AdminController@expertApply')->with('flash_message', $message);
        }
        else{
            $message = 'An error occurred!!!';
            Toastr::error($message);

            return redirect()->action('AdminController@expertApply')->with('flash_message', $message);
        }
    }


  /**
   * Displays user list
   * @return \Illuminate\View\View
   */
  public function users()
  {
    return view('admin.users');
  }

  /**
   * Process datatables ajax request.
   *
   * @return \Illuminate\Http\JsonResponse
   */
   public function userData()
   {
     $query = User::select(DB::raw('CONCAT(first_name, " ", last_name) AS full_name'), 'id', 'email', 'created_at', 'updated_at')->orderBy('created_at', 'DESC');
     return Datatables::of($query)->make(true);
   }

   /**
    * Displays tags list
    * @return \Illuminate\View\View
    * @Get("/admin/review/tags", as="managetags")
    */
    public function reviewTags()
    {
      return view('admin.tags');
    }

    /**
     * Process datatables ajax request.
     * @return \Illuminate\View\View
     * @Get("/admin/review/tagsdata", as="managetags.data")
     */
     public function tagData()
     {
        $tags = Tag::select(['id', 'name', 'created_at', 'visibility']);
        return Datatables::of($tags)
            ->addColumn('action', function ($tag) {
              $toggleText = ( $tag->visibility == 1 ) ? 'deactivate' : 'activate';

               $actionColElement = link_to('javascript:void(0);', $toggleText, array('class' => 'toggle-tag-visibility', 'data-tagid' => $tag->id, 'data-visibility' => $tag->visibility), null);

                return $actionColElement;
            })
            ->removeColumn('visibility')
            ->make(true);
     }

     /**
      * Displays charity list
      * @return \Illuminate\View\View
      * @Get("/admin/review/charity", as="managecharity")
      */
      public function reviewCharity()
      {
        return view('admin.charity');
      }

      /**
       * Process datatables ajax request.
       * @return \Illuminate\View\View
       * @Get("/admin/review/charitydata", as="managecharities.data")
       */
       public function charityData()
       {
          $charities = Charity::select(['charities.id', DB::raw('users.email AS email'),DB::raw('users.username AS username'),'url','name','visibility'])
          ->join('users', 'charities.user_id', '=', 'users.id');
          return Datatables::of($charities)
              ->addColumn('action', function ($charity) {
                $toggleText = ( $charity->visibility == 1 ) ? 'deactivate' : 'activate';

                $actionColElement = link_to('javascript:void(0);', $toggleText, array('class' => 'toggle-charity-visibility', 'data-charityid' => $charity->id, 'data-charityname' => $charity->name ,'data-visibility' => $charity->visibility), null);

                $editIcon = '&nbsp;&nbsp;<a href="'. url('/admin/charity/'. $charity->id) .'" class="blue-text darken-4" title="Edit name"> <i class="tiny material-icons">mode_edit</i> </a>';

                return $actionColElement . $editIcon;
              })
              ->removeColumn('visibility')
              ->make(true);
       }

     /**
      * Update tag visibility
      * @Get("admin/toggleTagVisibility", as="toggleTagVisibility")
      * @return boolean {data saved or not}
      */
     public function toggleTagVisibility(Request $request)
     {
       if($request->ajax()) {
         $tagid           = $request->get('id');
         $visibility      = $request->get('visibility');
         $tag             = Tag::find($tagid);
         $tag->visibility = ($visibility ==  0) ? 1 : 0;
         echo( $tag->save() );
        }
     }


     /**
     * Update charity visibility
     * @Get("admin/alterCharityVisibility", as="alterCharityVisibility")
     * @return boolean {data saved or not}
     */
    public function alterCharityVisibility(Request $request)
    {
      if($request->ajax()) {
        $charityid           = $request->get('id');
        $visibility          = $request->get('visibility');
        $charity             = $this->charity->whereId(intval($charityid))->first();
        $charity->visibility = ($visibility ==  0) ? 1 : 0;
        echo( $charity->save() );
       }
    }

    /**
     * Go to admin page
     * @Get("/admin/charity/{id}", as="editcharity")
     */
    public function editcharity($id)
    {
      $charity  = $this->charity->whereId(intval($id))->first();
      return view('admin.editCharity', compact('charity'));
    }

    /**
      * Go to admin page
      * @Patch("/admin/updatecharity", as="updatecharity")
    */
    public function storeName(Request $request)
    {
      $this->validate($request, [
        'name'  =>  'required|string|min:3',
        'id'   =>  'required|integer'
      ]);
      $charity_id = $request->get('id');
      $name       = $request->get('name');
      $charity    = $this->charity->whereId($charity_id)->first();
      $charity->name  = $name;
      $charity->save();

      Toastr::success('Charity updated');
      return redirect()->route('managecharity');
    }

    /**
     * Displays expertise list
     * @return \Illuminate\View\View
     * @Get("/admin/review/expertise", as="manage-expertise")
     */
    public function reviewExpertise()
    {
        return view('admin.expertise');
    }

    /**
     * Process datatables ajax request.
     * @return \Illuminate\View\View
     * @Get("/admin/review/expertisedata", as="manage-expertise.data")
     */
    public function expertData()
    {
        $expertises = Expertise::select([DB::raw('expertises.id AS id'), DB::raw('expertises.title AS title'), DB::raw('CONCAT(users.first_name, " ", users.last_name) AS full_name'), DB::raw('users.email AS email'), DB::raw('GROUP_CONCAT(DISTINCT tags.name ORDER BY tags.name ASC SEPARATOR ", ") AS tags_list'), DB::raw('expertises.is_featured AS is_featured')])
        ->join('users', 'expertises.user_id', '=', 'users.id')
        ->join('expertise_tag', 'expertise_tag.expertise_id', '=', 'expertises.id')
        ->join('tags', 'expertise_tag.tag_id', '=', 'tags.id')
        ->groupBy('expertise_tag.expertise_id');
        return Datatables::of($expertises)
            ->addColumn('action', function ($expertise) {
                $toggleText = ( $expertise->is_featured == 1 ) ? 'Featured' : 'General';

                $actionColElement = '<a href="javascript:void(0);" class="toggle-expertise-featured" data-expertiseid="' . $expertise->id . '" data-featured="'. $expertise->is_featured . '"> '. $toggleText .' </a>';

                return $actionColElement;
            })
            ->removeColumn('id')
            ->removeColumn('is_featured')
            ->make(true);
    }

    /**
     * Update tag visibility
     * @Get("admin/toggleExpertiseFeatured", as="toggleExpertiseFeatured")
     * @return boolean {data saved or not}
     */
    public function toggleExpertiseFeatured(Request $request)
    {
        if($request->ajax()) {
            $expertiseid     = $request->get('id');
            $is_featured      = $request->get('is_featured');
            $expertise    = Expertise::find($expertiseid);
            $expertise->is_featured = ($is_featured ==  0) ? 1 : 0;
            echo( $expertise->save() );
        }
    }

    /**
      * Displays Textarea For Adding Page
      * @return \Illuminate\View\View
      * @Get("/admin/review/pages/{id}", as="managepage")
      */
      public function pages($id)
      {
        $page = Page::whereId($id)->firstOrFail();
        return view('admin.pages', compact('page'));
      }

   /**
   * Go to admin and click on pages in sidebar
   * @Patch("/admin/savePages", as="savePages")
   */
  public function storePages(Request $request)
  {
    $page   = new Page;
    $this->validate($request, $page->getValidationRules());

    $id              = $request->get('id');
    $page            = Page::whereId($id)->firstOrFail();
    $page->content   = $request->get('content');
    $page->save();
    Toastr::success(str_plural($page->title) . ' content updated Successfully!');
    return redirect()->route('managepage', ['id'=>$page->id]);    
  }

  /**
      * Displays Textarea For Adding Email Body
      * @return \Illuminate\View\View
      * @Get("/admin/review/email/{id}", as="manageemail")
      */
      public function emails($id)
      {
        $email = Email::whereId($id)->firstOrFail();
        return view('admin.emailbody', compact('email'));
      }

   /**
   * Go to admin and click on pages in sidebar
   * @Patch("/admin/saveEmail", as="saveEmail")
   */
  public function storeEmails(Request $request)
  {
    $email   = new Email;
    $this->validate($request, $email->getValidationRules());

    $id               = $request->get('id');
    $email            = Email::whereId($id)->firstOrFail();
    $email->content   = $request->get('content');
    $email->save();
    Toastr::success(str_plural($email->subject) . ' email-content updated Successfully!');
    return redirect()->route('manageemail', ['id'=>$email->id]);    
  }

  /**
   * Go to admin and click on photos in sidebar
   * @Get("/admin/photos", as="managephoto")
   */
  public function pictures()
  {
    $photos = Photo::all();
    return view('admin.photos', compact('photos'));
  }
  
/**
* Go to admin and click on photos in sidebar
* @Get("/admin/addphoto/{id}", as="addphoto")
*/ 

public function addphoto($id)
    {
      $photo = Photo::whereId($id)->firstOrFail();
    return view('admin.addphotos', compact('photo'));
    }

//==============================================================================
  /**
   * Updates the image in DB and saves the images [thumb & normal] in Disk
   * @param  Request $request 
   * @Post("/admin/savephoto", as="savephoto")
   * @return [view]           [redirects to specific views]
   */
    public function updateImg(Request $request)
    {
      $file      = $request->file('new_picture');
      $fileArray = array('new_picture' => $file);

        if ($request->hasFile('new_picture')) {

          // Prepare the files
          $new_picture = $request->file('new_picture');
          $newFileName     = time(). '.' . $new_picture->getClientOriginalExtension();
          
          // Prepare file paths for new image
          $newPicFilePathNormal  = public_path('/uploads/category/' . $newFileName);
      
          // Save the files in Directory
          $this->storePictures($new_picture, $newPicFilePathNormal); //Save Normal

          // Update Photo Table
          $photo = new Photo;
          $id                = $request->get('id');
          /*  $photo             = Photo::whereAlbumId($id)->firstOrFail(); */
          $photo->album_id   = $id;
          $photo->photo      = $newFileName;    
          $photo->save();

        return redirect()
                  ->route('managephoto')
                  ->with('flash_message', ucwords('Category picture added.'));
        } //END IF

        return Redirect::route('addphoto', ['id'=>1])
     ->with('message', 'Unable to add new picture');
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
    private function storePictures($image, $destinationFilePath, $width = 1366, $height = 421)
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

}// End Controller

