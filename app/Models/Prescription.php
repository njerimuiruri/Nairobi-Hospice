<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = ['doctor_id', 'patient_id', 'medication_name', 'dosage', 'start_date', 'end_date'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function medication()
{
    return $this->belongsTo(Medication::class);
}

}
