<?php

namespace App;

use App\Expertise;
use Illuminate\Database\Eloquent\Model;


class Tag extends Model
{
  protected $fillable =[
    'name'
  ];

//get the users associated with given tag.

  public function users()
  {
    return $this->belongsToMany('App\User');
  }

  public function expertises()
  {
    return $this->belongsToMany('App\Expertise');
  }

  public function questions()
  {
    return $this->belongsToMany('App\Question');
  }

  public function isVisible()
  {
    return ($this->visibility == 1) ? true : false;
  }

  public function getName()
  {
    return $this->name;
  }

}
