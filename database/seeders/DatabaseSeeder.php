<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRole;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            PatientsTableSeeder::class,
            StaffTableSeeder::class,
            AppointmentsTableSeeder::class,
            TreatmentsTableSeeder::class,
            MedicationsTableSeeder::class,
            PatientMedicationsTableSeeder::class,
            BillingTableSeeder::class,
            ReceptionistsTableSeeder::class,
            DoctorsTableSeeder::class,
            ConsultationSeeder::class,
            PrescriptionsTableSeeder::class,
            DoctorProfileSeeder::class,
        ]);

        $this->seedUsersWithRoles();
    }

    private function seedUsersWithRoles()
    {
        // Retrieve the roles by name
        $adminRole = UserRole::where('name', 'admin')->first();
        $doctorRole = UserRole::where('name', 'doctor')->first();
        $receptionistRole = UserRole::where('name', 'receptionist')->first();
        $pharmacistRole = UserRole::where('name', 'pharmacist')->first();

        // Create an admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);

        // Create a doctor user
        User::factory()->create([
            'name' => 'Doctor User',
            'email' => 'doctor@example.com',
            'password' => bcrypt('password'),
            'role_id' => $doctorRole->id,
        ]);

        // Create a receptionist user
        User::factory()->create([
            'name' => 'Receptionist User',
            'email' => 'receptionist@example.com',
            'password' => bcrypt('password'),
            'role_id' => $receptionistRole->id,
        ]);

        // Create a pharmacist user
        User::factory()->create([
            'name' => 'Pharmacist User',
            'email' => 'pharmacist@example.com',
            'password' => bcrypt('password'),
            'role_id' => $pharmacistRole->id,
        ]);
    }
}
