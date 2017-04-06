<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePorgramSeasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_season', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_id')->unsigned();
            $table->integer('season_id')->unsigned();
            $table->integer('cost')->unsigned();
            $table->integer('size')->unsigned();//the size of the program being run in the season.
            $table->string('status')->default('on');//on implies thats its not cancelled, off implies that it is cancelled.
            $table->timestamps();
            $table->float('minimum_amount');
            $table->string('schedule');
            $table->string('payment_method')->nullable();

            //we need to make a schedule table
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('program_season');
    }
}
