<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class NfcQrTagFactory extends Factory
{
    public function definition(): array
    {
        return [
            'location_id' => Location::factory(),
            'name' => $this->faker->word,
        ];
    }
}
