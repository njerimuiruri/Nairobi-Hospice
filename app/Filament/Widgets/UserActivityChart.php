<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class UserActivityChart extends ChartWidget
{
    protected static ?string $heading = 'User Activity';

    /**
     * Restrict visibility to doctors only.
     */
    public static function canView(): bool
    {
        $user = Auth::user();
        return $user && $user->userRole->name === 'admin'; // Assuming '2' is the ID for the 'doctor' role
    }

    /**
     * Get chart data for the widget.
     */
    protected function getData(): array
    {
        // Example static data
        $activeUsers = [65, 70, 75, 60, 80, 85, 90];
        $inactiveUsers = [25, 20, 15, 30, 10, 5, 0];

        return [
            'datasets' => [
                [
                    'label' => 'Active Users',
                    'data' => $activeUsers,
                    'backgroundColor' => '#4CAF50',
                    'borderColor' => '#4CAF50',
                ],
                [
                    'label' => 'Inactive Users',
                    'data' => $inactiveUsers,
                    'backgroundColor' => '#FF5252',
                    'borderColor' => '#FF5252',
                ],
            ],
            'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        ];
    }

    /**
     * Define the chart type.
     */
    protected function getType(): string
    {
        return 'line'; // Line chart type
    }
}
