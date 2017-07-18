<?php

use Illuminate\Database\Seeder;
use App\User;


class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'=>1,
            'name' => 'Huynh Phi Hung',
            'email' => 'huynhphihung1995@gmail.com',
            'password' => bcrypt('123456'),
            'role_id'=>1,
            'phone'=>'0963560780', 
            'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('users')->insert([
            'id'=>2,
            'name' => 'Huynh Phi Hung 2',
            'email' => 'huynhphihung1996@gmail.com',
            'password' => bcrypt('123456'),
            'role_id'=>0,
            'phone'=>'0963560780', 
            'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('users')->insert([
            'id'=>3,
            'name' => 'Sub Admin',
            'email' => 'huynhphihung1997@gmail.com',
            'password' => bcrypt('123456'),
            'role_id'=>2,
            'phone'=>'0963560780', 
            'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
    }
}
