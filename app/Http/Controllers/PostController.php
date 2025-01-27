<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PostController extends Controller
{
    public function index()
    {
        return $posts = Post::all();
    }

    public function store()
    {
         return Post::create([
            'title' => 'Command title',
            'content' => 'content command',
            'author' => 'author command',
            'is_published' => true,
            'likes' => 1,
            'image_path' => '/var/www/html/' . rand(0, 1000) . '/' . rand(0, 1000) .'/images/image.jpg',
            'tag' => 'tag command',
            'category' => 'category command',
            'views' => 1,
            'published_at' => '2025-01-23 16:38:27',
        ]);
    }

    public function show(Post $post)
    {
        dd($post);
    }

    public function update()
    {
        $data = [
            'title' => 'update title',
        ];
        $post = Post::find(10);
        $post->update($data);
        return $post;
    }

    public function destroy()
    {
        $post = Post::find(10);
        $post->delete();
        return response([
            'message' => 'delete success',
        ], ResponseAlias::HTTP_OK);
    }

}
