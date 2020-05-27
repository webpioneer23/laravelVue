<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            [
                'name'=>'Bulgaria-BGN (лв) ',
                'created_at'=>Date('Y-m-d h:i:s'),
                'updated_at'=>Date('Y-m-d h:i:s'),
            ],
            [
                'name'=>'Greece  -  EUR (€)',
                'created_at'=>Date('Y-m-d h:i:s'),
                'updated_at'=>Date('Y-m-d h:i:s'),
            ],
        ]);
    }
}
