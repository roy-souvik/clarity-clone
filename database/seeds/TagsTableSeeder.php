<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
       //DB::table('tags')->truncate();

       $sampleTags = [
         "computer",
         "marketing",
         "social media",
         "finance",
         "building",
         "websites",
         "server",
         "html",
         "laravel",
         "php",
         "css",
         "javascript"
       ];

       foreach ($sampleTags as $sampleTag) {
         DB::table('tags')->insert([
             'name'       => $sampleTag,
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now(),
             'visibility' => 1
         ]);
       }
     }
 }
