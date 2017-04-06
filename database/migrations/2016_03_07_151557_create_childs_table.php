<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('health_card');
            $table->string('family_physician')->nullable();
            $table->string('fam_physician_phone')->nullable();
            $table->string('is_client');
            $table->string('department')->nullable();
            $table->string('is_first_time');
            $table->string('previous_program')->nullable();
            $table->string('languages');
            $table->string('lives_with');
            $table->timestamps();
        });

        DB::table('childs')->insert(
            array(
                'id' => '1',
                'user_id' => '1',
                'first_name' => 'default',
                'last_name' => 'default',
                'dob' => '2000-01-01',
                'health_card' => '1234567890aa',
                'is_client' => 'no',
                'is_first_time' => 'yes',
                'languages' => 'English',
                'lives_with' => 'parent1'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('childs');
    }
}
