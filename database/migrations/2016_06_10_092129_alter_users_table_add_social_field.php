<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableAddSocialField extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table){
            $table->boolean('is_social')->after('password');
            $table->string('fb_name', 255)->after('is_social');
            $table->string('fb_id', 50)->after('fb_name');
            $table->string('fb_image', 255)->after('fb_id');
            $table->string('li_name', 255)->after('fb_image');
            $table->string('li_id', 50)->after('li_name');
            $table->string('li_image', 255)->after('li_id');
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
            $table->dropColumn('is_social');
            $table->dropColumn('fb_name');
            $table->dropColumn('fb_id');
            $table->dropColumn('fb_image');
            $table->dropColumn('li_name');
            $table->dropColumn('li_id');
            $table->dropColumn('li_image');
        });
    }

}
