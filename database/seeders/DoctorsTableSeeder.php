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
    }
}
