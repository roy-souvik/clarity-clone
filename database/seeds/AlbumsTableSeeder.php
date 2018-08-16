<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $table, $faker;

    public function __construct()
    {
      $this->table  = 'albums';
      $this->faker  = Faker\Factory::create();
    }

    public function run()
    {
      $worldAdmin = User::where('email', 'admin@appsoft.in')->first();
        $staticNames = [
        "Banners",
        "Categories"
      ];

      foreach ($staticNames as $staticName) {
        DB::table($this->table)->insert([
          'user_id'    => $worldAdmin->id,
            'name'       => $staticName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
      }
    }
}