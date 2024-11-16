<?php

namespace App\Filament\Widgets;

use App\Models\Patient;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class DoctorCustomersChart extends ChartWidget
{
    protected static ?string $heading = 'Total Patients';
    
    protected function getData(): array
    {
        $data = $this->getCumulativePatients();
        
        return [
            'datasets' => [
                [
                    'label' => 'Total Patients',
                    'data' => $data['counts'],
                    'borderColor' => '#FFB547',
                    'fill' => true,
                    'backgroundColor' => 'rgba(255, 181, 71, 0.1)',
                ]
            ],
            'labels' => $data['labels'],
        ];
    }
    
    protected function getCumulativePatients(): array
    {
        $doctorId = auth()->id();
        $labels = [];
        $counts = [];
        $total = 0;
        
        for ($i = 0; $i < 12; $i++) {
            $date = Carbon::now()->startOfYear()->addMonths($i);
            $labels[] = $date->format('M');
            
            $monthlyCount = Patient::whereHas('consultations', function ($query) use ($doctorId, $date) {
                $query->where('doctor_id', $doctorId)
                    ->whereMonth('created_at', '<=', $date->month)
                    ->whereYear('created_at', '<=', $date->year);
            })->count();
            
            $counts[] = $monthlyCount;
        }
        
        return [
            'labels' => $labels,
            'counts' => $counts,
        ];
    }
    
    protected function getType(): string
    {
        return 'line';
    }
}