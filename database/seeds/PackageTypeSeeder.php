<?php

use Illuminate\Database\Seeder;

class PackageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('package_types')->insert([
            [
                'name' => 'Basic',
                'monthly_price'=> 0,
                'year_price'=> 0,
            ],
            [
                'name' => 'Standard',
                'monthly_price'=> 5,
                'year_price'=> 50,
            ],
            [
                'name' => 'Premium',
                'monthly_price'=> 10,
                'year_price'=> 100,
            ],
        ]);
    }
}
