<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\Tag\TagResource;
use App\Models\Role;
use App\Models\Tag;
use Inertia\Response;
use Inertia\ResponseFactory;
use App\Http\Requests\Admin\Tag\StoreRequest;

class TagController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $tags = TagResource::collection(Tag::all())->resolve();
        return inertia("Admin/Tag/Index", compact('tags'));
    }

    public function show(Tag $tag): Response|ResponseFactory
    {
        $tag = TagResource::make($tag)->resolve();
        return inertia("Admin/Tag/Show", compact('tag'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia("Admin/Tag/Create");
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $tag = Tag::create($data);
        return TagResource::make($tag)->resolve();
    }
}
