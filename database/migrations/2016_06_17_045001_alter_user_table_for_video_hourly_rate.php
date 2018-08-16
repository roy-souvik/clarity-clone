<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTableForVideoHourlyRate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table){
          $table->string('video_link');
          $table->integer('hourly_rate')->unsigned()->default(0);

          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function($table){
        $table->dropColumn([
            'video_link',
            'hourly_rate',
          ]);
      });
    }
}
