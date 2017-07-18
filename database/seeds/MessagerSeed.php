<?php

use Illuminate\Database\Seeder;

class MessagerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('messagers')->insert([
            'id'=>1,
            'title_messager'=>'Email  mẫu',
            'content_messager'=>'Đây là nội dung',
            'email_user'=>'huynhphihung1996@gmail.com',
            'flag'=>1,
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
         DB::table('messagers')->insert([
            'id'=>2,
            'title_messager'=>'Email  thứ 2',
            'content_messager'=>'Đây là nội dung thứ 2',
            'email_user'=>'huynhphihung1995@gmail.com',
            'flag'=>1,
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
         DB::table('messagers')->insert([
            'id'=>3,
            'title_messager'=>'Email  mẫu 3',
            'content_messager'=>'Đây là nội dung email thứ 3',
            'email_user'=>'huynhphihung1996@gmail.com',
            'flag'=>0,
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
    }
}
