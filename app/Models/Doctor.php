<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'phone_number', 'specialization', 'availability_status'];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // Define the consultations relationship
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }
    public function prescriptions()
{
    return $this->hasMany(Prescription::class);
}

}
