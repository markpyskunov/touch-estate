<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $touchEstate = Company::where('name', 'Touch Estate LTD')->first();
        $yourCompany = Company::where('name', 'Your company LTD')->first();

        // Create Touch Estate superadmin
        /** @var User $superadmin */
        $superadmin = User::factory()->create([
            'company_id' => $touchEstate->id,
            'email' => 'superadmin@touchestate.ca',
            'password' => Hash::make('123456'),
            'first_name' => 'Super',
            'last_name' => 'Admin',
        ]);
        $superadmin->assignRole(Role::SUPERADMIN->value);

        // Create Your Company admin
        /** @var User $admin */
        $admin = User::factory()->create([
            'company_id' => $yourCompany->id,
            'email' => 'yourcompany+admin@touchestate.ca',
            'password' => Hash::make('123456'),
            'first_name' => 'Company',
            'last_name' => 'Admin',
        ]);
        $admin->assignRole(Role::ADMIN->value);

        // Create Your Company agent
        /** @var User $agent */
        $agent = User::factory()->create([
            'company_id' => $yourCompany->id,
            'email' => 'yourcompany+agent@touchestate.ca',
            'password' => Hash::make('123456'),
            'first_name' => 'Company',
            'last_name' => 'Agent',
        ]);
        $agent->assignRole(Role::AGENT->value);
    }
}
