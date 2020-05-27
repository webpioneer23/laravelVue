<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                'name'=>'admin',
                'email' => 'admin@gmail.com',
                'password'=>bcrypt('admin'),
                'role'=>'superadmin',
                'img'=>'',
                'created_at'=> date('Y-m-d h:i:s'),
                'updated_at'=>date('Y-m-d h:i:s'),
            ]);
        DB::table('users')->insert([
            [
                'name'=>'owner1',
                'email' => 'own1@gmail.com',
                'password'=>bcrypt('own1'),
                'role'=>'owner',
                'img'=>'',
                'country'=>'fr',
                'payment_status'=>1,
                'status'=>'active',
                'verified'=>1,
                'created_at'=>date('Y-m-d h:i:s'),
                'updated_at'=>date('Y-m-d h:i:s'),
            ],
            [
                'name'=>'owner2',
                'email' => 'own2@gmail.com',
                'password'=>bcrypt('own2'),
                'role'=>'owner',
                'img'=>'',
                'country'=>'ru',
                'payment_status'=>1,
                'status'=>'pending',
                'verified'=>1,
                'created_at'=>date('Y-m-d h:i:s'),
                'updated_at'=>date('Y-m-d h:i:s'),
            ]]);
        DB::table('users')->insert([
            [
                'name'=>'employee1',
                'email' => 'emp1@gmail.com',
                'password'=>bcrypt('emp1'),
                'role'=>'employee',
                'parent_id'=>2,
                'img'=>'',
                'status'=>'active',
                'phone'=>'12345678',
                'hired'=>1,
                'salary'=>300.5,
                'hours'=>30.5,
                'end_date'=>'2022-05-19',
                'created_at'=>date('Y-m-d h:i:s'),
                'updated_at'=>date('Y-m-d h:i:s'),
            ],
            [
                'name'=>'employee2',
                'email' => 'emp2@gmail.com',
                'password'=>bcrypt('emp2'),
                'role'=>'employee',
                'parent_id'=>2,
                'img'=>'',
                'status'=>'active',
                'phone'=>'12345678',
                'hired'=>1,
                'salary'=>300.5,
                'hours'=>30.5,
                'end_date'=>'2022-05-19',
                'created_at'=>date('Y-m-d h:i:s'),
                'updated_at'=>date('Y-m-d h:i:s'),
            ],
            [
                'name'=>'employee3',
                'email' => 'emp3@gmail.com',
                'password'=>bcrypt('emp3'),
                'role'=>'employee',
                'parent_id'=>3,
                'img'=>'',
                'status'=>'active',
                'phone'=>'12345678',
                'hired'=>1,
                'salary'=>300.5,
                'hours'=>30.5,
                'end_date'=>'2022-05-19',
                'created_at'=>date('Y-m-d h:i:s'),
                'updated_at'=>date('Y-m-d h:i:s'),
            ],
        ]);       
    }
}
