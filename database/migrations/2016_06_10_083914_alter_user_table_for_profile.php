<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTableForProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function($table){
          $table->string('header_image')->after('password')->default('default-user.jpg');
          $table->string('profile_picture')->after('header_image')->default('default-user.jpg');
          $table->text('short_bio')->after('profile_picture')->nullable();
          $table->text('mini_resume')->after('short_bio')->nullable();
          $table->string('phone', 15)->after('mini_resume')->nullable();
          $table->string('timezone')->after('phone')->nullable();
          $table->string('location')->after('timezone')->nullable();
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
            'header_image',
            'profile_picture',
            'short_bio',
            'mini_resume',
            'phone',
            'timezone',
            'location'
          ]);
      });
    }
}
