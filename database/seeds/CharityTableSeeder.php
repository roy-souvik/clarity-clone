<?php

use Illuminate\Database\Seeder;

class CharityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $sampleNames = [
        "DonorsChoose.org",
        "Pencils of Promise",
        "charity:water",
        "HelpAge India.org",
        "GreenPeace.com"

      ];

      foreach ($sampleNames as $sampleName) {
        DB::table('charity')->insert([
            'name' => $sampleName,
          ]);
      }
    }
}
