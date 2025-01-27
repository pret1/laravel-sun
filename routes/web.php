<?php

use App\Http\Controllers\CategoryController;
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

Route::group(['prefix' => 'category'], function () {
    Route::get('/index', [CategoryController::class, 'index']);
    Route::get('/{category}/show', [CategoryController::class, 'show']);
    Route::get('/store', [CategoryController::class, 'store']);
    Route::get('/{category}/update', [CategoryController::class, 'update']);
    Route::get('/{category}/destroy', [CategoryController::class, 'destroy']);
});
