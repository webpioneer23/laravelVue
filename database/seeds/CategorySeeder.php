<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name'=>'Real State',
                'created_at'=>Date('Y-m-d h:i:s'),
            ],
            [
                'name'=>'logistics',
                'created_at'=>Date('Y-m-d h:i:s'),
            ],
            [
                'name'=>'Sigorta',
                'created_at'=>Date('Y-m-d h:i:s'),
            ],
            [
                'name'=>'Covid-19',
                'created_at'=>Date('Y-m-d h:i:s'),
            ],
            [
                'name'=>'Cash',
                'created_at'=>Date('Y-m-d h:i:s'),
            ]
        ]);
    }
}
