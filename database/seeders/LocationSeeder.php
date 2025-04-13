<?php

namespace Database\Seeders;

use App\Enums\LocationFeatureName;
use App\Models\Address;
use App\Models\Company;
use Illuminate\Database\Seeder;
use App\Models\Location;
use Faker\Factory as Faker;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $locations = [
            [
                'name' => 'Victoria Waterfront',
                'address' => '1000 Wharf St, Victoria, BC',
                'location_features' => [
                    LocationFeatureName::WATERFRONT->value => true,
                    LocationFeatureName::DOWNTOWN->value => true,
                    LocationFeatureName::PARKING->value => true,
                    LocationFeatureName::PUBLIC_TRANSIT->value => true,
                    LocationFeatureName::WALK_SCORE->value => 95,
                    LocationFeatureName::BIKE_SCORE->value => 90,
                    LocationFeatureName::TRANSIT_SCORE->value => 85
                ],
                'location_pricing' => [
                    [
                        'currency' => 'CAD',
                        'price_before' => 600_000_00,
                        'price_after' => null,
                        'active_from' => now()->subDays(30),
                    ],
                    [
                        'currency' => 'USD',
                        'price_before' => 600_000_00,
                        'price_after' => 590_000_00,
                        'active_from' => now()->subDay(),
                    ],
                ]
            ],
            [
                'name' => 'Saanich Peninsula',
                'description' => 'Quiet suburban neighborhood with excellent schools and family-friendly amenities.',
                'address' => '7800 East Saanich Rd, Saanichton, BC',
                'location_features' => [
                    LocationFeatureName::WATERFRONT->value => false,
                    LocationFeatureName::DOWNTOWN->value => false,
                    LocationFeatureName::PARKING->value => true,
                    LocationFeatureName::PUBLIC_TRANSIT->value => true,
                    LocationFeatureName::WALK_SCORE->value => 65,
                    LocationFeatureName::BIKE_SCORE->value => 75,
                    LocationFeatureName::TRANSIT_SCORE->value => 70
                ],
                'location_pricing' => [
                    [
                        'currency' => 'CAD',
                        'price_before' => 600_000_00,
                        'price_after' => null,
                        'active_from' => now()->subDays(30),
                    ],
                    [
                        'currency' => 'USD',
                        'price_before' => 600_000_00,
                        'price_after' => 590_000_00,
                        'active_from' => now()->subDay(),
                    ],
                ]
            ],
            [
                'name' => 'Oak Bay',
                'description' => 'Upscale residential area known for its heritage homes and ocean views.',
                'address' => '2200 Oak Bay Ave, Victoria, BC',
                'location_features' => [
                    LocationFeatureName::WATERFRONT->value => true,
                    LocationFeatureName::DOWNTOWN->value => false,
                    LocationFeatureName::PARKING->value => true,
                    LocationFeatureName::PUBLIC_TRANSIT->value => true,
                    LocationFeatureName::WALK_SCORE->value => 85,
                    LocationFeatureName::BIKE_SCORE->value => 80,
                    LocationFeatureName::TRANSIT_SCORE->value => 75
                ],
                'location_pricing' => [
                    [
                        'currency' => 'CAD',
                        'price_before' => 600_000_00,
                        'price_after' => null,
                        'active_from' => now()->subDays(30),
                    ],
                    [
                        'currency' => 'USD',
                        'price_before' => 600_000_00,
                        'price_after' => 590_000_00,
                        'active_from' => now()->subDay(),
                    ],
                ]
            ],
            [
                'name' => 'Langford',
                'description' => 'Fast-growing community with modern amenities and easy access to Victoria.',
                'address' => '2625 Peatt Rd, Langford, BC',
                'location_features' => [
                    LocationFeatureName::WATERFRONT->value => false,
                    LocationFeatureName::DOWNTOWN->value => false,
                    LocationFeatureName::PARKING->value => true,
                    LocationFeatureName::PUBLIC_TRANSIT->value => true,
                    LocationFeatureName::WALK_SCORE->value => 60,
                    LocationFeatureName::BIKE_SCORE->value => 70,
                    LocationFeatureName::TRANSIT_SCORE->value => 65
                ],
                'location_pricing' => [
                    [
                        'currency' => 'CAD',
                        'price_before' => 600_000_00,
                        'price_after' => null,
                        'active_from' => now()->subDays(30),
                    ],
                    [
                        'currency' => 'USD',
                        'price_before' => 600_000_00,
                        'price_after' => 590_000_00,
                        'active_from' => now()->subDay(),
                    ],
                ]
            ],
            [
                'name' => 'Sidney',
                'description' => 'Charming seaside town with a vibrant downtown and marina.',
                'address' => '2425 Beacon Ave, Sidney, BC',
                'location_features' => [
                    LocationFeatureName::WATERFRONT->value => true,
                    LocationFeatureName::DOWNTOWN->value => true,
                    LocationFeatureName::PARKING->value => true,
                    LocationFeatureName::PUBLIC_TRANSIT->value => true,
                    LocationFeatureName::WALK_SCORE->value => 80,
                    LocationFeatureName::BIKE_SCORE->value => 75,
                    LocationFeatureName::TRANSIT_SCORE->value => 70
                ],
                'location_pricing' => [
                    [
                        'currency' => 'CAD',
                        'price_before' => 600_000_00,
                        'price_after' => null,
                        'active_from' => now()->subDays(30),
                    ],
                    [
                        'currency' => 'USD',
                        'price_before' => 600_000_00,
                        'price_after' => 590_000_00,
                        'active_from' => now()->subDay(),
                    ],
                ]
            ],
            [
                'name' => 'Cowichan Valley',
                'description' => 'Rural area known for its wineries and agricultural land.',
                'address' => '2000 Cowichan Bay Rd, Cowichan Bay, BC',
                'location_features' => [
                    LocationFeatureName::WATERFRONT->value => true,
                    LocationFeatureName::DOWNTOWN->value => false,
                    LocationFeatureName::PARKING->value => true,
                    LocationFeatureName::PUBLIC_TRANSIT->value => false,
                    LocationFeatureName::WALK_SCORE->value => 40,
                    LocationFeatureName::BIKE_SCORE->value => 50,
                    LocationFeatureName::TRANSIT_SCORE->value => 30
                ],
                'location_pricing' => [
                    [
                        'currency' => 'CAD',
                        'price_before' => 600_000_00,
                        'price_after' => null,
                        'active_from' => now()->subDays(30),
                    ],
                    [
                        'currency' => 'USD',
                        'price_before' => 600_000_00,
                        'price_after' => 590_000_00,
                        'active_from' => now()->subDay(),
                    ],
                ]
            ],
            [
                'name' => 'Nanaimo Harbour',
                'description' => 'Central location with ferry access and growing downtown core.',
                'address' => '100 Front St, Nanaimo, BC',
                'location_features' => [
                    LocationFeatureName::WATERFRONT->value => true,
                    LocationFeatureName::DOWNTOWN->value => true,
                    LocationFeatureName::PARKING->value => true,
                    LocationFeatureName::PUBLIC_TRANSIT->value => true,
                    LocationFeatureName::WALK_SCORE->value => 75,
                    LocationFeatureName::BIKE_SCORE->value => 70,
                    LocationFeatureName::TRANSIT_SCORE->value => 65
                ],
                'location_pricing' => [
                    [
                        'currency' => 'CAD',
                        'price_before' => 600_000_00,
                        'price_after' => null,
                        'active_from' => now()->subDays(30),
                    ],
                    [
                        'currency' => 'USD',
                        'price_before' => 600_000_00,
                        'price_after' => 590_000_00,
                        'active_from' => now()->subDay(),
                    ],
                ]
            ],
            [
                'name' => 'Parksville',
                'description' => 'Popular retirement and vacation destination with beautiful beaches.',
                'address' => '100 Jensen Ave E, Parksville, BC',
                'location_features' => [
                    LocationFeatureName::WATERFRONT->value => true,
                    LocationFeatureName::DOWNTOWN->value => true,
                    LocationFeatureName::PARKING->value => true,
                    LocationFeatureName::PUBLIC_TRANSIT->value => true,
                    LocationFeatureName::WALK_SCORE->value => 70,
                    LocationFeatureName::BIKE_SCORE->value => 65,
                    LocationFeatureName::TRANSIT_SCORE->value => 60
                ],
                'location_pricing' => [
                    [
                        'currency' => 'CAD',
                        'price_before' => 600_000_00,
                        'price_after' => null,
                        'active_from' => now()->subDays(30),
                    ],
                    [
                        'currency' => 'USD',
                        'price_before' => 600_000_00,
                        'price_after' => 590_000_00,
                        'active_from' => now()->subDay(),
                    ],
                ]
            ],
            [
                'name' => 'Comox Valley',
                'description' => 'Mountain and ocean views with excellent outdoor recreation opportunities.',
                'address' => '1800 Beaufort Ave, Comox, BC',
                'location_features' => [
                    LocationFeatureName::WATERFRONT->value => true,
                    LocationFeatureName::DOWNTOWN->value => true,
                    LocationFeatureName::PARKING->value => true,
                    LocationFeatureName::PUBLIC_TRANSIT->value => true,
                    LocationFeatureName::WALK_SCORE->value => 65,
                    LocationFeatureName::BIKE_SCORE->value => 70,
                    LocationFeatureName::TRANSIT_SCORE->value => 60
                ],
                'location_pricing' => [
                    [
                        'currency' => 'CAD',
                        'price_before' => 600_000_00,
                        'price_after' => null,
                        'active_from' => now()->subDays(30),
                    ],
                    [
                        'currency' => 'USD',
                        'price_before' => 600_000_00,
                        'price_after' => 590_000_00,
                        'active_from' => now()->subDay(),
                    ],
                ]
            ],
            [
                'name' => 'Tofino',
                'description' => 'World-renowned surf town with stunning Pacific Ocean views.',
                'address' => '120 4th St, Tofino, BC',
                'location_features' => [
                    LocationFeatureName::WATERFRONT->value => true,
                    LocationFeatureName::DOWNTOWN->value => true,
                    LocationFeatureName::PARKING->value => true,
                    LocationFeatureName::PUBLIC_TRANSIT->value => false,
                    LocationFeatureName::WALK_SCORE->value => 85,
                    LocationFeatureName::BIKE_SCORE->value => 75,
                    LocationFeatureName::TRANSIT_SCORE->value => 40
                ],
                'location_pricing' => [
                    [
                        'currency' => 'CAD',
                        'price_before' => 600_000_00,
                        'price_after' => null,
                        'active_from' => now()->subDays(30),
                    ],
                    [
                        'currency' => 'USD',
                        'price_before' => 600_000_00,
                        'price_after' => 590_000_00,
                        'active_from' => now()->subDay(),
                    ],
                ]
            ]
        ];

        foreach ($locations as $location) {
            /** @var Location $createdLocation */
            $createdLocation = Location::create([
                'company_id' => Company::whereName('Your company LTD')->first()->id,
                'address_id' => Address::wherePlaceId('ChIJN1t_tDeuEmsRUsoyG83frY4')->first()->id,
                'name' => $location['name'],
                'mls' => '000000',
            ]);

            for ($i = 0; $i < 5; $i++) {
                $createdLocation->locationImages()->create([
                    'source' => $faker->imageUrl(640, 480, 'building'),
                    'default' => $i === 0,
                ]);
            }

            foreach ($location['location_features'] as $feature => $value) {
                $createdLocation->locationFeatures()->create([
                    'feature' => $feature,
                    'value' => $value,
                ]);
            }

            foreach ($location['location_pricing'] as $pricing) {
                $createdLocation->locationPricings()->create($pricing);
            }

            $createdLocation->locationRooms()->create([
                'level' => 1,
                'name' => 'bedroom',
                'area_sqft' => 500,
                'width_sqft' => '9"0\'',
                'length_sqft' => '9"0\'',
                'width_meters' => '3m',
                'length_meters' => '3m',
            ]);

            $createdLocation->locationRooms()->create([
                'level' => 1,
                'name' => 'bathroom',
                'area_sqft' => 200,
                'width_sqft' => '9"0\'',
                'length_sqft' => '9"0\'',
                'width_meters' => '3m',
                'length_meters' => '3m',
            ]);

            $createdLocation->locationRooms()->create([
                'level' => 1,
                'name' => 'bathroom 2',
                'area_sqft' => 600,
                'width_sqft' => '9"0\'',
                'length_sqft' => '9"0\'',
                'width_meters' => '3m',
                'length_meters' => '3m',
            ]);

            $createdLocation->locationDocuments()->create([
                'name' => 'Property Disclosure Statement.pdf',
                'url' => 'path/to/file.pdf',
                'size' => '2.4 MB',
            ]);
            $createdLocation->locationDocuments()->create([
                'name' => 'Floor plan.pdf',
                'url' => 'path/to/file.pdf',
                'size' => '2.4 MB',
            ]);
            $createdLocation->locationDocuments()->create([
                'name' => 'Title certificate.pdf',
                'url' => 'path/to/file.pdf',
                'size' => '3.4 MB',
            ]);
        }
    }
}
