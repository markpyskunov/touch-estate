<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use App\Models\Address;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'phone' => $this->faker->phoneNumber(),
            'phone_2' => $this->faker->phoneNumber(),
            'phone_3' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'email_2' => $this->faker->email(),
            'avatar' => $this->faker->image(),
        ];
    }
}
