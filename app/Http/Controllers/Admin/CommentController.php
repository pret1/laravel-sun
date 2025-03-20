<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

class CommentController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $comments = CommentResource::collection(Comment::all())->resolve();
        return inertia('Admin/Comment/Index', compact('comments'));
    }

    public function show(Comment $comment)
    {
        return Inertia::render('Admin/Comment/Show', compact('comment'));
    }
}
