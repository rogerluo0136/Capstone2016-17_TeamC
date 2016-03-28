<?php

use Illuminate\Database\Seeder;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programs')->insert([
            'name' => 'Artistic Coloring Therapy',
            'category' => 'Music',
            'min_age' => 8,
            'end' => Carbon::now()->addMonths(8),
            'weeks'=>4,
            'active'=>'yes'
        ]);
    }
}
