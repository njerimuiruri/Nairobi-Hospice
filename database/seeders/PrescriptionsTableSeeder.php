<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prescription;
use App\Models\Doctor;
use App\Models\Patient;

class PrescriptionsTableSeeder extends Seeder
{
    public function run(): void
    {
        $doctor = Doctor::first();
        $patient = Patient::first();

        if ($doctor && $patient) {
            Prescription::create([
                'doctor_id' => $doctor->id,
                'patient_id' => $patient->id,
                'medication_name' => 'Amoxicillin',
                'dosage' => '500mg',
                'start_date' => now(),
                'end_date' => now()->addDays(7),
            ]);
        }
    }
}