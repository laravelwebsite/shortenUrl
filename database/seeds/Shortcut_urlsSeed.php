<?php

use Illuminate\Database\Seeder;

class Shortcut_urlsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shortcut_urls')->insert([
        	'id'=>1,
        	'shortcut_url'=>'a87ff',
        	'category_id'=>9,
        	'purpose'=>'Khong gi',
        	'iduser_create'=>1,
        	'email_user'=>'huynhphihung1995@gmail.com',
        	'wait_check'=>1,
        	'count_click'=>5,
        	'source'=>0,
        	'job_id'=>'5394',
        	'redirect'=>'https://topdev.vn/detail-jobs/senior-php-developer-laravel-codeigniter-600-900-5394',
        	'fileupload_name'=>'UDUr6Z3yQ1_Screenshot from 2017-07-13 15-43-31.png',
        	'title'=>'nothing',
        	'region'=>'',
        	'description'=>'nothing',
        	'date_begin_seeder'=>date('Y-m-d'),
        	'id_user_seeder'=>3,
        	'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('shortcut_urls')->insert([
        	'id'=>2,
        	'shortcut_url'=>'a87ff',
        	'category_id'=>3,
        	'purpose'=>'Khong gi',
        	'iduser_create'=>2,
        	'email_user'=>'huynhphihung1996@gmail.com',
        	'wait_check'=>1,
        	'count_click'=>5,
        	'source'=>0,
        	'job_id'=>'5394',
        	'redirect'=>'https://topdev.vn/detail-jobs/senior-php-developer-laravel-codeigniter-600-900-5394',
        	'fileupload_name'=>'UDUr6Z3yQ1_Screenshot from 2017-07-13 15-43-31.png',
        	'title'=>'khong gi',
        	'region'=>'',
        	'description'=>'khong gi',
        	'date_begin_seeder'=>date('Y-m-d'),
        	'id_user_seeder'=>3,
        	'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
    }
}
