<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use App\Models\Address;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'address_id' => Address::factory(),
            'contact_id' => Contact::factory(),
            'code' => Company::generateUniqueCode(),
            'name' => $this->faker->company(),
        ];
    }
}
