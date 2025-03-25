<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Article\StoreRequest;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Article;
use App\Models\Category;
use Inertia\Response;
use Inertia\ResponseFactory;

class ArticleController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $articles = ArticleResource::collection(Article::all())->resolve();
        return inertia('Admin/Article/Index', compact('articles'));
    }

    public function show(Article $article): Response
    {
        $article = ArticleResource::make($article)->resolve();
        return inertia('Admin/Article/Show', compact('article'));
    }

    public function create(): Response
    {
        $categories = CategoryResource::collection(Category::all())->resolve();
        return inertia('Admin/Article/Create', compact('categories'));
    }

    public function store(StoreRequest $request): array
    {
        $data = $request->validated();
        $data['profile_id'] = auth()->user()->profile->id;
        $article = Article::create($data);
        return ArticleResource::make($article)->resolve();
    }
}
