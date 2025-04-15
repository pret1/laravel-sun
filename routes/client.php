<?php

use App\Http\Controllers\Client\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\DashboardController;

Route::group(['prefix'=>'client','middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('client.dashboard');

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('client.posts.show');
});
