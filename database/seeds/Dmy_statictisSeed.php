<?php

use Illuminate\Database\Seeder;

class Dmy_statictisSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dmy_statictis')->insert([
        	'id'=>1,
        	'shortcut_url'=>'a87ff',
        	'count_click'=>5,
        	'date_statistic'=>date('Y-m-d'),
        	'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('dmy_statictis')->insert([
        	'id'=>2,
        	'shortcut_url'=>'a87ff',
        	'count_click'=>5,
        	'date_week'=>29,
        	'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('dmy_statictis')->insert([
        	'id'=>3,
        	'shortcut_url'=>'a87ff',
        	'count_click'=>5,
        	'date_month'=>date('m'),
        	'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
    }
}
