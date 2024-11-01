<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run()
    {
        UserRole::create(['name' => 'admin', 'description' => 'AdministraUserRole, has access to all settings']);
        UserRole::create(['name' => 'doctor', 'description' => 'Doctor role, can access medical records and appointments']);
        UserRole::create(['name' => 'receptionist', 'description' => 'Receptionist role, manages appointments and patient check-ins']);
        UserRole::create(['name' => 'pharmacist', 'description' => 'Pharmacist role, manages medications and prescriptions']);
    }
}
