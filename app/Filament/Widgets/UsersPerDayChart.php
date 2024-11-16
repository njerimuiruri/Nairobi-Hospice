<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;

class UsersPerDayChart extends ChartWidget
{
    protected static ?string $heading = 'Users Per Day';

    protected function getData(): array
    {
        $data = collect(range(1, 7))->map(function ($days) {
            return [
                'date' => now()->subDays($days)->format('D'),
                'count' => User::whereDate('created_at', now()->subDays($days))->count(),
            ];
        });
        return [
            'datasets' => [
                [
                    'label' => 'New Users',
                    'data' => $data->pluck('count')->toArray(),
                    'backgroundColor' => '#4CAF50',
                    'borderColor' => '#4CAF50',
                ],
            ],
            'labels' => $data->pluck('date')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}