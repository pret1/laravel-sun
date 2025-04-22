<?php

use App\Http\Controllers\Client\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\DashboardController;

Route::group(['prefix'=>'client','middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('client.dashboard');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('client.posts.show');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('client.posts.destroy');


    Route::post('/posts/{post}/toggle-like', [PostController::class, 'toggleLike'])->name('client.posts.like.toggle');
    Route::post('/comments/{comment}/toggle-like', [PostController::class, 'toggleLikeComment'])->name('client.comment.like.toggle');
    Route::post('/posts/{post}/comments', [PostController::class, 'storeComments'])->name('client.posts.comments.store');
    Route::get('/posts/{post}/comments', [PostController::class, 'indexComments'])->name('client.posts.comments.index');
    Route::post('/posts/{post}/child-comments/{comment}', [PostController::class, 'storeChildComments'])->name('client.posts.child-comments.store');
    Route::get('/posts/{post}/child-comments/{comment}', [PostController::class, 'indexChildComments'])->name('client.posts.child-comments.index');
});
