<?php

use Illuminate\Database\Seeder;

class ProgramSeasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seasons')->insert([
            'season' => 'summer',
            'year' => Carbon::now()->year,
            'start' => Carbon::now()->addMonths(4),
            'end' => Carbon::now()->addMonths(8),
            'weeks'=>4,
            'active'=>'yes'
        ]);
    }
}
