<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Comment\StoreRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use App\Models\Post;
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

    public function show(Comment $comment): Response
    {
        $comment = CommentResource::make($comment)->resolve();
        return Inertia::render('Admin/Comment/Show', compact('comment'));
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Comment/Create');
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $data['profile_id'] = auth()->user()->profile->id;
        $data['commentable_type'] = Post::class;
        $data['commentable_id'] = 1;
        $comment = Comment::create($data);
        return CommentResource::make($comment)->resolve();
    }
}
