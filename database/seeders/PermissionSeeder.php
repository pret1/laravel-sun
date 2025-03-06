<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    private array $permissions = [
        'store',
        'show',
        'update',
        'delete',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::factory()->create([
                'name' => $permission
            ]);
        }

        $users = User::all();
        $permissions = Permission::all();
        $users->each(function ($user) use ($permissions) {
            $user->permissions()->attach(
                $permissions->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
    }
}
