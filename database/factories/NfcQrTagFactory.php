<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Location;
use App\Models\NfcQrTag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class NfcQrTagFactory extends Factory
{
    protected $model = NfcQrTag::class;

    public function definition(): array
    {
        return [
            'location_id' => Location::factory(),
            'name' => $this->faker->word,
        ];
    }
}
