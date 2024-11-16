<?php

namespace App\Filament\Widgets;

use App\Models\Consultation;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class DoctorOrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Consultations per Month';
    
    protected function getData(): array
    {
        $data = $this->getMonthlyConsultations();
        
        return [
            'datasets' => [
                [
                    'label' => 'Consultations',
                    'data' => $data['counts'],
                    'borderColor' => '#FFB547',
                    'fill' => true,
                    'backgroundColor' => 'rgba(255, 181, 71, 0.1)',
                ]
            ],
            'labels' => $data['labels'],
        ];
    }
    
    protected function getMonthlyConsultations(): array
    {
        $doctorId = auth()->id();
        $labels = [];
        $counts = [];
        
        for ($i = 0; $i < 12; $i++) {
            $date = Carbon::now()->startOfYear()->addMonths($i);
            $labels[] = $date->format('M');
            
            $counts[] = Consultation::where('doctor_id', $doctorId)
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
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