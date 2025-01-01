<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::permanentRedirect('/', '/dashboard');

Route::get('/panel/login', [AuthController::class, 'login'])->name('login');
Route::post('/panel/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::middleware(['auth', 'web'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('settings')->group(function () {
            Route::get('/', [SettingsController::class, 'index'])->name('settings');
            Route::post('/', [SettingsController::class, 'updateLocale'])->name('settings.updateLocale');
        });
    });

    Route::post('/panel/logout', [AuthController::class, 'logout'])->name('logout');
});
