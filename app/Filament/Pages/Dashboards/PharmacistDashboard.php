<?php

namespace App\Filament\Pages\Dashboards;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Gate;

class PharmacistDashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $slug = 'pharmacist-dashboard';
    
    public function mount(): void
    {
        if (!auth()->user()->role?->name === 'pharmacist') {
            $this->redirect($this->getRedirectUrl());
        }
    }
}