<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAppointmentsTableForCallActions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('appointments', function($table){
        $table->dropColumn(['agreed_price']);
        $table->tinyInteger('selected_slot')->nullable()->unsigned();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('appointments', function($table){
        $table->integer('agreed_price');
        $table->dropColumn(['selected_slot']);
      });
    }
}
