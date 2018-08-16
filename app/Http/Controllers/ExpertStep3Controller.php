<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Expertise;
use App\Category;

class ExpertStep3Controller extends Controller{

  /**
   * Create the view of expert step 3
   *
   * @param  none
   * @return view
   */
  public function getStep3(){

      $user = Auth::user();

      $all_expertises = $user->expertise->toArray();
      foreach($all_expertises as $key => $expertise){
          $category = Category::where('id', $expertise['category_id'])->get()->first();
          $all_expertises[$key]['category'] = $category;
          $parent_category = Category::where('id', $category->parent)->get()->first();
          $all_expertises[$key]['parent_category'] = $parent_category;
      }

      /*echo '<pre>';
      print_r($all_expertises);*/

      if(count($all_expertises)){
          return view('expertise.expertiselisting',[
              'expertises' => $all_expertises
          ]);
      }
      else {
          return view('expertise.step3');
      }
  }
}
