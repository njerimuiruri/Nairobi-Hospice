<?php
namespace App\Filament\Pages;

use Livewire\Component;
use Filament\Pages\Page;

class DoctorDashboard extends Page
{
    public string $message = 'faith';

    public function mount(): void
    {
        $this->message = 'Hello, Doctor!';
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('filament.pages.doctor-dashboard');
    }
    public function changeMessage()
{
    $this->message = 'Message has been changed!';
}

}
