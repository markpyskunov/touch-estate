<?php

namespace Database\Seeders;

use App\Enums\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Role::all() as $role) {
            \App\Models\Role::create([
                'name' => $role->value,
                'guard_name' => 'api',
            ]);
        }
    }
}
