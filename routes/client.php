<?php

use App\Http\Controllers\Client\ChatController;
use App\Http\Controllers\Client\PostController;
use App\Http\Controllers\Client\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\DashboardController;

Route::group(['prefix'=>'client','middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('client.dashboard');

    Route::get('/profiles/{profile}', [ProfileController::class, 'show'])->name('client.profiles.show');
    Route::post('/profiles/{profile}/toggle-subscribe', [ProfileController::class, 'toggleSubscribe'])
        ->name('client.profiles.toggle-subscribe');

    Route::post('/chats', [ChatController::class, 'store'])->name('client.chats.store');
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('client.chats.show');

    Route::post('/chats/{chat}/messages', [ChatController::class, 'storeMessage'])
        ->name('client.chats.messages.store');

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('client.posts.show');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('client.posts.destroy');


    Route::post('/posts/{post}/toggle-like', [PostController::class, 'toggleLike'])->name('client.posts.like.toggle');
    Route::post('/posts/{post}/comments/{comment?}', [PostController::class, 'storeComments'])->name('client.posts.comments.store');
    Route::get('/posts/{post}/comments', [PostController::class, 'indexComments'])->name('client.posts.comments.index');
    Route::get('/posts/{post}/reposts', [PostController::class, 'indexReposts'])->name('client.posts.reposts.index');
    Route::post('/posts/{post}/repost', [PostController::class, 'repost'])->name('client.posts.repost');

    Route::post('/comments/{comment}/toggle-like', [PostController::class, 'toggleLikeComment'])->name('client.comment.like.toggle');
    Route::get('/comments/{comment}/child-comments', [PostController::class, 'indexChildComments'])->name('client.comments.child-comments.index');
});
