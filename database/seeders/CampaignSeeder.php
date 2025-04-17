<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Location;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        // Get all locations
        $locations = Location::all();

        foreach ($locations as $location) {
            // Create a campaign for each location
            $location->campaign()->create([
                'name' => "{$location->name} Campaign",
                'payload' => [
                    'fields' => [
                        [
                            'id' => 'full_name',
                            'required' => true,
                            'type' => 'input[type=text]',
                            'label' => 'Full Name',
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
                ]
            ]);
        }
    }
}
