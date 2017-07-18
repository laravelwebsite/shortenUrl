<?php

use Illuminate\Database\Seeder;

class ListjobSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('list_job_ids')->insert([
            'job_id'=>1,
            'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('list_job_ids')->insert([
            'job_id'=>2,
            'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('list_job_ids')->insert([
            'job_id'=>3,
            'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('list_job_ids')->insert([
            'job_id'=>4,
            'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('list_job_ids')->insert([
            'job_id'=>5,
            'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('list_job_ids')->insert([
            'job_id'=>6,
            'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('list_job_ids')->insert([
            'job_id'=>7,
            'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('list_job_ids')->insert([
            'job_id'=>8,
            'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('list_job_ids')->insert([
            'job_id'=>9,
            'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('list_job_ids')->insert([
            'job_id'=>10,
            'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
        DB::table('list_job_ids')->insert([
            'job_id'=>11,
            'created_at'=>date('Y-m-d'), 
            'updated_at'=>date('Y-m-d'), 
        ]);
    }
}
