<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class DoctorGreetingWidget extends Widget
{
    protected static string $view = 'filament.widgets.doctor-greeting-widget';

    protected function getViewData(): array
    {
        $doctorName = Auth::user()->name ?? 'Doctor';
        return [
            'doctorName' => $doctorName,
        ];
    }
}
