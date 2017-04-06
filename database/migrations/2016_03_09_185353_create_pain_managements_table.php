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
            $table->integer('child_id')->unsigned();
            $table->string('experiences_seizures');
            $table->date('last_seizure')->nullable();
            $table->string('seizure_details')->nullable();
            $table->string('seizure_medication');
            $table->string('pain_indication');
            $table->string('pain_alleviation');
            $table->string('pain_requirements')->nullable();
            $table->string('requirement_other_details')->nullable();
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
