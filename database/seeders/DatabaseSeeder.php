<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            AddressSeeder::class,
            CompanySeeder::class,
            UserSeeder::class,
            LocationSeeder::class,
            NfcQrTagSeeder::class,
            VisitorSeeder::class,
        ]);
    }
}
