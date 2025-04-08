<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Support\Facades\Request;
use Inertia\Response;
use Inertia\ResponseFactory;
use App\Http\Requests\Admin\Post\IndexRequest;

class PostController extends Controller
{
    public function index(IndexRequest $request): Response|ResponseFactory|array
    {
        $data = $request->validated();
        $posts = PostResource::collection(Post::filter($data)->latest()->get())->resolve();

        if(Request::wantsJson()) {
            return $posts;
        }

        return inertia('Admin/Post/Index', compact('posts'));
    }

    public function show(Post $post): Response|ResponseFactory
    {
        $post = PostResource::make($post)->resolve();
        return inertia('Admin/Post/Show', compact('post'));
    }

    public function create(): Response|ResponseFactory
    {
        $categories = CategoryResource::collection(Category::all())->resolve();
        return inertia('Admin/Post/Create', compact('categories'));
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->except('images');
        $post = PostService::store($data);
        return PostResource::make($post)->resolve();
    }
}
