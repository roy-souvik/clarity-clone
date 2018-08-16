<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('album_id')->unsigned()->index();         
            $table->string('photo_link')->nullable();
            $table->timestamps();
            $table->foreign('album_id')->references('id')->on('albums'); //->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('photos');
    }
}
