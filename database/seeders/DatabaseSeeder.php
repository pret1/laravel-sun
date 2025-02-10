<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = [
            'login' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
        ];

        $user = User::firstOrCreate([
            'email' => $user['email'],
        ], $user);

        $user->profile()->create([
            'name' => 'Vasy',
            'phone' => '7777777777777',
            'address' => 'asdasdasdasdasd',
            'gender' => 'male',
        ]);

        $this->call([
            TagSeeder::class,
            RoleSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            PostProfileLikeSeeder::class,
            CommentSeeder::class,
        ]);

        $role = Role::where('title', 'USER')->first();
        if ($role) {
            $user->roles()->toggle($role->id);
        }
    }
}
