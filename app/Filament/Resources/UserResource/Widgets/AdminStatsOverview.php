<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Consultation;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Prescription;
use Carbon\Carbon;

class AdminStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();

        // Total Revenue This Month
        $thisMonthRevenue = Consultation::whereMonth('created_at', $thisMonth->month)
            ->sum('consultation_fee');
        $lastMonthRevenue = Consultation::whereMonth('created_at', $lastMonth->month)
            ->sum('consultation_fee');
        $revenueChange = $lastMonthRevenue ? (($thisMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 : 0;

        // New Patients This Month
        $newPatients = Patient::whereMonth('created_at', $thisMonth->month)->count();
        $lastMonthPatients = Patient::whereMonth('created_at', $lastMonth->month)->count();
        $patientChange = $lastMonthPatients ? (($newPatients - $lastMonthPatients) / $lastMonthPatients) * 100 : 0;

        // Total Consultations This Month
        $consultations = Consultation::whereMonth('created_at', $thisMonth->month)->count();

        return [
            Stat::make('Total Revenue', '$' . number_format($thisMonthRevenue, 2))
                ->description($revenueChange >= 0 ? '+' . number_format($revenueChange, 1) . '% increase' : number_format($revenueChange, 1) . '% decrease')
                ->descriptionIcon($revenueChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($revenueChange >= 0 ? 'success' : 'danger')
                ->chart([
                    $lastMonthRevenue,
                    $thisMonthRevenue,
                ]),

            Stat::make('New Patients', $newPatients)
                ->description($patientChange >= 0 ? '+' . number_format($patientChange, 1) . '% increase' : number_format($patientChange, 1) . '% decrease')
                ->descriptionIcon($patientChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($patientChange >= 0 ? 'success' : 'danger'),

            Stat::make('Total Consultations', $consultations)
                ->description('This month')
                ->chart([
                    Consultation::whereMonth('created_at', $lastMonth->month)->count(),
                    $consultations,
                ]),
        ];
    }
}