<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'address_id' => Address::factory(),
            'name' => "{$this->faker->buildingNumber} {$this->faker->streetName}, Langford, BC",
            'mls' => '000000',
        ];
    }
}
