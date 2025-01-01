<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Livewire\Localization;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::permanentRedirect('/', '/dashboard');

Route::get('/panel/login', [AuthController::class, 'login'])->name('login');
Route::post('/panel/login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::middleware(['auth', 'web'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('settings')->group(function () {
            Route::get('/', [SettingsController::class, 'index'])->name('settings');
            Route::post('/', [Localization::class, 'updateLocale'])->name('settings.updateLocale');
        });
    });

    Route::post('/panel/logout', [AuthController::class, 'logout'])->name('logout');
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/custom/livewire/update', $handle)
        ->middleware(['auth', 'web']);
});
