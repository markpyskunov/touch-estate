<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'phone_3' => null,
            'email' => $this->faker->email(),
            'email_2' => null,
            'avatar' => 'https://placehold.co/200x200/333/fff?text=Avatar',
        ];
    }
}
