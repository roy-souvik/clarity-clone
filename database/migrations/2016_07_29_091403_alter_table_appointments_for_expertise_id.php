<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAppointmentsForExpertiseId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('appointments', function($table){
        $table->integer('expertise_id')->unsigned()->index();
        $table->foreign('expertise_id')->references('id')->on('expertises');
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
         $table->dropForeign('appointments_expertise_id_foreign');
         $table->dropColumn('expertise_id');
      });
    }
}
