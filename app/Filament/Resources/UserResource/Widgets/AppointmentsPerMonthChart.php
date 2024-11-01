<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Appointment; // Assuming this model exists for appointments
use Carbon\Carbon;

class AppointmentsPerMonthChart extends ChartWidget
{
    protected static ?string $heading = 'Appointments per Month';

    protected function getData(): array
    {
        // Example of generating sample data for appointments per month
        $data = Appointment::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Fill in months with no data (optional)
        $months = array_fill(1, 12, 0); // Fill an array with 12 months initialized to 0
        foreach ($data as $month => $count) {
            $months[$month] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Appointments',
                    'data' => array_values($months),
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
