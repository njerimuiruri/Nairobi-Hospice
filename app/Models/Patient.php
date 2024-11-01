<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'gender', 'address', 'phone_number', 'email'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    public function patientMedications()
    {
        return $this->hasMany(PatientMedication::class);
    }

    public function billings()
    {
        return $this->hasMany(Billing::class);
    }
    public function consultations()
{
    return $this->hasMany(Consultation::class);
}
public function prescriptions()
{
    return $this->hasMany(Prescription::class);
}
public function getFullNameAttribute()
{
    return "{$this->first_name} {$this->last_name}";
}


}
