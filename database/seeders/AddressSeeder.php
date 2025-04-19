<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        $addresses = [
            [
                'place_id' => 'ChIJN1t_tDeuEmsRUsoyG83frY4',
                'formatted_address' => '1600 Amphitheatre Parkway, Mountain View, CA 94043, USA',
                'street_number' => '1600',
                'route' => 'Amphitheatre Parkway',
                'locality' => 'Mountain View',
                'administrative_area_level_1' => 'CA',
                'administrative_area_level_2' => 'Santa Clara County',
                'country' => 'United States',
                'postal_code' => '94043',
                'latitude' => 37.4224764,
                'longitude' => -122.0842499,
                'address_components' => json_encode([
                    [
                        'long_name' => '1600',
                        'short_name' => '1600',
                        'types' => ['street_number']
                    ],
                    [
                        'long_name' => 'Amphitheatre Parkway',
                        'short_name' => 'Amphitheatre Pkwy',
                        'types' => ['route']
                    ],
                    [
                        'long_name' => 'Mountain View',
                        'short_name' => 'Mountain View',
                        'types' => ['locality', 'political']
                    ],
                    [
                        'long_name' => 'Santa Clara County',
                        'short_name' => 'Santa Clara County',
                        'types' => ['administrative_area_level_2', 'political']
                    ],
                    [
                        'long_name' => 'California',
                        'short_name' => 'CA',
                        'types' => ['administrative_area_level_1', 'political']
                    ],
                    [
                        'long_name' => 'United States',
                        'short_name' => 'US',
                        'types' => ['country', 'political']
                    ],
                    [
                        'long_name' => '94043',
                        'short_name' => '94043',
                        'types' => ['postal_code']
                    ]
                ]),
                'types' => json_encode(['street_address']),
                'viewport' => json_encode([
                    'northeast' => [
                        'lat' => 37.4238253802915,
                        'lng' => -122.0829009197085
                    ],
                    'southwest' => [
                        'lat' => 37.4211274197085,
                        'lng' => -122.0855988802915
                    ]
                ]),
                'geometry' => json_encode([
                    'location' => [
                        'lat' => 37.4224764,
                        'lng' => -122.0842499
                    ],
                    'location_type' => 'ROOFTOP',
                    'viewport' => [
                        'northeast' => [
                            'lat' => 37.4238253802915,
                            'lng' => -122.0829009197085
                        ],
                        'southwest' => [
                            'lat' => 37.4211274197085,
                            'lng' => -122.0855988802915
                        ]
                    ]
                ])
            ],
            [
                'place_id' => 'ChIJE9on3F3HwoAR9AhGJW_fL-I',
                'formatted_address' => '1 Apple Park Way, Cupertino, CA 95014, USA',
                'street_number' => '1',
                'route' => 'Apple Park Way',
                'locality' => 'Cupertino',
                'administrative_area_level_1' => 'CA',
                'administrative_area_level_2' => 'Santa Clara County',
                'country' => 'United States',
                'postal_code' => '95014',
                'latitude' => 37.334722,
                'longitude' => -122.008889,
                'address_components' => json_encode([
                    [
                        'long_name' => '1',
                        'short_name' => '1',
                        'types' => ['street_number']
                    ],
                    [
                        'long_name' => 'Apple Park Way',
                        'short_name' => 'Apple Park Way',
                        'types' => ['route']
                    ],
                    [
                        'long_name' => 'Cupertino',
                        'short_name' => 'Cupertino',
                        'types' => ['locality', 'political']
                    ],
                    [
                        'long_name' => 'Santa Clara County',
                        'short_name' => 'Santa Clara County',
                        'types' => ['administrative_area_level_2', 'political']
                    ],
                    [
                        'long_name' => 'California',
                        'short_name' => 'CA',
                        'types' => ['administrative_area_level_1', 'political']
                    ],
                    [
                        'long_name' => 'United States',
                        'short_name' => 'US',
                        'types' => ['country', 'political']
                    ],
                    [
                        'long_name' => '95014',
                        'short_name' => '95014',
                        'types' => ['postal_code']
                    ]
                ]),
                'types' => json_encode(['street_address']),
                'viewport' => json_encode([
                    'northeast' => [
                        'lat' => 37.336071,
                        'lng' => -122.007541
                    ],
                    'southwest' => [
                        'lat' => 37.333373,
                        'lng' => -122.010239
                    ]
                ]),
                'geometry' => json_encode([
                    'location' => [
                        'lat' => 37.334722,
                        'lng' => -122.008889
                    ],
                    'location_type' => 'ROOFTOP',
                    'viewport' => [
                        'northeast' => [
                            'lat' => 37.336071,
                            'lng' => -122.007541
                        ],
                        'southwest' => [
                            'lat' => 37.333373,
                            'lng' => -122.010239
                        ]
                    ]
                ])
            ]
        ];

        foreach ($addresses as $address) {
            Address::create($address);
        }
    }
}
