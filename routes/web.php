<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
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

Route::group(['prefix' => 'categories'], function () {
    Route::get('/index', [CategoryController::class, 'index']);
    Route::get('/{category}/show', [CategoryController::class, 'show']);
    Route::get('/store', [CategoryController::class, 'store']);
    Route::get('/{category}/update', [CategoryController::class, 'update']);
    Route::get('/{category}/destroy', [CategoryController::class, 'destroy']);
});

Route::group(['prefix' => 'comments'], function () {
    Route::get('/index', [CommentController::class, 'index']);
    Route::get('/{comment}/show', [CommentController::class, 'show']);
    Route::get('/store', [CommentController::class, 'store']);
    Route::get('/{comment}/update', [CommentController::class, 'update']);
    Route::get('/{comment}/destroy', [CommentController::class, 'destroy']);
});

Route::group(['prefix' => 'likes'], function () {
    Route::get('/index', [LikeController::class, 'index']);
    Route::get('/{like}/show', [LikeController::class, 'show']);
    Route::get('/store', [LikeController::class, 'store']);
    Route::get('/{like}/update', [LikeController::class, 'update']);
    Route::get('/{like}/destroy', [LikeController::class, 'destroy']);
});
