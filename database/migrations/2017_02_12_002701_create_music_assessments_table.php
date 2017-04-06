<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music_assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('child_id')->unsigned();
            $table->string('assessment_status')->default('inquired');
            $table->integer('preferred_therapist_id');
            $table->string('preferred_therapist_name');
            $table->string('preferred_instrument');
            $table->string('time_first_choice')->unsined();
            $table->string('time_second_choice')->unsined();
            $table->string('time_third_choice')->unsined();
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
        Schema::drop('music_assessments');
    }
}
