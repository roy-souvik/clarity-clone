<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;
use App\UserRole;

class UsersTableSeeder extends Seeder
{
  private $faker;

  public function __construct()
  {
    $this->faker  = Faker\Factory::create();
  }

  private function getUsers($count = 10)
  {
    $faker  = $this->faker;
    $users  = [];

    for ($i=0; $i < $count; $i++) {
      $user                = new User;
      $user->first_name    = $faker->firstName;
      $user->last_name     = $faker->lastName;
      $user->email         = $faker->freeEmail;
      $user->password      = bcrypt('11111111');
      $user->username      = str_slug($user->first_name . ' ' . $user->last_name);
      $user->short_bio     = $faker->text(50);
      $user->mini_resume   = $faker->realText(150, 2);
      $user->phone         = $faker->e164PhoneNumber;
      $user->confirmed     = 1;
      $user->address_line1 = $faker->streetAddress;
      $user->city          = $faker->city;
      $user->location      = $faker->city;
      $user->state         = $faker->state;
      $user->country       = $faker->country;
      $user->zip_code      = $faker->postcode;
      $user->created_at    = Carbon::now();
      $user->updated_at    = Carbon::now();

      $users[]  = $user;
    }
    return $users;
  }

  private function assignUserRole($user)
  {
    $userRole = UserRole::where('level', 3)->where('slug', 'user')->first();
    return DB::table('role_user')->insert([
      'role_id' => $userRole->id,
      'user_id' => $user->id,
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now()
    ]);
  }

  private function buildExpert($user)
  {
    $user->li_id            = str_random(8);
    $user->expert_applied   = 1;
    return $user;
  }

  public function makeExpertApplication($count = 10)
  {
    $users  = $this->getUsers($count);

    foreach ($users as $user) {
      $user = $this->buildExpert($user);
      $user->save(); //Persist the user in DB
      $this->assignUserRole($user); //Persist user role in DB for the current user
    }
  }

    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
      $faker                = $this->faker;

      $admin                = new \stdClass;
      $admin->first_name    = 'Super';
      $admin->last_name     = 'Admin';
      $admin->email         = 'admin@appsoft.in';
      $admin->username      = str_slug($admin->first_name . ' ' . $admin->last_name);
      $admin->phone         = '9876543210';

      $user                = new \stdClass;
      $user->first_name    = $faker->firstNameMale;
      $user->last_name     = $faker->lastName;
      $user->email         = 'user@appsoft.in';
      $user->username      = str_slug($user->first_name . ' ' . $user->last_name);
      $user->phone         = '9876543211';

//==============================================================================
      // World users
      DB::table('users')->insert([
        'first_name'    => 'Admin',
        'last_name'     => 'One',
        'email'         => 'admin@itechnowiz.com',
        'username'      => str_slug('Admin One'),
        'phone'         => '88888888',
        'password'      => bcrypt('12345678'),
        'short_bio'     => $faker->text(50),
        'mini_resume'   => $faker->realText(150, 2),
        'confirmed'     => 1,
        'address_line1' => $faker->streetAddress,
        'city'          => $faker->city,
        'location'      => $faker->city,
        'state'         => $faker->state,
        'country'       => $faker->country,
        'zip_code'      => $faker->postcode,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now(),
      ]);

      DB::table('users')->insert([
        'first_name'    => 'Dave',
        'last_name'     => 'Dutt',
        'email'         => 'response2dave@gmail.com',
        'username'      => str_slug('Dave Dutt'),
        'phone'         => '88888888',
        'password'      => bcrypt('12345678'),
        'short_bio'     => $faker->text(50),
        'mini_resume'   => $faker->realText(150, 2),
        'confirmed'     => 1,
        'address_line1' => $faker->streetAddress,
        'city'          => $faker->city,
        'location'      => $faker->city,
        'state'         => $faker->state,
        'country'       => $faker->country,
        'zip_code'      => $faker->postcode,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now(),
      ]);

      DB::table('users')->insert([
        'first_name'    => 'Partha Pratim',
        'last_name'     => 'Sarkar',
        'email'         => 'parthacse21@gmail.com',
        'username'      => str_slug('Partha Pratim Sarkar'),
        'phone'         => '88888888',
        'password'      => bcrypt('12345678'),
        'short_bio'     => $faker->text(50),
        'mini_resume'   => $faker->realText(150, 2),
        'confirmed'     => 1,
        'address_line1' => $faker->streetAddress,
        'city'          => $faker->city,
        'location'      => $faker->city,
        'state'         => $faker->state,
        'country'       => $faker->country,
        'zip_code'      => $faker->postcode,
        'created_at'    => Carbon::now(),
        'updated_at'    => Carbon::now(),
      ]);

//==============================================================================

      $users   = array($admin, $user);
      foreach ($users as $user) {
        DB::table('users')->insert([
          'first_name'    => $user->first_name,
          'last_name'     => $user->last_name,
          'email'         => $user->email,
          'password'      => bcrypt('12345678'),
          'username'      => $user->username,
          'short_bio'     => $faker->text(50),
          'mini_resume'   => $faker->realText(150, 2),
          'phone'         => $user->phone,//$faker->phoneNumber,
		      'confirmed'     => 1,
          'address_line1' => $faker->streetAddress,
          'city'          => $faker->city,
          'location'      => $faker->city,
          'state'         => $faker->state,
          'country'       => $faker->country,
          'zip_code'      => $faker->postcode,
          'created_at'    => Carbon::now(),
          'updated_at'    => Carbon::now()
        ]);
      }

    // Make Expert Applications
    $this->makeExpertApplication(20);

    } // END run()
}
