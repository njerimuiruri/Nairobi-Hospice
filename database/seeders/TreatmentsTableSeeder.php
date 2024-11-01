<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;  // Add this line to import the DB facade
use Illuminate\Database\Seeder;
class TreatmentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('treatments')->insert([
            'patient_id' => 1,
            'staff_id' => 1,
            'treatment_type' => 'General Checkup',
            'treatment_description' => 'Annual physical examination',
            'treatment_date' => '2023-12-02',
        ]);
    }
}
