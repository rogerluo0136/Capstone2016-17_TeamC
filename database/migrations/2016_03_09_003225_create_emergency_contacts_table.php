<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmergencyContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergency_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('relationship');
            $table->string('email');
            $table->string('street_address');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            $table->string('cell_phone');
            $table->string('home_phone')->nullable();
            $table->string('work_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('emergency_contacts');
    }
}
