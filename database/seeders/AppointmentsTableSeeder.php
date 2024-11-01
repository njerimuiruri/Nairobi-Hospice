<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;  // Add this line to import the DB facade
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('appointments')->insert([
            'patient_id' => 1,
            'staff_id' => 1,
            'appointment_date' => '2023-12-01',
            'appointment_time' => '10:00:00',
            'description' => 'Routine check-up',
            'status' => 'Scheduled',
        ]);
    }
}

