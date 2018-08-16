<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Tag;

class TagUser extends Model
{
  protected $table = 'tags';


  public function users()
  {
    return $this->belongsToMany('App\User');
  }


}
