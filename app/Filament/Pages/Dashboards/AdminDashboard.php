<?php

namespace App\Filament\Pages\Dashboards;

use Filament\Pages\Dashboard as BaseDashboard;

class AdminDashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $slug = 'dashboard';
    
    // Public property to hold the message

    public function mount()
    {
        // Set the message directly
        echo 'hello';
    }
}
