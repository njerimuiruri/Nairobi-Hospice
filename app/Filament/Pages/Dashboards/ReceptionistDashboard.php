<?php

namespace App\Filament\Pages\Dashboards;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Gate;

class ReceptionistDashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $slug = 'receptionist-dashboard';
    
    public function mount(): void
    {
        if (!auth()->user()->role?->name === 'receptionist') {
            $this->redirect($this->getRedirectUrl());
        }
    }
}

