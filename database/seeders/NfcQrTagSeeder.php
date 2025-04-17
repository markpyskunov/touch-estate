<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;
use App\Models\NfcQrTag;

class NfcQrTagSeeder extends Seeder
{
    public function run(): void
    {
        $locations = Location::all();

        $currentID = 1;
        foreach ($locations as $location) {
            NfcQrTag::create([
                'location_id' => $location->id,
                'name' => "Tag {$currentID}",
            ]);
            $currentID++;
        }
    }
}
