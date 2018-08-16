<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable =[
      'album_id',
      'photo'
    ];

    protected $table;

  public function __construct()
  {
    $this->table    = 'photos';
  }

//==============================================================================
// VALIDATION RULES
//==============================================================================

public $PicRule   = [
    'new_picture' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
  ];

    
//==============================================================================
// RELATIONS OF USER WITH OTHER MODELS
//==============================================================================

    //Get album associated with given photo
    public function album()
    {
      return $this->belongsTo('App\Album');
    }

//==============================================================================
// METHODS / FEATURES
//==============================================================================
  public function getPhoto($getFullPath = false)
    {
      if ($getFullPath) {
        return url( '/uploads/category/' . '/' . $this->photo );
      }
      return $this->photo;
    }
  public function getUpdatedAt()
  {
    return $this->updated_at;
  }
  
}