<?php

use Illuminate\Database\Seeder;

class PaymentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_payments')->insert([
            [
                'user_id'=>2,
                'package_type_id'=>1,
                'subscription_type'=>1,
                'payment_status'=>0,
            ],
            [
                'user_id'=>3,
                'package_type_id'=>3,
                'subscription_type'=>1,
                'payment_status'=>1,
            ]
        ]);
    }
}
