<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Pages\AdminDashboard;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'can:admin-access'])
    ->prefix('admin')
    ->name('filament.admin.pages.')
    ->group(function () {
        Route::get('dashboard', AdminDashboard::class)->name('admin-dashboard');
    });