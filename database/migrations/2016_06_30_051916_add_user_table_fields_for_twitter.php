<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserTableFieldsForTwitter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table){
            $table->string('tw_name', 255)->after('li_image');
            $table->string('tw_id', 50)->after('tw_name');
            $table->string('tw_image', 255)->after('tw_id');
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
            $table->dropColumn('tw_name');
            $table->dropColumn('tw_id');
            $table->dropColumn('tw_image');
        });
    }
}
