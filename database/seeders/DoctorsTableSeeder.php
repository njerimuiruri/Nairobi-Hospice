<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;  // Add this line to import the DB facade
use Illuminate\Database\Seeder;
class DoctorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('doctors')->insert([
            'first_name' => 'Robert',
            'last_name' => 'Brown',
            'email' => 'robert.brown@example.com',
            'phone_number' => '555-7890',
            'specialization' => 'General Practitioner',
            'availability_status' => 'Available',
        ]);
        DB::table('doctors')->insert([
            'first_name' => 'Robert',
            'last_name' => 'Brown',
            'email' => 'robert.brown@example.com',
            'phone_number' => '555-7890',
            'specialization' => 'General Practitioner',
            'availability_status' => 'Available',
        ]);

        DB::table('doctors')->insert([
            'first_name' => 'Alice',
            'last_name' => 'Johnson',
            'email' => 'alice.johnson@example.com',
            'phone_number' => '555-5678',
            'specialization' => 'Pediatrics',
            'availability_status' => 'Busy',
        ]);

        DB::table('doctors')->insert([
            'first_name' => 'Mark',
            'last_name' => 'Thompson',
            'email' => 'mark.thompson@example.com',
            'phone_number' => '555-8765',
            'specialization' => 'Orthopedics',
            'availability_status' => 'Available',
        ]);
    }
}
