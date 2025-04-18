<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    public function definition(): array
    {
        return [
            'location_id' => Location::factory(),
            'name' => $this->faker->word(),
            'payload' => [
                'fields' => [
                    [
                        'id' => 'full_name',
                        'required' => true,
                        'type' => 'input[type=text]',
                        'label' => 'Full name',
                        'validation' => [
                            'min' => 1,
                            'max' => 128,
                        ],
                    ],
                ],
                'flags' => [
                    'use_email_login' => true,
                    'use_sms_login' => true,
                ],
            ],
        ];
    }
}
