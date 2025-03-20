<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;
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
}
