<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Fetch appointment metrics
        $totalAppointmentsThisMonth = Appointment::whereMonth('created_at', Carbon::now()->month)->count();
        $completedAppointments = Appointment::where('status', 'completed')->count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $totalAppointments = Appointment::count();

        return [
            Stat::make('Appointments This Month', $totalAppointmentsThisMonth)
                ->description('Total for current month')
                ->icon('heroicon-o-calendar')
                ->color('primary'),

            Stat::make('Completed Appointments', $completedAppointments)
                ->description('All-time completed')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Pending Appointments', $pendingAppointments)
                ->description('Awaiting confirmation')
                ->icon('heroicon-o-clock')
                ->color('warning'),

            Stat::make('Total Appointments', $totalAppointments)
                ->description('All-time total')
                ->icon('heroicon-o-collection')
                ->color('info'),
        ];
    }
}
