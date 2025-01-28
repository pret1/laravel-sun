<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;
use App\Http\Resources\Comment\CommentResource;

class CommentController extends Controller
{
    public function index()
    {
        return CommentResource::collection(Comment::all())->resolve();
    }

    public function show(Comment $comment)
    {
        return CommentResource::make($comment)->resolve();
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

        return CommentService::store($data);
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
