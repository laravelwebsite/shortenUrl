<?php

use Illuminate\Database\Seeder;

class SeederSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seeders')->insert([
        	'id'=>1,
        	'shortcut_url'=>'a87ff',
        	'referer'=>'fd.shortenlink.vn',
        	'count_click'=>5,
        	'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('seeders')->insert([
        	'id'=>2,
        	'shortcut_url'=>'e4da3',
        	'referer'=>'https://www.facebook.com/',
        	'count_click'=>5,
        	'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('seeders')->insert([
        	'id'=>3,
        	'shortcut_url'=>'c81e7',
        	'referer'=>'https://www.facebook.com/',
        	'count_click'=>5,
        	'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
    }
}
