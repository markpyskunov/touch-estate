<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::factory()->create([
            'code' => 'AAAA',
            'name' => 'Touch Estate LTD',
        ]);

        Company::factory()->create([
            'code' => 'ABCD',
            'name' => 'Your company LTD',
        ]);
    }
}
