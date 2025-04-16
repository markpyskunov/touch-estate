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
            Campaign::create([
                'name' => "{$location->name} Campaign",
                'payload' => [
                    'fields' => [
                        [
                            'id' => 'full_name',
                            'required' => true,
                            'type' => 'input[type=text]',
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

        // Create a specific campaign for the ABCD0000 tag
        $dummyLocation = Location::where('name', 'Victoria Waterfront')->first();
        if ($dummyLocation) {
            Campaign::create([
                'name' => 'ABCD0000 Demo Campaign',
                'payload' => [
                    'location_id' => $dummyLocation->id,
                    'description' => 'Demo campaign for ABCD0000 tag',
                    'start_date' => now()->subDays(30)->toDateString(),
                    'end_date' => now()->addDays(30)->toDateString(),
                    'status' => 'active',
                    'features' => [
                        'email_login' => true,
                        'sms_login' => true,
                        'require_verification' => true,
                        'verification_code_length' => 6,
                    ]
                ]
            ]);
        }
    }
}
