<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;  // Add this line to import the DB facade
use Illuminate\Database\Seeder;
class PatientsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('patients')->insert([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'date_of_birth' => '1990-01-01',
            'gender' => 'Male',
            'address' => '123 Main St',
            'phone_number' => '555-5555',
            'email' => 'john.doe@example.com',
        ]);
    }
}

