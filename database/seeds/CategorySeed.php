<?php

use Illuminate\Database\Seeder;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'id'=>1,
            'categoryname'=>'Mời ứng viên Apply/ Verify ứng viên',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
        DB::table('categories')->insert([
            'id'=>2,
            'categoryname'=>'Email/Marketing',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
        DB::table('categories')->insert([
            'id'=>3,
            'categoryname'=>'Manager seeder',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
        DB::table('categories')->insert([
            'id'=>4,
            'categoryname'=>'Devvui Ads',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
        DB::table('categories')->insert([
            'id'=>5,
            'categoryname'=>'Facebook Ad',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
        DB::table('categories')->insert([
            'id'=>6,
            'categoryname'=>'Slimshare',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
        DB::table('categories')->insert([
            'id'=>7,
            'categoryname'=>'Quảng cáo site vệ tinh',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
        DB::table('categories')->insert([
            'id'=>8,
            'categoryname'=>'TopDev Banner',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
        DB::table('categories')->insert([
            'id'=>9,
            'categoryname'=>'Others',
            'created_at'=>date('Y-m-d'),
            'updated_at'=>date('Y-m-d')
        ]);
    }
}
