<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ConsultationChart extends ChartWidget
{
    protected static ?string $heading = 'Consultation Overview';

    /**
     * Restrict visibility to admins only.
     */
    public static function canView(): bool
{
    $user = Auth::user();
    return $user && ($user->userRole->name === 'admin' || $user->userRole->name === 'doctor');
}


    /**
     * Get chart data for the widget.
     */
    protected function getData(): array
    {
        // Query to fetch the number of consultations per date from the 'consultations' table
        $consultationData = DB::table('consultations')
            ->selectRaw('consultation_date, COUNT(*) as total_consultations')
            ->groupBy('consultation_date')
            ->orderBy('consultation_date')
            ->get();

        // Prepare data for chart
        $dates = $consultationData->pluck('consultation_date')->toArray(); // Dates for x-axis
        $totalConsultations = $consultationData->pluck('total_consultations')->toArray(); // Consultation count for y-axis

        return [
            'datasets' => [
                [
                    'label' => 'Total Consultations',
                    'data' => $totalConsultations,
                    'backgroundColor' => '#FF5722',
                    'borderColor' => '#FF5722',
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
        return 'line'; // Line chart type
    }
}
