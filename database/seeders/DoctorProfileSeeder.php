<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\DoctorProfile;
use Illuminate\Database\Seeder;

class DoctorProfileSeeder extends Seeder
{
    public function run()
    {
        // Use a unique email address for each seeding process
        $doctor = Doctor::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane.smith@example.com', // Unique email
            'phone_number' => '0987654321',
            'specialization' => 'Pediatrics',
            'availability_status' => 'Busy',
        ]);

        // Insert the doctor profile
        DoctorProfile::create([
            'doctor_id' => $doctor->id,
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane.smith@example.com',
            'phone_number' => '0987654321',
            'specialization' => 'Pediatrics',
            'availability_status' => 'Busy',
        ]);
    }
}
