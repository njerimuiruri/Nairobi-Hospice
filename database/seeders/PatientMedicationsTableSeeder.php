<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;  // Add this line to import the DB facade
use Illuminate\Database\Seeder;
class PatientMedicationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('patient_medications')->insert([
            'patient_id' => 1,
            'medication_id' => 1,
            'dosage' => '500mg',
            'start_date' => '2023-12-03',
            'end_date' => '2023-12-10',
        ]);
    }
}
