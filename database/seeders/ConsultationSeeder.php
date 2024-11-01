<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Consultation;
use App\Models\Patient;
use App\Models\Doctor;
use Carbon\Carbon;

class ConsultationSeeder extends Seeder
{
    public function run()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();

        foreach ($patients as $patient) {
            // Assign a random doctor for each consultation
            $doctor = $doctors->random();

            Consultation::create([
                'patient_id' => $patient->id,
                'doctor_id' => $doctor->id,
                'consultation_date' => Carbon::now()->subDays(rand(1, 30)),
                'notes' => 'Sample medical notes for consultation.',
                'prescription' => 'Sample prescription details.',
            ]);
        }
    }
}
