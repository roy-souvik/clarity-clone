<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Expertise;
use App\Category;
use App\User as User;

class BrowseController extends Controller
{
    private $expertises_per_page;

    public function __construct()
    {
        $this->expertises_per_page = Expertise::expertises_per_page;
    }
    /**
     * @Get("browse/{category_slug}", as="browse_by_category")
     * @param $category_slug
     * @return view
     */
    public function category($category_slug){
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $all_child_categories = $category->childrenRecursive;
        $next_level_children = $category->children;

        $category_id_array = $this->category_id_array($all_child_categories);
        $category_id_array[] = $category->id;

        $expertises = Expertise::findExpertisesByCategoryFeatured($category_id_array)->paginate($this->expertises_per_page);

        /*echo '<pre>';
        print_r($expertises);*/

        return view('browse.listing', [
            'expertises' => $expertises,
            'category' => $category,
            'children' => $next_level_children,
            'head' => 'browse.category_head',
            'filter_type' => 'featured',
            'sort_by' => 'highest_price'
        ]);
    }

    /**
     * @Get("browse/{category_slug?}/{subcategory_slug}", as="browse_by_subcategory")
     * @param $category_slug
     * @param $subcategory_slug
     * @return view
     */
    public function subcategory($category_slug, $subcategory_slug){
        $subcategory = Category::where('slug', $subcategory_slug)->firstOrFail();
        $all_child_categories = $subcategory->childrenRecursive;

        $category_id_array = $this->category_id_array($all_child_categories);
        $category_id_array[] = $subcategory->id;

        $expertises = Expertise::findExpertisesByCategoryFeatured($category_id_array)->paginate($this->expertises_per_page);

        $parent = Category::where('id', $subcategory['parent'])->get()->first();
        $next_level_children = $parent->children;

        /*echo '<pre>';
        print_r($expertises);*/

        return view('browse.listing', [
            'expertises' => $expertises,
            'parent' => $parent,
            'category' => $subcategory,
            'children' => $next_level_children,
            'head' => 'browse.subcategory_head',
            'filter_type' => 'featured',
            'sort_by' => 'highest_price'
        ]);
    }

    /**
     * @Get("/browse_filter", as="browse_filter")
     * @param $request
     * @return view
     */
    public function browseFilter(Request $request){
        $category = $request['category'];
        $filter_type = $request['filter_type'];
        $sort_by = $request['sort_by'];

        $category = Category::where('slug', $category)->firstOrFail();
        $all_child_categories = $category->childrenRecursive;

        $category_id_array = $this->category_id_array($all_child_categories);
        $category_id_array[] = $category->id;

        if($filter_type=='featured'){
            $expertises = Expertise::findExpertisesByCategoryFeatured($category_id_array, $sort_by)->paginate($this->expertises_per_page);
        }

        /* TODO: star rating needs be implemented here */
        elseif($filter_type=='top_rated' || $filter_type=='popular'){
            $expertises = Expertise::findExpertisesByCategoryRating($category_id_array, $sort_by)->paginate($this->expertises_per_page);
        }

        else{
            $expertises = Expertise::findExpertisesByCategory($category_id_array, $sort_by)->paginate($this->expertises_per_page);
        }
        return view('browse.single_list', [
            'expertises' => $expertises,
            'category' => $category->slug,
            'filter_type' => $filter_type,
            'sort_by' => $sort_by
        ]);
    }

    /**
     * @param $categories
     * @return array
     */
    protected function category_id_array($categories){
        return $this->category_id_recursive('id', $categories->toArray());
    }

    /**
     * @param $key
     * @param array $arr
     * @return array
     */
    protected function category_id_recursive($key, array $arr){
        $val = array();
        array_walk_recursive($arr, function($v, $k) use($key, &$val){
            if($k == $key) array_push($val, $v);
        });
        return $val;
    }
//==============================================================================

  /**
   * Displays the public profile of a user
   * @Get("/public/{username}", as="public")
   * @param string $value [description]
   */
  public function viewPublicProfile(Request $request)
  {
    $user = User::whereUsername($request->username)->firstOrFail();
    //dd( $user->getAverageRating() );
    return view('profile.public', compact('user'));
  }

}
