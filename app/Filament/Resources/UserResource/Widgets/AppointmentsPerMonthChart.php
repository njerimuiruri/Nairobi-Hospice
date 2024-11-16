<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Consultation;
use Carbon\Carbon;

class AppointmentsPerMonthChart extends ChartWidget
{
    protected static ?string $heading = 'Monthly Appointments Overview';
    
    protected function getData(): array
    {
        $data = collect();
        
        // Get last 12 months of appointment data
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            
            $appointmentCount = Consultation::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $data->push([
                'month' => $date->format('M'),
                'appointments' => $appointmentCount,
            ]);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Appointments',
                    'data' => $data->pluck('appointments')->toArray(),
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.5)',
                    'borderColor' => 'rgb(59, 130, 246)',
                ],
            ],
            'labels' => $data->pluck('month')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}