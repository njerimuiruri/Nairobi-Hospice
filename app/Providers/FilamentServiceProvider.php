<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Filament::serving(function () {
            // Check if the user is authenticated
            if (auth()->check()) {
                // Ensure the user has a role before attempting to access it
                $user = auth()->user();
                if ($user && $user->role) {
                    $role = $user->role->name;

                    // Redirect based on the user's role
                    switch ($role) {
                        case 'admin':
                            return redirect()->route('filament.pages.admin-dashboard');
                        case 'doctor':
                            return redirect()->route('filament.pages.doctor-dashboard');
                        case 'receptionist':
                            return redirect()->route('filament.pages.receptionist-dashboard');
                        case 'pharmacist':
                            return redirect()->route('filament.pages.pharmacist-dashboard');
                        default:
                            return redirect('/'); // Fallback route
                    }
                }
            }
        });
    }
}
