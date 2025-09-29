<?php

namespace Database\Seeders;

use App\Enums\LocationFeatureName;
use App\Enums\Role;
use App\Enums\RoomType;
use App\Models\Address;
use App\Models\Company;
use App\Models\NfcQrTag;
use App\Models\User;
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
                    LocationFeatureName::WATERFRONT->value => 'true',
                    LocationFeatureName::DOWNTOWN->value => 'true',
                    LocationFeatureName::PARKING->value => 'true',
                    LocationFeatureName::PUBLIC_TRANSIT->value => 'false',
                    LocationFeatureName::WALK_SCORE->value => '85',
                    LocationFeatureName::BIKE_SCORE->value => '75',
                    LocationFeatureName::TRANSIT_SCORE->value => '40',
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
                    LocationFeatureName::WATERFRONT->value => 'true',
                    LocationFeatureName::DOWNTOWN->value => 'true',
                    LocationFeatureName::PARKING->value => 'true',
                    LocationFeatureName::PUBLIC_TRANSIT->value => 'false',
                    LocationFeatureName::WALK_SCORE->value => '85',
                    LocationFeatureName::BIKE_SCORE->value => '75',
                    LocationFeatureName::TRANSIT_SCORE->value => '40',
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
                    LocationFeatureName::WATERFRONT->value => 'true',
                    LocationFeatureName::DOWNTOWN->value => 'true',
                    LocationFeatureName::PARKING->value => 'true',
                    LocationFeatureName::PUBLIC_TRANSIT->value => 'false',
                    LocationFeatureName::WALK_SCORE->value => '85',
                    LocationFeatureName::BIKE_SCORE->value => '75',
                    LocationFeatureName::TRANSIT_SCORE->value => '40',
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
                    LocationFeatureName::WATERFRONT->value => 'true',
                    LocationFeatureName::DOWNTOWN->value => 'true',
                    LocationFeatureName::PARKING->value => 'true',
                    LocationFeatureName::PUBLIC_TRANSIT->value => 'false',
                    LocationFeatureName::WALK_SCORE->value => '85',
                    LocationFeatureName::BIKE_SCORE->value => '75',
                    LocationFeatureName::TRANSIT_SCORE->value => '40',
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
                    LocationFeatureName::WATERFRONT->value => 'true',
                    LocationFeatureName::DOWNTOWN->value => 'true',
                    LocationFeatureName::PARKING->value => 'true',
                    LocationFeatureName::PUBLIC_TRANSIT->value => 'false',
                    LocationFeatureName::WALK_SCORE->value => '85',
                    LocationFeatureName::BIKE_SCORE->value => '75',
                    LocationFeatureName::TRANSIT_SCORE->value => '40',
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
                    LocationFeatureName::WATERFRONT->value => 'true',
                    LocationFeatureName::DOWNTOWN->value => 'true',
                    LocationFeatureName::PARKING->value => 'true',
                    LocationFeatureName::PUBLIC_TRANSIT->value => 'false',
                    LocationFeatureName::WALK_SCORE->value => '85',
                    LocationFeatureName::BIKE_SCORE->value => '75',
                    LocationFeatureName::TRANSIT_SCORE->value => '40',
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
                    LocationFeatureName::WATERFRONT->value => 'true',
                    LocationFeatureName::DOWNTOWN->value => 'true',
                    LocationFeatureName::PARKING->value => 'true',
                    LocationFeatureName::PUBLIC_TRANSIT->value => 'false',
                    LocationFeatureName::WALK_SCORE->value => '85',
                    LocationFeatureName::BIKE_SCORE->value => '75',
                    LocationFeatureName::TRANSIT_SCORE->value => '40',
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
                    LocationFeatureName::WATERFRONT->value => 'true',
                    LocationFeatureName::DOWNTOWN->value => 'true',
                    LocationFeatureName::PARKING->value => 'true',
                    LocationFeatureName::PUBLIC_TRANSIT->value => 'false',
                    LocationFeatureName::WALK_SCORE->value => '85',
                    LocationFeatureName::BIKE_SCORE->value => '75',
                    LocationFeatureName::TRANSIT_SCORE->value => '40',
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
                    LocationFeatureName::WATERFRONT->value => 'true',
                    LocationFeatureName::DOWNTOWN->value => 'true',
                    LocationFeatureName::PARKING->value => 'true',
                    LocationFeatureName::PUBLIC_TRANSIT->value => 'false',
                    LocationFeatureName::WALK_SCORE->value => '85',
                    LocationFeatureName::BIKE_SCORE->value => '75',
                    LocationFeatureName::TRANSIT_SCORE->value => '40',
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
                    LocationFeatureName::WATERFRONT->value => 'true',
                    LocationFeatureName::DOWNTOWN->value => 'true',
                    LocationFeatureName::PARKING->value => 'true',
                    LocationFeatureName::PUBLIC_TRANSIT->value => 'false',
                    LocationFeatureName::WALK_SCORE->value => '85',
                    LocationFeatureName::BIKE_SCORE->value => '75',
                    LocationFeatureName::TRANSIT_SCORE->value => '40',
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

        /** @var User $realtor */
        $realtor = User::factory()->create();
        $realtor->assignRole(Role::REALTOR->value);

        foreach ($locations as $location) {
            /** @var Location $createdLocation */
            $createdLocation = Location::create([
                'company_id' => Company::whereName('Your company LTD')->first()->id,
                'address_id' => Address::wherePlaceId('ChIJN1t_tDeuEmsRUsoyG83frY4')->first()->id,
                'realtor_id' => $realtor->id,
                'campaign_id' => null,
                'nfc_qr_tag_id' => null,
                'area_sqft' => 999,
                'description' => 'Beautiful family home in the desirable Langford area. This spacious property features 4 bedrooms, 3 bathrooms, and a large backyard perfect for entertaining. The home has been recently updated with modern finishes while maintaining its classic charm.',
                'name' => $location['name'],
                'mls' => '000000',
            ]);

            $c = $createdLocation->campaign()->create([
                'name' => "{$createdLocation->name} Campaign",
                'payload' => [
                    'fields' => [
                        [
                            'id' => 'full_name',
                            'required' => true,
                            'type' => 'input[type=text]',
                            'label' => 'Full Name',
                            'validation' => [
                                'min' => 1,
                                'max' => 128,
                            ],
                        ],
                    ],
                    'flags' => [
                        'use_email_login' => true,
                        'use_sms_login' => true,
                    ],
                ]
            ]);
            $createdLocation->campaign_id = $c->id;
            $createdLocation->save();

            /** @var NfcQrTag $tag */
            $tag = $createdLocation->nfcQrTag()->create([
                'code' => $createdLocation->company->code,
                'name' => 'Default tag',
            ]);
            $createdLocation->nfc_qr_tag_id = $tag->id;
            $createdLocation->save();

            $images = [
                '/images/properties/living-room-1.jpg',
                '/images/properties/kitchen-1.jpg',
                '/images/properties/bedroom-1.jpg',
                '/images/properties/bathroom.jpg',
            ];
            foreach ($images as $i => $image) {
                $createdLocation->locationImages()->create([
                    'source' => url($image),
                    'title' => $faker->sentence,
                    'is_default' => $i === 0,
                    'is_featured' => $i === 0 || $i === 1,
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
                'type' => RoomType::BEDROOM,
                'level' => 1,
                'name' => 'bedroom',
                'area_sqft' => 500,
                'width_ft' => '9"0\'',
                'length_ft' => '9"0\'',
                'width_meters' => '3m',
                'length_meters' => '3m',
            ]);

            $createdLocation->locationRooms()->create([
                'type' => RoomType::BEDROOM,
                'level' => 1,
                'name' => 'bedroom 2',
                'area_sqft' => 200,
                'width_ft' => '9"0\'',
                'length_ft' => '9"0\'',
                'width_meters' => '3m',
                'length_meters' => '3m',
            ]);

            $createdLocation->locationRooms()->create([
                'type' => RoomType::BATHROOM,
                'level' => 1,
                'name' => 'bathroom',
                'area_sqft' => 600,
                'width_ft' => '9"0\'',
                'length_ft' => '9"0\'',
                'width_meters' => '3m',
                'length_meters' => '3m',
            ]);

            $createdLocation->locationRooms()->create([
                'type' => RoomType::PARKING,
                'level' => -1,
                'name' => 'underground parking',
                'area_sqft' => 150,
                'width_ft' => '3"2\'',
                'length_ft' => '20"0\'',
                'width_meters' => '2m',
                'length_meters' => '6m',
            ]);

            $createdLocation->locationDocuments()->create([
                'name' => 'Property Disclosure Statement.pdf',
                'url' => 'path/to/file.pdf',
                'size' => '2.4 MB',
                'icon' => 'mdi-file-document-outline',
                'icon_color' => 'primary',
            ]);
            $createdLocation->locationDocuments()->create([
                'name' => 'Floor plan.pdf',
                'url' => 'path/to/file.pdf',
                'size' => '2.4 MB',
                'icon' => 'mdi-floor-plan',
                'icon_color' => 'success',
            ]);
            $createdLocation->locationDocuments()->create([
                'name' => 'Title certificate.pdf',
                'url' => 'path/to/file.pdf',
                'size' => '3.4 MB',
                'icon' => 'mdi-map-outline',
                'icon_color' => 'info',
            ]);
        }
    }
}
