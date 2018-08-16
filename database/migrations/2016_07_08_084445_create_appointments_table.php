<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('appointments', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('requester_id')->unsigned()->index();
          $table->integer('expert_id')->unsigned()->index();
          $table->text('message');
          $table->integer('requested_call_length');
          $table->integer('actual_call_length');
          $table->DateTime('time_preference_1');
          $table->DateTime('time_preference_2');
          $table->DateTime('time_preference_3');
          $table->integer('is_confirmed');
          $table->integer('is_executed');
          $table->integer('agreed_price');
          $table->timestamps();
          $table->foreign('requester_id')->references('id')->on('users'); //->onDelete('cascade');
          $table->foreign('expert_id')->references('id')->on('users'); //->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('appointments');
    }
}
