<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        $lat = $this->faker->latitude;
        $lng = $this->faker->longitude;
        
        return [
            'place_id' => $this->faker->uuid(),
            'formatted_address' => $this->faker->address(),
            'street_number' => $this->faker->buildingNumber(),
            'route' => $this->faker->streetName(),
            'locality' => $this->faker->city(),
            'administrative_area_level_1' => $this->faker->state(),
            'administrative_area_level_2' => $this->faker->city(),
            'country' => $this->faker->country(),
            'postal_code' => $this->faker->postcode(),
            'latitude' => $lat,
            'longitude' => $lng,
            'address_components' => json_encode([]),
            'types' => json_encode(['street_address']),
            'viewport' => json_encode([
                'northeast' => ['lat' => $lat + 0.01, 'lng' => $lng + 0.01],
                'southwest' => ['lat' => $lat - 0.01, 'lng' => $lng - 0.01],
            ]),
            'geometry' => json_encode([
                'location' => ['lat' => $lat, 'lng' => $lng],
            ]),
        ];
    }
} 