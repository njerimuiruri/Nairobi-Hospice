<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Consultation;
use Carbon\Carbon;

class RevenueAnalyticsWidget extends ChartWidget
{
    protected static ?string $heading = 'Revenue Analytics';
    
    protected function getData(): array
    {
        $data = collect();
        
        // Get last 6 months of revenue data
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            
            $revenue = Consultation::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('consultation_fee');
                
            $data->push([
                'month' => $date->format('M'),
                'revenue' => $revenue,
            ]);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $data->pluck('revenue')->toArray(),
                    'backgroundColor' => 'rgba(34, 197, 94, 0.5)',
                    'borderColor' => 'rgb(34, 197, 94)',
                ],
            ],
            'labels' => $data->pluck('month')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}