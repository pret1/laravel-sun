<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'posts'], function () {
    Route::get('/index', [PostController::class, 'index']);
    Route::get('/{post}/show', [PostController::class, 'show']);
    Route::get('/store', [PostController::class, 'store']);
    Route::get('/{post}/update', [PostController::class, 'update']);
    Route::get('/{post}/destroy', [PostController::class, 'destroy']);
});

