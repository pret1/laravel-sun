<?php

use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ProfileController;

Route::group(['prefix'=>'admin','middleware' => ['auth', IsAdminMiddleware::class]], function () {
    Route::get('posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('admin.posts.show');

    Route::get('comments', [CommentController::class, 'index'])->name('admin.comments.index');
    Route::get('comments/{comment}', [CommentController::class, 'show'])->name('admin.comments.show');

    Route::get('articles', [ArticleController::class, 'index'])->name('admin.articles.index');
    Route::get('articles/{article}', [ArticleController::class, 'show'])->name('admin.articles.show');

    Route::get('profiles', [ProfileController::class, 'index'])->name('admin.profiles.index');
    Route::get('profiles/{profile}', [ProfileController::class, 'show'])->name('admin.profiles.show');
});
