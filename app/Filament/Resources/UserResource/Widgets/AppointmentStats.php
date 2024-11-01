<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\ChartWidget;

class AppointmentStats extends ChartWidget
{
    protected static ?string $heading = 'Appointment Statistics';

    protected function getData(): array
    {
        // Dummy data for example
        return [
            'datasets' => [
                [
                    'label' => 'Appointments',
                    'data' => [10, 15, 20, 25, 30],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Line chart, can also use 'bar' or other chart types
    }
}
