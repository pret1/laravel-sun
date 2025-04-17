<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Events\Post\PostCacheEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\DeleteRequest;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Inertia\Response;
use Inertia\ResponseFactory;
use App\Http\Requests\Admin\Post\IndexRequest;

class PostController extends Controller
{
    public function index(IndexRequest $request): Response|ResponseFactory|AnonymousResourceCollection
    {
        $data = $request->validationData();
//        $key = md5(json_encode($data));

//        $posts = Cache::remember($key, now()->addMinutes(10), function () use ($data) {
//            return PostResource::collection(
//                Post::filter($data)
//                    ->latest()
//                    ->paginate($data['per_page'], '*', 'page', $data['page'])
//            );
//        });


        $posts = PostResource::collection(
            Post::filter($data)
                ->latest()
                ->paginate($data['per_page'], '*', 'page', $data['page'])
        );


        if (Request::wantsJson()) {
            return $posts;
        }

        return inertia('Admin/Post/Index', compact('posts'));
    }

    public function show(Post $post): Response|ResponseFactory
    {
        $post = PostResource::make($post)->resolve();
        return inertia('Admin/Post/Show', compact('post'));
    }

    public function edit(Post $post): Response|ResponseFactory
    {
        $post = PostResource::make($post)->resolve();
        $categories = CategoryResource::collection(Category::all())->resolve();
        return inertia('Admin/Post/Edit', compact('post', 'categories'));
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

    public function destroy(DeleteRequest $request, Post $post): array
    {
        $data = $request->validationData();
        event(new PostCacheEvent($data));

        $post->delete();
        return PostResource::make($post)->resolve();
    }
}
