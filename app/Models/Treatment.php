<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $fillable = ['patient_id', 'staff_id', 'treatment_type', 'treatment_description', 'treatment_date'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function billings()
    {
        return $this->hasMany(Billing::class);
    }
}
