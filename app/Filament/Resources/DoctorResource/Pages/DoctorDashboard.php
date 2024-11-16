<?php

namespace App\Filament\Resources\DoctorResource\Pages;

use App\Filament\Resources\DoctorResource;
use Filament\Resources\Pages\Page;

class DoctorDashboard extends Page
{
    protected static string $resource = DoctorResource::class;

    protected static string $view = 'filament.resources.doctor-resource.pages.doctor-dashboard';
}
