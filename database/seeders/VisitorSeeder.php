<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;
use Faker\Factory as Faker;

class VisitorSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $locations = Location::all();

        foreach ($locations as $location) {
            for ($i = 0; $i < 12; $i++) {
                $location->visitors()->create([
                    'collected_data' => [
                        'name' => $faker->name(),
                        'email' => $faker->safeEmail(),
                        'phone' => $faker->phoneNumber(),
                    ],
                ]);
            }
        }
    }
}
