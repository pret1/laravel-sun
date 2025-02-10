<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\TagFactory;
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
//        $user = [
//            'login' => 'user',
//            'email' => 'user@gmail.com',
//            'password' => Hash::make('password'),
//        ];
//
//        $user = User::firstOrCreate([
//            'email' => $user['email'],
//        ], $user);
//
//        $user->profile()->create([
//            'name' => 'Vasy',
//            'phone' => '7777777777777',
//            'address' => 'asdasdasdasdasd',
//            'gender' => 'male',
//        ]);

        $user = User::factory()
            ->has(Profile::factory())
            ->has(Post::factory()->count(3))
            ->has(Role::factory()->count(2))
            ->create();


        $role = Role::factory()->hasAttached(User::factory())->create();
        $category = Category::factory()->has(Post::factory()->count(5))->create();

        $post = Post::factory()
            ->for(Category::factory())
            ->for(Profile::factory())
            ->create();

        $tag = Tag::factory()->for(Post::factory())->create();


        $this->call([
//            TagSeeder::class,
//            RoleSeeder::class,
//            CategorySeeder::class,
//            PostSeeder::class,
            PostProfileLikeSeeder::class,
            CommentSeeder::class,
            CommentProfileLikeSeeder::class,
        ]);

        $role = Role::where('title', 'USER')->first();
        if ($role) {
            $user->roles()->toggle($role->id);
        }
    }
}
