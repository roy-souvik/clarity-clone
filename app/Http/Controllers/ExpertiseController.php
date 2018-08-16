<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Tag;
use App\Category;
use App\Expertise;
use App\User;
use App\Email;
use Mail;
use Image;
use File;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ExpertiseController extends Controller{

    private $user;
    private $validation_rules;
    private $validation_message;
    private $topCategories;

    public function __construct()
    {
        $this->user = Auth::user();

        $root = Category::where('name', 'root')->firstOrFail();
        $this->topCategories = Category::where('parent', $root->id);
        $this->validation_rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'subcategory_id' => 'numeric|min:1',
            'description' => 'required|min:80',
            'tags' => 'required',
            'cover_image' => 'mimes:jpeg,jpg,png,gif|max:10000' // max 10000kb
        ];
        $this->validation_message = [
            'category_id.required' => 'Please select a category.',
            'tags.required' => 'Please choose at least one topic.'
        ];
    }

    /**
     * Create the view of expertise form
     *
     * @param  none
     * @return view
     */
    public function showNewExpertiseForm(){

        $topCategories = $this->topCategories;

        return view('expertise.addexpertise', [
            'categories' => $topCategories
        ]);
    }

    /**
     * Add new expertise
     *
     * @param  Request $request
     * @return view
     */
    public function addNewExpertise(Request $request){
        $user = $this->user;

        $this->validate($request, $this->validation_rules, $this->validation_message);

        $newFileName = 'no-expertise-image.jpg';

        if ($request->hasFile('cover_image') && $request->file('cover_image')->isValid()) {

            // Prepare the files
            $cover_image = $request->file('cover_image');
            $newFileName     = time(). '.' . $cover_image->getClientOriginalExtension();

            // Prepare file paths for new image
            $newPicFilePath  = public_path('/uploads/expertise-cover-images/' . $newFileName);

            // Save the files in Directory
            $this->storeExpertiseCover($cover_image, $newPicFilePath);
        }

        if($request['subcategory_id']!=''){
            $category_id = $request['subcategory_id'];
        }
        else{
            $category_id = $request['category_id'];
        }
        $newExpertise = $this->createExpertise($request->all(), $user->id, $category_id, $newFileName);

        $newExpertise->tags()->detach();

        $tagsFromUI  = $request->get('tags');
        $tags      = Tag::whereIn('id', $tagsFromUI)->get();
        $newExpertise->tags()->attach($tags);

        if($user->expert_applied == 0){
            $this->notifyAdmin();
        }

        $user->expert_applied = 1;
        $user->save();

        if ($user->is('user')) {
            \Session::flash('flash_message', ucwords('Expertise sent for approval.'));
        }
        elseif($user->is('expert')) {
            \Session::flash('flash_message', ucwords('Expertise successfully added.'));
        }
        return redirect()->action('ProfileController@index');
    }

    /**
     * Create a new expertise
     *
     * @param   $request
     * @param   $user_id
     * @param   $category_id
     * @param   $newFileName
     * @return  Expertise
     */
    protected function createExpertise($request, $user_id, $category_id, $newFileName)
    {
        return Expertise::create([
            'user_id'       => $user_id,
            'title'         => $request['title'],
            'category_id'   => $category_id,
            'description'   => $request['description'],
            'cover_image'   => $newFileName,
            'slug'          => str_slug($request['title'], '-')
        ]);
    }

    /**
     * Return child categories
     *
     * @param  Request $request
     * @return json
     */
    protected function getChildCategories(Request $request)
    {
        $childCategories = array();
        $status = 0;
        if($request->parent > 0){
            $childCategories = Category::where('parent', $request->parent)->get(['id', 'name'])->toArray();
            if(count($childCategories))
            {
                $status = 1;
            }
        }

        $returnArray = array('status'=>$status, 'result'=>$childCategories);
        return json_encode( $returnArray ) ;
    }

    /**
     * Store expertise cover image
     *
     * @param  $image, $destinationFilePath
     * @return null
     */
    public function storeExpertiseCover($image, $destinationFilePath)
    {
        $img = Image::make($image);
        $img->save($destinationFilePath);
    }

    /**
     * Go to edit expertise page
     * @Get("expertise/edit/{expertise_id}", as="edit_expertise")
     * @return view
     */
    public function editExpertiseForm($expertise_id){
        try
        {
            $expertise = Expertise::findOrFail($expertise_id);
        }
        catch(ModelNotFoundException $e)
        {
            return redirect()->action('ExpertStep3Controller@getStep3');
        }

        $topCategories = $this->topCategories;

        $category = Category::find($expertise['category_id']);
        if($category['parent'] != 1){
            $subCategories = Category::where('parent', $category['parent'])->get();
            $category_id = $category['parent'];
            $subcategory_id = $category['id'];
        }
        else{
            $subCategories = Category::where('parent', $category['id'])->get();
            $category_id = $category['id'];
            $subcategory_id = '';
        }

        return view('expertise.editexpertise',[
            'categories' => $topCategories,
            'subcategories' => $subCategories,
            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'expertise' => $expertise,
        ]);
    }

    /**
     * save expertise
     * @param Request $request
     * @param $expertise_id
     * @Post("expertise/edit/{expertise_id}", as="edit_expertise")
     * @return view
     */
    public function saveExpertise(Request $request, $expertise_id){
        try
        {
            $expertise = Expertise::findOrFail($expertise_id);
        }
        catch(ModelNotFoundException $e)
        {
            return redirect()->action('ExpertStep3Controller@getStep3');
        }

        $this->validate($request, $this->validation_rules, $this->validation_message);

        $data['title'] = $request['title'];
        $data['slug'] = str_slug($request['title'], '-');
        if($request['subcategory_id']!=''){
            $data['category_id'] = $request['subcategory_id'];
        }
        else{
            $data['category_id'] = $request['category_id'];
        }
        $data['description'] = $request['description'];

        $oldCoverName = '';
        if ($request->hasFile('cover_image') && $request->file('cover_image')->isValid()) {

            // Prepare the files
            $cover_image = $request->file('cover_image');
            $newFileName = time() . '.' . $cover_image->getClientOriginalExtension();

            // Prepare file paths for new image
            $newPicFilePath = public_path('/uploads/expertise-cover-images/' . $newFileName);

            // Save the files in Directory
            $this->storeExpertiseCover($cover_image, $newPicFilePath);
            $data['cover_image'] = $newFileName;

            $oldCoverName = $expertise['cover_image'];
            $oldCoverFilePath  = public_path('/uploads/expertise-cover-images/' . $oldCoverName);

        }
        else{
            $data['cover_image'] = $expertise['cover_image'];
        }

        $expertise->fill($data)->save();
        $expertise->tags()->detach();
        $tagsFromUI  = $request->get('tags');
        $tags      = Tag::whereIn('id', $tagsFromUI)->get();
        $expertise->tags()->attach($tags);
        if($oldCoverName != ''){
            $this->deleteOldExpertiseCover($oldCoverFilePath, $oldCoverName);
        }

        \Session::flash('flash_message', ucwords('Expertise updated.'));
        return redirect()->action('ExpertStep3Controller@getStep3');
    }

    /**
     * Deletes the image saved in the disk
     * @param  [string] $fullFilePath [path where the image is stored]
     * @param  string $oldImageName [image to be removed]
     * @return boolean
     */
    private function deleteOldExpertiseCover($fullFilePath, $oldImageName = 'no-expertise-image.jpg')
    {
        if ($oldImageName != 'no-expertise-image.jpg') {
            return File::Delete($fullFilePath);
        }
        return false;
    }

    protected function notifyAdmin(){
        $mail_body = Email::getExpertAppliedEmail();
        $admins = User::getAllAdmins();

        foreach ($admins as $admin){
            Mail::send('emails._expertApplication', ['admin' => $admin, 'mail_body' => $mail_body], function ($message) use ($admin, $mail_body) {
                $message->to($admin->email, $admin->first_name)->subject($mail_body->getSubject());
            });
        }
    }
}