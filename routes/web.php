<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Tenant\User\CreateUserController;
use App\Http\Controllers\Tenant\TenantController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('admin/dashboard');
    })->name('admin.dashboard');

    Route::get('users', [UserController::class, 'index'])->name('admin.users');
    Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('users', [CreateUserController::class, 'store']);

    Route::get('tenants', [TenantController::class, 'index'])->name('admin.tenants');
    Route::get('tenants/create', [TenantController::class, 'create'])->name('admin.tenants.create');
    Route::post('tenants', [TenantController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    // Example tenant access
    // Route::prefix('/{tenant}')->group(function () {
    //     Route::get('/', [TenantController::class, 'show'])->name('tenant.show');
    // });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
