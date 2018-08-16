<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 class Album extends Model
 {
     protected $fillable =[
       'name',
       'image_link',
     ];

 //==============================================================================

 // RELATIONS OF USER WITH OTHER MODELS

 //==============================================================================

 

     // Get users associated with given album

     public function user()

     {

       return $this->belongsTo('App\User');

       // return $this->hasMany('App\User');

     }

 

     //Get photos associated with given album

     public function photos()

     {

      return $this->hasMany('App\Photo');

     }

 

 //==============================================================================

 // METHODS / FEATURES

 //==============================================================================

public function getId()
{
    return $this->id;
}

public function getName()
   {

     return $this->name;

   }

 

   public function getImage()

   {

     return $this->image_link;

   }

 

public function getAlbumNames()
{
   return $this->lists('name','id');
}

}