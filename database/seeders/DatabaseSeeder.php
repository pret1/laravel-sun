<?php

namespace Database\Seeders;

use App\Events\User\StoredUserEvent;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
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
//        StoredUserEvent::dispatch($user);
//
//        $user->profile()->create([
//            'name' => 'Vasy',
//            'phone' => '7777777777777',
//            'address' => 'asdasdasdasdasd',
//            'gender' => 'male',
//        ]);

        $user = User::factory()
            ->count(20)
            ->has(Profile::factory())
            ->has(Post::factory()->count(3))
            ->has(Article::factory()->count(3))
//            ->has(Role::factory())
//            ->hasAttached(Role::factory()->count(2))
            ->create();
//
//
//        $role = Role::factory()->hasAttached(User::factory())->create();
//        $category = Category::factory()->has(Post::factory()->count(5))->create();
//
//        $post = Post::factory()->count(5)
//            ->for(Category::factory())
//            ->for(Profile::factory())
//            ->has(Comment::factory()->count(3))
//            ->create();

        //--------need check
//            ->hasAttached(Profile::factory()->count(5))

//        $profile = Profile::factory()
//            ->hasAttached(Post::factory()->count(3))
//            ->create();
        //-------------------------

//        $tag = Tag::factory()->count(10)->hasAttached(Post::factory()->count(10))->create();
//
//        $comment = Comment::factory()->count(10)
//            ->for(Post::factory())
//            ->for(Profile::factory())
//            ->create();


        $this->call([
            TagSeeder::class,
            RoleSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            ArticleSeeder::class,
//            PostProfileLikeSeeder::class,
            CommentSeeder::class,
            LikeableSeeder::class,
//            ViewSeeder::class,
            ViewAbleSeeder::class,
            ImageSeeder::class,
//            CommentProfileLikeSeeder::class,
        ]);

//        $role = Role::where('title', 'USER')->first();
//        if ($role) {
//            $user->roles()->toggle($role->id);
//        }

//        $roles = Role::all();
//        $user->each(function ($user) use ($roles) {
//            $user->roles()->attach(
//                $roles->random(rand(1, 3))->pluck('id')->toArray()
//            );
//        });

//        $comments = Comment::all();
//        foreach ($comments as $comment) {
//            if($comment->id > 3) {
//                do {
//                    $randomComment = Comment::inRandomOrder()->first();
//                } while ($randomComment->id === $comment->id);
//
//                $comment->update(['parent_id' => $randomComment->id]);
//            }
//        }
    }
}
