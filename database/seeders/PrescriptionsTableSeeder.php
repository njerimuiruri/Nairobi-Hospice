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
        $doctors = Doctor::all(); // Get all doctors
        $patients = Patient::all(); // Get all patients

        if ($doctors && $patients) {
            // Create multiple prescription records for each patient and doctor
            foreach ($patients as $patient) {
                // Randomly select a doctor for each prescription
                $doctor = $doctors->random();

                Prescription::create([
                    'doctor_id' => $doctor->id,
                    'patient_id' => $patient->id,
                    'medication_name' => 'Amoxicillin', // Example medication
                    'dosage' => '500mg', // Example dosage
                    'start_date' => now()->subDays(rand(1, 10)), // Random start date within the last 10 days
                    'end_date' => now()->subDays(rand(1, 10))->addDays(7), // End date 7 days after the start date
                ]);
            }

            // Adding more prescriptions with different medication and dosages
            Prescription::create([
                'doctor_id' => $doctors->random()->id,
                'patient_id' => $patients->random()->id,
                'medication_name' => 'Paracetamol',
                'dosage' => '250mg',
                'start_date' => now()->subDays(5),
                'end_date' => now()->addDays(2),
            ]);

            Prescription::create([
                'doctor_id' => $doctors->random()->id,
                'patient_id' => $patients->random()->id,
                'medication_name' => 'Ibuprofen',
                'dosage' => '400mg',
                'start_date' => now()->subDays(3),
                'end_date' => now()->addDays(4),
            ]);

            Prescription::create([
                'doctor_id' => $doctors->random()->id,
                'patient_id' => $patients->random()->id,
                'medication_name' => 'Metformin',
                'dosage' => '500mg',
                'start_date' => now()->subDays(7),
                'end_date' => now()->addDays(10),
            ]);

            Prescription::create([
                'doctor_id' => $doctors->random()->id,
                'patient_id' => $patients->random()->id,
                'medication_name' => 'Aspirin',
                'dosage' => '100mg',
                'start_date' => now()->subDays(2),
                'end_date' => now()->addDays(5),
            ]);
        }
    }
}
