<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //        DB::statement("SELECT setval('posts_id_seq', (SELECT MAX(id) FROM posts) + 1);");
//or in DB go command TRUNCATE TABLE posts RESTART IDENTITY CASCADE;
        Post::factory()->count(50)->create();
//        Post::factory(50)->create();
    }
}
