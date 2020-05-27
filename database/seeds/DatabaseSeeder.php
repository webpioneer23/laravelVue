<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PackageSeeder::class);
        $this->call(PackageTypeSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(PaymentUserSeeder::class);
        $this->call(TicketSeeder::class);
    }
}
