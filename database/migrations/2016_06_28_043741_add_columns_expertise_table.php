<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsExpertiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expertises', function($table){
            $table->string('slug', 50)->after('cover_image');
            $table->string('cover_image', 255)->default('no-expertise-image.jpg')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expertises', function($table){
            $table->dropColumn([ 'slug' ]);
            $table->string('cover_image', 255)->change();
        });
    }
}
