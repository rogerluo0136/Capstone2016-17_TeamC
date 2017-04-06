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
            $table->integer('child_id');
            $table->string('has_specialneeds');
            $table->string('diagnosis')->nullable();
            $table->string('risk_of_falling');
            $table->string('mobility_support');
            $table->string('need_splints_orthotics');
            $table->string('orthotics_when')->nullable();
            $table->string('need_hand_over_hand');
            $table->string('weight');
            $table->string('need_toiletting_assisstance');
            $table->string('toiletting_details')->nullable();
            $table->string('need_eating_assisstance');
            $table->string('eating_details')->nullable();
            $table->string('need_communication_assisstance');
            $table->string('communication_means');
            $table->string('communicates_yes')->nullable();
            $table->string('communicates_no')->nullable();
            $table->string('overwhelm_noise');//
            $table->string('overwhelm_people');
            $table->string('leaves_group');
            $table->string('harm_others');
            $table->string('harm_self');
            $table->string('successful_participation');
            $table->string('trigger')->nullable();
            $table->string('major_change')->nullable();
            $table->string('activities')->nullable();
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
