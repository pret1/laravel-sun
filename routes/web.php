<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts/index', [PostController::class, 'index']);
Route::get('/posts/{post}/show', [PostController::class, 'show']);
Route::get('/posts/store', [PostController::class, 'store']);
Route::get('/posts/update', [PostController::class, 'update']);
Route::get('/posts/destroy', [PostController::class, 'destroy']);
