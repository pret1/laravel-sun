<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\DashboardController;

Route::group(['prefix'=>'client','middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('client.dashboard');
});
