<?php

use App\Http\Controllers\Client\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\DashboardController;

Route::group(['prefix'=>'client','middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('client.dashboard');

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('client.posts.show');
    Route::post('/posts/{post}/toggle-like', [PostController::class, 'toggleLike'])->name('client.posts.like.toggle');
    Route::post('/posts/{post}/comments', [PostController::class, 'storeComments'])->name('client.posts.comments.store');
    Route::get('/posts/{post}/comments', [PostController::class, 'indexComments'])->name('client.posts.comments.index');
});
