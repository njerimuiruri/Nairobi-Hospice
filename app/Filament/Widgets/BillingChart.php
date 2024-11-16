<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BillingChart extends ChartWidget
{
    protected static ?string $heading = 'Billing Overview';

    /**
     * Restrict visibility to admins only.
     */
    public static function canView(): bool
    {
        $user = Auth::user();
        return $user && ($user->userRole->name === 'admin' || $user->userRole->name === 'receptionist');
    }
    

    /**
     * Get chart data for the widget.
     */
    protected function getData(): array
    {
        // Query to fetch the total billing amount per date from the 'billing' table
        $billingData = DB::table('billing')
            ->selectRaw('billing_date, SUM(amount) as total_amount')
            ->groupBy('billing_date')
            ->orderBy('billing_date')
            ->get();

        // Prepare data for chart
        $dates = $billingData->pluck('billing_date')->toArray(); // Dates for x-axis
        $totalAmounts = $billingData->pluck('total_amount')->toArray(); // Billing amounts for y-axis

        return [
            'datasets' => [
                [
                    'label' => 'Total Billing Amount',
                    'data' => $totalAmounts,
                    'backgroundColor' => '#4CAF50',
                    'borderColor' => '#4CAF50',
                    'fill' => false, // Line chart with no fill under the line
                ],
            ],
            'labels' => $dates, // The labels (dates) on the x-axis
        ];
    }

    /**
     * Define the chart type.
     */
    protected function getType(): string
    {
        return 'line'; // Using a line chart type
    }
}
