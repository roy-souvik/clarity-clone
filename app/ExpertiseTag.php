<?php

namespace App;

use App\Tag;
use App\Expertise;

use Illuminate\Database\Eloquent\Model;

class ExpertiseTag extends Model
{
	protected $table = 'tags';
    	
	public function expertise()
    {
        return $this->belongsToMany('App\Expertise');
    }
}