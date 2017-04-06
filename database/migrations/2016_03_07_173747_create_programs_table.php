<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('category');//music and arts
            $table->integer('min_age');
            $table->integer('max_age');
            $table->string('type');//group or individual
            $table->string('description');
            $table->integer('months_since_checkup')->unsigned()->nullable();
            $table->integer('min_assessment_date')->unsigned()->nullable();//max months since last checkup
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
        Schema::drop('programs');
    }
}
