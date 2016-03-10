<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePainManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pain_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('experiences_seizures');
            $table->date('last_seizure')->nullable();
            $table->string('seizure_frequency')->nullable();
            $table->string('seizure_trigger')->nullable();
            $table->string('seizure_medication')->nullable();
            $table->string('pain_indication');
            $table->string('pain_alleviation');
            $table->string('pain_requirements')->nullable();
            $table->integer('child_id')->unsigned();

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
        Schema::drop('pain_managements');
    }
}
