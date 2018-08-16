<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
* Each category has many sub categories as children
*/

class Category extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'description', 'slug'
  ];

	/**
	* In this function we load only direct children - 1 level
	*/
	public function children()
	{
	   return $this->hasMany('App\Category', 'parent');
	}

	/**
	* In this function we recursively load all children
	*/
	public function childrenRecursive()
	{
		 return $this->children()->with('childrenRecursive');
	   // which is equivalent to:
	   // return $this->hasMany('Category', 'parent')->with('childrenRecursive);
	}

	/**
	* In this function we load only direct parent - 1 level
	*/
	public function parent()
	{
	   return $this->belongsTo('Category', 'parent');
	}

	/**
	* In this function we load all ascendants
	*/
	public function parentRecursive()
	{
	   return $this->parent()->with('parentRecursive');
	}

  /**
   * [Check whether "root" is the parent of the current category (root = 1)]
   * @return boolean
   */
	public function isOfLevelOne()
	{
		return $this->parent	==	1 ? true : false;
	}

  public function hasChildren()
  {
    return ($this->childrenRecursive->count() > 0) ? true : false;
  }

}
