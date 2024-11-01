<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;

class Medication extends Model
{
    protected $fillable = ['name', 'description', 'stock'];

    public function checkStockAndNotifyAdmin()
    {
        if ($this->stock <= 5) { // Low stock threshold
            Notification::make()
                ->title('Low Stock Alert')
                ->body("The stock for {$this->name} is running low (Only {$this->stock} left).")
                ->icon('heroicon-o-exclamation')
                ->iconColor('danger')
                ->sendToRoles(['admin']);
        }
    }
    public function patientMedications()
    {
        return $this->hasMany(PatientMedication::class);
    }
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
