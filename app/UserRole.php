<?php

namespace App;

use App\Task;
use Bican\Roles\Models\Role;

use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\SoftDeletes;


class UserRole extends Role
{
    //use SoftDeletes;

	protected $table = 'roles';
	
	public function users()
    {
        return $this->belongsToMany('App\User' , 'role_user',  'role_id', 'user_id' )->withPivot('created_at', 'updated_at');
    }
	
}
