<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\LogDbQueries;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'jwt.auth', 'prefix' => 'auth'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});

//Route::group(['middleware' => ['jwt.auth', RoleMiddleware::class]], function () {
Route::group(['middleware' => ['jwt.auth', LogDbQueries::class]], function () {
    Route::apiResource('posts', PostController::class);
    Route::apiResource('articles', ArticleController::class);
});

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

Route::apiResource('tags', TagController::class);

Route::apiResource('users', UserController::class);
