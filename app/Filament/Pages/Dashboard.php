<?php
namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getTitle(): string 
    {
        $role = auth()->user()->role->name ?? 'Guest';
        return "Hello " . ucfirst($role);
    }
}