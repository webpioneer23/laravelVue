<?php

use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            [
                'name'=>'Invoices',
                'level1'=>5,
                'level2'=>-1,
                'level3'=>-1,
            ],
            [
                'name'=>'Estimates',
                'level1'=>20,
                'level2'=>-1,
                'level3'=>-1,
            ],
            [
                'name'=>'Customers',
                'level1'=>10,
                'level2'=>-1,
                'level3'=>-1,
            ],
            [
                'name'=>'Business',
                'level1'=>5,
                'level2'=>500,
                'level3'=>1000,
            ],
            [
                'name'=>'Invoice templates (Select max value 5 )',
                'level1'=>3,
                'level2'=>4,
                'level3'=>5,
            ],

            
        ]);
    }
}
