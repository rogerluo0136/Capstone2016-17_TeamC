<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('child_id')->unsigned();
            $table->string('parent_1_name');
            $table->string('parent_1_email');
            $table->string('parent_1_address');
            $table->string('parent_1_city');
            $table->string('parent_1_province');
            $table->string('parent_1_postal');
            $table->string('parent_1_home_tel')->nullable();
            $table->string('parent_1_work_tel')->nullable();
            $table->string('parent_1_cell_phone');
            $table->string('parent_2_name')->nullable();
            $table->string('parent_2_email')->nullable();
            $table->string('parent_2_address')->nullable();
            $table->string('parent_2_city')->nullable();
            $table->string('parent_2_province')->nullable();
            $table->string('parent_2_postal')->nullable();
            $table->string('parent_2_home_tel')->nullable();
            $table->string('parent_2_work_tel')->nullable();
            $table->string('parent_2_cell_phone')->nullable();
            $table->string('lives_with');
            $table->string('language');
            $table->string('emerg_contact');
            $table->string('emerg_contact_phone');
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
        Schema::drop('contacts');
    }
}
