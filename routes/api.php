<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('posts', PostController::class);

Route::group(['prefix' => 'comments'], function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::get('/store', [CommentController::class, 'store']);
    Route::get('/{comment}', [CommentController::class, 'show']);
    Route::get('/{comment}', [CommentController::class, 'update']);
    Route::get('/{comment}', [CommentController::class, 'destroy']);
});
