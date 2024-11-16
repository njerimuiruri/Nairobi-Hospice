<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Consultation;
use App\Models\Doctor;
use Carbon\Carbon;

class AppointmentStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        
        // Today's appointments
        $todayAppointments = Consultation::whereDate('created_at', $today)->count();
        
        // Pending appointments
        $pendingAppointments = Consultation::where('status', 'pending')->count();
        
        // Active doctors today
        $activeDoctors = Doctor::whereHas('consultations', function($query) use ($today) {
            $query->whereDate('created_at', $today);
        })->count();

        return [
            Stat::make("Today's Appointments", $todayAppointments)
                ->description('Total appointments today')
                ->color('success'),

            Stat::make('Pending Appointments', $pendingAppointments)
                ->description('Awaiting consultation')
                ->color('warning'),

            Stat::make('Active Doctors', $activeDoctors)
                ->description('Doctors with appointments today')
                ->color('info'),
        ];
    }
}