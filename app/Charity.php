<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    protected $fillable =[
      'url',
      'name',
    ];
    public $timestamps = false;

    // Get users associated with given charity name
    public function user()
    {
      return $this->belongsTo('App\User');
      // return $this->hasMany('App\User');
    }

    public function getName()
    {
      return $this->name;
    }

    public function getUrl()
    {
      return $this->url;
    }

    public function isVisible()
    {
      return ($this->visibility == 1) ? true : false;
    }
}
