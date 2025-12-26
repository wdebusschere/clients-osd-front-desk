<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Auth\OSDHQController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('login/osd-hq')->group(function () {
    Route::get('/', [OSDHQController::class, 'redirectToOSDHQ'])->name('login.osd-hq');
    Route::get('callback', [OSDHQController::class, 'handleOSDHQCallback'])->name('callback');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('activity-logs', ActivityLogController::class)->only('index');
    Route::resource('notifications', NotificationController::class)->only('index');
    Route::resource('roles', RoleController::class)->except('show');
    Route::resource('users', UserController::class)->except('create', 'store', 'destroy');
});
