<?php

use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ProfileController;

Route::group(['prefix'=>'admin','middleware' => ['auth', IsAdminMiddleware::class]], function () {
    Route::get('posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('admin.posts.show');
    Route::post('posts', [PostController::class, 'store'])->name('admin.posts.store');

    Route::get('comments', [CommentController::class, 'index'])->name('admin.comments.index');
    Route::get('comments/create', [CommentController::class, 'create'])->name('admin.comments.create');
    Route::get('comments/{comment}', [CommentController::class, 'show'])->name('admin.comments.show');
    Route::post('comments', [CommentController::class, 'store'])->name('admin.comments.store');

    Route::get('articles', [ArticleController::class, 'index'])->name('admin.articles.index');
    Route::get('articles/create', [ArticleController::class, 'create'])->name('admin.articles.create');
    Route::get('articles/{article}', [ArticleController::class, 'show'])->name('admin.articles.show');
    Route::post('articles', [ArticleController::class, 'store'])->name('admin.articles.store');

    Route::get('profiles', [ProfileController::class, 'index'])->name('admin.profiles.index');
    Route::get('profiles/{profile}', [ProfileController::class, 'show'])->name('admin.profiles.show');
});
