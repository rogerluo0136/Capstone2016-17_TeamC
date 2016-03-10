<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialNeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_needs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('risk_of_falling');
            $table->string('mobility_support');
            $table->string('requires_orthotics');
            $table->string('orthotics_when')->nullable();
            $table->string('hand_over_hand_assisstance');
            $table->string('toiletting_assisstance');
            $table->string('toiletting_details')->nullable();
            $table->string('eating_assisstance');
            $table->string('eating_details')->nullable();
            $table->string('communication_assisstance');
            $table->string('communication_means');
            $table->string('communicates_yes');
            $table->string('communicates_no');
            $table->integer('weight');
            $table->integer('child_id');
            $table->string('overwhelm_noise');//
            $table->string('overwhelm_people');
            $table->string('leaves_group');
            $table->string('harm_others');
            $table->string('harm_self');
            $table->string('successful_participation');
            $table->string('trigger');
            $table->string('major_change');
            $table->string('activities');
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
        Schema::drop('special_needs');
    }
}
