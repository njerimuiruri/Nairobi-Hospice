<?php
use Illuminate\Support\Facades\Route;
use App\Filament\Pages\AdminDashboard;
use App\Filament\Pages\ReceptionistDashboard;
use App\Filament\Pages\DoctorDashboard;
use App\Filament\Pages\PharmacistDashboard;

// Define the routes for each dashboard with a name that matches the role
Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', function () {
    return view('filament.pages.admin-dashboard');
})->name('filament.admin.pages.admin-dashboard');

Route::get('/receptionist/dashboard', function () {
    return view('filament.pages.receptionist-dashboard');
})->name('filament.admin.pages.receptionist-dashboard');

Route::get('/doctor/dashboard', function () {
    return view('filament.pages.doctor-dashboard');
})->name('filament.admin.pages.doctor-dashboard');

Route::get('/pharmacist/dashboard', function () {
    return view('filament.pages.pharmacist-dashboard');
})->name('filament.admin.pages.pharmacist-dashboard');

Route::get('/', function () {
    return view('welcome'); 
})->name('welcome');
// Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');

Route::get('/admin/dashboard', function () {
    $role = auth()->user()->role->name ?? 'guest';

    return match ($role) {
        'admin' => redirect()->route('filament.admin.pages.admin-dashboard'),
        'receptionist' => redirect()->route('filament.admin.pages.receptionist-dashboard'),
        'doctor' => redirect()->route('filament.admin.pages.doctor-dashboard'),
        'pharmacist' => redirect()->route('filament.admin.pages.pharmacist-dashboard'),
        default => redirect('/'),
    };
})->name('filament.admin.pages.dashboard');
