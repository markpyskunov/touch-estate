<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Company;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'address_id' => Address::factory(),
            'name' => "{$this->faker->buildingNumber} {$this->faker->streetName}, Langford, BC",
            'mls' => '000000',
            'description' => $this->faker->sentence,
        ];
    }
}
