<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'roles'], function () {
    Route::get('/index', [RoleController::class, 'index']);
    Route::get('/{role}/show', [RoleController::class, 'show']);
    Route::get('/store', [RoleController::class, 'store']);
    Route::get('/{role}/update', [RoleController::class, 'update']);
    Route::get('/{role}/destroy', [RoleController::class, 'destroy']);
});

Route::group(['prefix' => 'tags'], function () {
    Route::get('/index', [TagController::class, 'index']);
    Route::get('/{tag}/show', [TagController::class, 'show']);
    Route::get('/store', [TagController::class, 'store']);
    Route::get('/{tag}/update', [TagController::class, 'update']);
    Route::get('/{tag}/destroy', [TagController::class, 'destroy']);
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/index', [UserController::class, 'index']);
    Route::get('/{user}/show', [UserController::class, 'show']);
    Route::get('/store', [UserController::class, 'store']);
    Route::get('/{user}/update', [UserController::class, 'update']);
    Route::get('/{user}/destroy', [UserController::class, 'destroy']);
});

Route::group(['prefix' => 'profiles'], function () {
    Route::get('/index', [ProfileController::class, 'index']);
    Route::get('/{profile}/show', [ProfileController::class, 'show']);
    Route::get('/store', [ProfileController::class, 'store']);
    Route::get('/{profile}/update', [ProfileController::class, 'update']);
    Route::get('/{profile}/destroy', [ProfileController::class, 'destroy']);
});

