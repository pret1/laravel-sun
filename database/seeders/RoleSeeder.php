<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private array $roles = ['USER', 'MANAGER', 'SUPER_MANAGER', 'ADMIN', 'SUPER_ADMIN'];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->roles as $role) {
            Role::factory()->create([
                'title' => $role
            ]);
        }
    }
}
