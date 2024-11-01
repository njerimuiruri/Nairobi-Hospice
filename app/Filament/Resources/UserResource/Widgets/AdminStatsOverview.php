<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Revenue', '$192.10k')
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([10, 25, 30, 40, 60, 70, 90])
                ->color('success'),

            Stat::make('New customers', '1.34k')
                ->description('3% decrease')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->chart([5, 15, 20, 10, 8, 5, 12])
                ->color('danger'),

            Stat::make('New orders', '3.54k')
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([30, 40, 50, 60, 70, 80, 90])
                ->color('success'),
        ];
    }
}
