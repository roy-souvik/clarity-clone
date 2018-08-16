<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use DB;
use Toastr;

class CategoryController extends Controller
{
	/**
	* Display list of all of the categories
	* @param Request $request
	* @return Response
	*/
	public function index(Request $request) {

		$children = [];

		$root 		= Category::where('name', 'root')->firstOrFail();
		$business = Category::where('name', 'business')->firstOrFail();

		if($root) {
			$children = Category::find($root->id)->childrenRecursive()->get();
		}

		return view('category.index', [
			'categories' => $children,
			'root' => $business
		]);
	}

	/**
	* Create a new category.
	*
	* @param  Request  $request
	* @return Response
	*/
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|unique:categories|max:255',
		]);

		$recordId = DB::table('categories')->insertGetId([
            'name' => $request->input('name'),
            'description'  => $request->input('name'),
            'slug'  => str_slug($request->input('name'), '-'),
            'parent' => $request->input('parent'),
        ]);

		if (intval($recordId) > 0) {
			flushCache('categories');
		}

		Toastr::success('Category saved successfully');

		return redirect('/categories');
	}

	// Commenting out the feature : will be opened when needed
	// /**
	//  * @Middleware("auth")
	//  * @Middleware("role:admin")
	//  * @Get("admin/removeCategory", as="removeCategory")
	//  */
	// public function removeCategory(Request $request)
	// {
	// 	if($request->ajax()) {
	// 		$id				=	$request->get('id');
	// 		$category = Category::whereId(intval($id))->firstOrFail();
	// 		$return=($category->hasChildren() || $category->isOfLevelOne()) ? 0 : ($category->delete()) ? 1 : 0;
	// 		echo $return;
	// 		if ($return == 1) {
	// 			flushCache('categories');
	// 		}
	// 		return;
	// 	}
	// }
	//


} //END CONTROLLER
