<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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

        $users = User::all();
        $roles = Role::all();
        $users->each(function ($user) use ($roles) {
            $user->roles()->attach(
                $roles->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
