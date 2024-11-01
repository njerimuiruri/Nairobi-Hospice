<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets;
use App\Models\User;
// use App\Filament\Resources\UserResource\Widgets\AppointmentStats;
// use App\Filament\Resources\UserResource\Widgets\AppointmentsPerMonthChart;
use App\Filament\Resources\UserResource\Widgets\AdminStatsOverview;

class AdminDashboard extends BaseDashboard
{
    protected static ?string $title = 'Admin Dashboard';

    protected static string $routePath = '/dashboard';

    protected static ?string $navigationLabel = 'Dashboard';

    public static function canView(): bool
    {
        return auth()->user() && auth()->user()->hasRole('admin');
    }

    public function getWidgets(): array
    {
        return [
            AdminStatsOverview::class, 
             // Example overview stats widget for admin
            // AppointmentStats::class,   
             // Widget for general appointment statistics
            // AppointmentsPerMonthChart::class,  // Widget for appointments per month chart
            // Add other widgets as needed for admin
        ];
    }
}
