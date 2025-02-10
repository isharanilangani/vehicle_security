<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use Filament\Facades\Filament;

Route::get('/admin', function () {
    return Filament::renderDashboard();
})->name('filament.admin.dashboard');

Route::get('/security', function () {
    return Filament::renderDashboard();
})->name('filament.security.dashboard');

Route::get('/vehicle-owner', function () {
    return Filament::renderDashboard();
})->name('filament.vehicle-owner.dashboard');

