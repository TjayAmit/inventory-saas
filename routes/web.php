<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {

        Route::get('/', function () {
            return Inertia::render('welcome');
        })->name('home');

        Route::middleware(['auth', 'verified'])->group(function () {
            Route::get('dashboard', function () {
                return Inertia::render('dashboard');
            })->name('dashboard');
        });

        Route::middleware(['auth'])->group(function () {
            // Example tenant access
        });
    });
}

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
