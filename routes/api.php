<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class);

Route::group(['prefix' => 'comments'], function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::post('/', [CommentController::class, 'store']);
    Route::get('/{comment}', [CommentController::class, 'show']);
    Route::patch('/{comment}', [CommentController::class, 'update']);
    Route::delete('/{comment}', [CommentController::class, 'destroy']);
});

Route::apiResource('categories', CategoryController::class);

Route::group(['prefix' => 'likes'], function () {
    Route::get('/', [LikeController::class, 'index']);
    Route::post('/', [LikeController::class, 'store']);
    Route::get('/{like}', [LikeController::class, 'show']);
    Route::patch('/{like}', [LikeController::class, 'update']);
    Route::delete('/{like}', [LikeController::class, 'destroy']);
});

Route::apiResource('profiles', ProfileController::class);

Route::apiResource('roles', RoleController::class);

Route::apiResource('tags', RoleController::class);
