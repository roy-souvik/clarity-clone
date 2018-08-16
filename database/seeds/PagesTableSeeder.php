<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $table, $faker;

    public function __construct()
    {
      $this->table  = 'pages';
      $this->faker  = Faker\Factory::create();
    }

    public function run()
    {

      DB::table($this->table)->truncate();

      $staticPages = [
        "How It Works",
        "About Us",
        "Feedback",
        "Community",
        "Trust : Safety",
        "Help : Support",
        "Terms Of Service",
        "Privacy Policy",
        "Cookie Policy"
      ];

      foreach ($staticPages as $staticPage) {
        DB::table($this->table)->insert([
            'title'       => $staticPage,
            'slug'        => str_slug($staticPage),
            'content'     => $this->faker->realText(1500, 2),
             'created_at' => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);
      }
    }
}
