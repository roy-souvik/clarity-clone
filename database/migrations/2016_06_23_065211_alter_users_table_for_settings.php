<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableForSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function($table){
        $table->string('address_line1')->nullable();
        $table->string('address_line2')->nullable();
        $table->string('city')->nullable();
        $table->string('state')->nullable();
        $table->string('zip_code', 20)->nullable();
        $table->string('country')->nullable();
        $table->string('card_number')->nullable();
        $table->string('cvv')->nullable();
        $table->string('expire_month', 10)->nullable();
        $table->string('expire_year', 4)->nullable();
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
            'address_line1',
            'address_line2',
            'city',
            'state',
            'zip_code',
            'country',
            'card_number',
            'cvv',
            'expire_month',
            'expire_year'
          ]);
      });
    }
}
