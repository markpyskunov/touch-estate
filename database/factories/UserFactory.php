<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Address;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected static ?string $password;
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'address_id' => Address::factory(),
            'contact_id' => Contact::factory(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}
