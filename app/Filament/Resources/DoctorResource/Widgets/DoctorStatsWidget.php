<?php

namespace App\Filament\Widgets;

use App\Models\Consultation;
use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class DoctorStatsOverview extends BaseWidget
{
    protected static bool $isLazy = false;
    
    protected function getStats(): array
    {
        $doctorId = auth()->id();
        
        // Calculate current month's revenue
        $currentRevenue = Consultation::where('doctor_id', $doctorId)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('fee');
            
        // Calculate last month's revenue for comparison
        $lastMonthRevenue = Consultation::where('doctor_id', $doctorId)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->sum('fee');
            
        $revenueIncrease = $lastMonthRevenue > 0
            ? (($currentRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100
            : 0;
            
        // Calculate new patients
        $newPatients = Patient::whereHas('consultations', function ($query) use ($doctorId) {
            $query->where('doctor_id', $doctorId)
                ->whereMonth('created_at', Carbon::now()->month);
        })->count();
        
        $lastMonthPatients = Patient::whereHas('consultations', function ($query) use ($doctorId) {
            $query->where('doctor_id', $doctorId)
                ->whereMonth('created_at', Carbon::now()->subMonth()->month);
        })->count();
        
        $patientChange = $lastMonthPatients > 0
            ? (($newPatients - $lastMonthPatients) / $lastMonthPatients) * 100
            : 0;
            
        // Calculate new consultations
        $newConsultations = Consultation::where('doctor_id', $doctorId)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
            
        $lastMonthConsultations = Consultation::where('doctor_id', $doctorId)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->count();
            
        $consultationChange = $lastMonthConsultations > 0
            ? (($newConsultations - $lastMonthConsultations) / $lastMonthConsultations) * 100
            : 0;

        return [
            Stat::make('Revenue', '$' . number_format($currentRevenue, 2))
                ->description($revenueIncrease > 0 ? number_format($revenueIncrease, 1) . 'k increase' : number_format(abs($revenueIncrease), 1) . 'k decrease')
                ->descriptionIcon($revenueIncrease > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($revenueIncrease > 0 ? 'success' : 'danger')
                ->chart($this->getRevenueChartData()),
                
            Stat::make('New Patients', number_format($newPatients))
                ->description($patientChange > 0 ? $patientChange . '% increase' : abs($patientChange) . '% decrease')
                ->descriptionIcon($patientChange > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($patientChange > 0 ? 'success' : 'danger')
                ->chart($this->getPatientChartData()),
                
            Stat::make('New Consultations', number_format($newConsultations))
                ->description($consultationChange > 0 ? $consultationChange . '% increase' : abs($consultationChange) . '% decrease')
                ->descriptionIcon($consultationChange > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($consultationChange > 0 ? 'success' : 'danger')
                ->chart($this->getConsultationChartData()),
        ];
    }

    protected function getRevenueChartData(): array
    {
        $doctorId = auth()->id();
        return $this->getLastTwelveMonthsData('fee', $doctorId);
    }

    protected function getPatientChartData(): array
    {
        $doctorId = auth()->id();
        return $this->getLastTwelveMonthsData('patients', $doctorId);
    }

    protected function getConsultationChartData(): array
    {
        $doctorId = auth()->id();
        return $this->getLastTwelveMonthsData('consultations', $doctorId);
    }

    protected function getLastTwelveMonthsData(string $type, int $doctorId): array
    {
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            
            if ($type === 'fee') {
                $value = Consultation::where('doctor_id', $doctorId)
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->sum('fee');
            } elseif ($type === 'patients') {
                $value = Patient::whereHas('consultations', function ($query) use ($doctorId, $date) {
                    $query->where('doctor_id', $doctorId)
                        ->whereMonth('created_at', $date->month)
                        ->whereYear('created_at', $date->year);
                })->count();
            } else {
                $value = Consultation::where('doctor_id', $doctorId)
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count();
            }
            
            $data[] = $value;
        }
        
        return $data;
    }
}