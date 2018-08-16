<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableForNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function($table){
        $table->tinyInteger('call_requests')->unsigned()->default(1);
        $table->tinyInteger('call_reminder')->unsigned()->default(1);
        $table->tinyInteger('mc_updates')->unsigned()->default(1);
        $table->tinyInteger('call_management')->unsigned()->default(1);
        $table->tinyInteger('mc_questions')->unsigned()->default(1);
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
          'call_requests',
          'call_reminder',
          'mc_updates',
          'call_management',
          'mc_questions'
        ]);
      });
    }
}
