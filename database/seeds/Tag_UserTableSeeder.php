<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Tag;

class Tag_UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $adminEmail = 'admin@appsoft.in';
      $user       = User::whereEmail($adminEmail)->firstOrfail();
      $tags       = Tag::whereVisibility(1)->get();
      $user->tags()->attach($tags);
    }
}
