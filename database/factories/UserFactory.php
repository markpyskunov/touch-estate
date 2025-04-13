<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Address;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'company_id' => Company::factory()->create()->id,
            'address_id' => Address::factory()->create()->id,
            'contact_id' => Contact::factory()->create()->id,
        ];
    }
}
