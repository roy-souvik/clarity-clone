<?php

namespace App;

use App\Tag;
use App\Question;

use Illuminate\Database\Eloquent\Model;

class QuestionTag extends Model
{
    protected $table = 'tags';
    	
	public function question()
    {
        return $this->belongsToMany('App\Question');
    }
}