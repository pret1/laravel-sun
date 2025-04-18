<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ProfileController;

Route::group(['prefix'=>'admin','middleware' => ['auth', IsAdminMiddleware::class]], function () {
    Route::get('posts', [PostController::class, 'index'])->name('admin.posts.index');
    Route::get('posts/create', [PostController::class, 'create'])->name('admin.posts.create');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('admin.posts.show');
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
    Route::patch('posts/{post}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::post('posts', [PostController::class, 'store'])->name('admin.posts.store');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('admin.posts.destroy');

    Route::get('comments', [CommentController::class, 'index'])->name('admin.comments.index');
    Route::get('comments/create', [CommentController::class, 'create'])->name('admin.comments.create');
    Route::get('comments/{comment}', [CommentController::class, 'show'])->name('admin.comments.show');
    Route::post('comments', [CommentController::class, 'store'])->name('admin.comments.store');

    Route::get('articles', [ArticleController::class, 'index'])->name('admin.articles.index');
    Route::get('articles/create', [ArticleController::class, 'create'])->name('admin.articles.create');
    Route::get('articles/{article}', [ArticleController::class, 'show'])->name('admin.articles.show');
    Route::post('articles', [ArticleController::class, 'store'])->name('admin.articles.store');

    Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');
    Route::post('categories', [CategoryController::class, 'store'])->name('admin.categories.store');

    Route::get('profiles', [ProfileController::class, 'index'])->name('admin.profiles.index');
    Route::get('profiles/create', [ProfileController::class, 'create'])->name('admin.profiles.create');
    Route::get('profiles/{profile}', [ProfileController::class, 'show'])->name('admin.profiles.show');
    Route::post('profiles', [ProfileController::class, 'store'])->name('admin.profiles.store');

    Route::get('permissions', [PermissionController::class, 'index'])->name('admin.permissions.index');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('admin.permissions.create');
    Route::get('permissions/{permission}', [PermissionController::class, 'show'])->name('admin.permissions.show');
    Route::post('permissions', [PermissionController::class, 'store'])->name('admin.permissions.store');

    Route::get('roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::get('roles/{role}', [RoleController::class, 'show'])->name('admin.roles.show');
    Route::post('roles', [RoleController::class, 'store'])->name('admin.roles.store');

    Route::get('tags', [TagController::class, 'index'])->name('admin.tags.index');
    Route::get('tags/create', [TagController::class, 'create'])->name('admin.tags.create');
    Route::get('tags/{tag}', [TagController::class, 'show'])->name('admin.tags.show');
    Route::post('tags', [TagController::class, 'store'])->name('admin.tags.store');
});
