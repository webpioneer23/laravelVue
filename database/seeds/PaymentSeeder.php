<?php

use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            'currency_id'=>1,
            'paypal_status' => 1,
            'paypal_mode' =>1,
            'paypal_account'=>'2kbd.noyon-facilitator@gmail.com',
            'stripe_status'=>1,
            'publish_key'=>'pk_test_miL3pzy2WRveqVtkSvnAiyEk00TbcdiWmW',
            'secret_key'=>'sk_test_zHkX8tpxqezUjxwKKrOENoKH00i4EnkxdN',
        ]);
        
    }
}
