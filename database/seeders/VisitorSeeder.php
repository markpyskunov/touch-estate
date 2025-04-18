<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Illuminate\Database\Seeder;
use App\Models\Location;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class VisitorSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $locations = Location::all();
        $locationNotes = [
            'Great location, close to schools and parks. Need to check the garage size.',
            'Called agent about the roof age - was replaced in 2020.',
        ];

        foreach ($locations as $location) {
            for ($i = 0; $i < 12; $i++) {
                /** @var Visitor $visitor */
                $visitor = $location->visitors()->create([
                    'vid' => Str::uuid(),
                    'collected_data' => [
                        'full_name' => $faker->name(),
                        'emails' => [
                            $faker->safeEmail(),
                        ],
                    ],
                    'visits' => [
                        [
                            'created_at' => now()->subDays(4),
                            'type' => 'qr',
                        ],
                        [
                            'created_at' => now()->subDays(3),
                            'type' => 'nfc',
                        ],
                        [
                            'created_at' => now()->subDays(2),
                            'type' => 'website',
                        ],
                    ],
                ]);

                foreach ($locationNotes as $locationNote) {
                    $visitor->locationNotes()->create([
                        'location_id' => $location->id,
                        'note' => $locationNote,
                    ]);
                }
            }
        }
    }
}
