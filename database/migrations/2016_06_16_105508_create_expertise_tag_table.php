<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpertiseTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expertise_tag', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('expertise_id')->unsigned()->index();
            $table->integer('tag_id')->unsigned()->index();
			$table->timestamps();
            $table->foreign('expertise_id')->references('id')->on('expertises'); //->onDelete('cascade');
			$table->foreign('tag_id')->references('id')->on('tags'); //->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('expertise_tag');
    }
}
