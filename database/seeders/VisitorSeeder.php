<?php

namespace Database\Seeders;

use App\Enums\VisitorActivityAggregationType;
use App\Enums\VisitorActivityEvent;
use App\Enums\VisitorActivityType;
use App\Models\Visitor;
use App\Models\VisitorActivityAggregation;
use Illuminate\Database\Seeder;
use App\Models\Location;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
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
                $visitor = Visitor::create([
                    'id' => Str::uuid(),
                ]);

                DB::table('visitor_activities')->insert([
                    'id' => Str::uuid(),
                    'visitor_id' => $visitor->id,
                    'location_id' => $location->id,
                    'campaign_id' => $location->campaign_id,
                    'type' => VisitorActivityType::DATA_POINT,
                    'event' => VisitorActivityEvent::COLLECTED_DATA_POINT,
                    'metadata' => json_encode([
                        'full_name' => $faker->name(),
                    ]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                DB::table('visitor_activities')->insert([
                    'id' => Str::uuid(),
                    'visitor_id' => $visitor->id,
                    'location_id' => $location->id,
                    'campaign_id' => $location->campaign_id,
                    'type' => VisitorActivityType::DATA_POINT,
                    'event' => VisitorActivityEvent::COLLECTED_DATA_POINT,
                    'metadata' => json_encode([
                        'email' => $faker->safeEmail(),
                    ]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $visits = [
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
                ];

                foreach ($visits as $visit) {
                    DB::table('visitor_activities')->insert([
                        'id' => Str::uuid(),
                        'visitor_id' => $visitor->id,
                        'location_id' => $location->id,
                        'campaign_id' => $location->campaign_id,
                        'type' => VisitorActivityType::VISITS,
                        'event' => VisitorActivityEvent::VISIT,
                        'metadata' => json_encode([
                            'type' => $visit['type'],
                        ]),
                        'created_at' => $visit['created_at'],
                        'updated_at' => $visit['created_at'],
                    ]);
                }

                VisitorActivityAggregation::create([
                    'location_id' => $location->id,
                    'aggregation_type' => VisitorActivityAggregationType::ALL_TIME,
                    'event' => VisitorActivityEvent::LIKE,
                    'year' => null,
                    'month' => null,
                    'week' => null,
                    'day' => null,
                    'value' => '21',
                ]);
                VisitorActivityAggregation::create([
                    'location_id' => $location->id,
                    'aggregation_type' => VisitorActivityAggregationType::ALL_TIME,
                    'event' => VisitorActivityEvent::SUBSCRIBE,
                    'year' => null,
                    'month' => null,
                    'week' => null,
                    'day' => null,
                    'value' => '12',
                ]);
                VisitorActivityAggregation::create([
                    'location_id' => $location->id,
                    'aggregation_type' => VisitorActivityAggregationType::ALL_TIME,
                    'event' => VisitorActivityEvent::SUBSCRIBE,
                    'year' => null,
                    'month' => null,
                    'week' => null,
                    'day' => null,
                    'value' => '12',
                ]);
                VisitorActivityAggregation::create([
                    'location_id' => $location->id,
                    'aggregation_type' => VisitorActivityAggregationType::ALL_TIME,
                    'event' => VisitorActivityEvent::VISIT,
                    'year' => null,
                    'month' => null,
                    'week' => null,
                    'day' => null,
                    'value' => '12',
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
