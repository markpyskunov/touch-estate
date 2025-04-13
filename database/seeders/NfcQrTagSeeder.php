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

        $currentID = 0;
        foreach ($locations as $location) {
            $codeID = str_pad((string) $currentID, 4, '0', STR_PAD_LEFT);
            NfcQrTag::create([
                'location_id' => $location->id,
                'name' => "Tag {$currentID}",
                'code' => "{$location->company->code}{$codeID}",
            ]);
            $currentID++;
        }
    }
}
