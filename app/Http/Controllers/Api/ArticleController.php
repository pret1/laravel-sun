<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Article\StoreArticleRequest;
use App\Http\Requests\Api\Article\UpdateArticleRequest;
use App\Http\Resources\Article\ArticleResource;
use App\Models\Article;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): array
    {
        return ArticleResource::collection(Article::all())->resolve();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request): array
    {
        $data = $request->validated();
        $article = Article::create($data);
        return ArticleResource::make($article)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article): array
    {
        return ArticleResource::make($article)->resolve();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article): array
    {
        $data = $request->validated();
        $article->update($data);
        return ArticleResource::make($article)->resolve();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article): Application|Response|ResponseFactory
    {
        $article->delete();
        return response('success deleted', Response::HTTP_OK);
    }
}
