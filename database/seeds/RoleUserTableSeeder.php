<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserRole;
use Carbon\Carbon;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $adminEmail = 'admin@appsoft.in';
      $users      = DB::table('users')->get();
      $adminRole  = DB::table('roles')->where('slug', 'admin')->first()->id;
      $userRole   = DB::table('roles')->where('slug', 'user')->first()->id;

      foreach ($users as $user) {
        DB::table('role_user')->insert([
          'role_id' => ($user->email == $adminEmail) ? $adminRole : $userRole,
          'user_id' => $user->id,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
        ]);
      }

      $adminRole = UserRole::where('level', 1)->first();
      $expertRole = UserRole::where('level', 2)->first();
      $userRole = UserRole::where('level', 3)->first();
      $worldAdmin = User::where('email', 'admin@itechnowiz.com')->first();
      $worldUser = User::where('email', 'response2dave@gmail.com')->first();
      $worldExpert = User::where('email', 'parthacse21@gmail.com')->first();
      DB::table('role_user')->insert([
          'role_id' => $adminRole->id,
          'user_id' => $worldAdmin->id,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
      ]);
      DB::table('role_user')->insert([
          'role_id' => $userRole->id,
          'user_id' => $worldUser->id,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
      ]);
      DB::table('role_user')->insert([
          'role_id' => $expertRole->id,
          'user_id' => $worldExpert->id,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
      ]);

    }
}
