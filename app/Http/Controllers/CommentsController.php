<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index()
    {
        return Comment::all();
    }

    public function show(Comment $comment)
    {
        return $comment;
    }

    public function store()
    {
        $data = [
            'post' => 'some id_' . rand(1, 100),
            'content' => 'new content',
            'author' => 'new author',
            'status' => 1,
            'parent' => 'some parent',
            'like' => 11,
        ];

        return Comment::create($data);
    }

    public function update(Comment $comment)
    {
        $data = [
            'parent' => 'update parent'
        ];

        $comment->update($data);
        return $comment;
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response('deleted', 200);
    }
}
