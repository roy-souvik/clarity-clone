<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('feedback', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('appointment_id')->unsigned()->index();
        $table->integer('call_id')->unsigned()->index();
        $table->string('title')->nullable();
        $table->text('description')->nullable();
        $table->integer('rating')->unsigned();
        $table->timestamps();
        $table->foreign('appointment_id')->references('id')->on('appointments');
        $table->foreign('call_id')->references('id')->on('calls');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      Schema::drop('feedback');
  }
}
