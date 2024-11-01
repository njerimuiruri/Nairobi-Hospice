<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;  // Add this line to import the DB facade
use Illuminate\Database\Seeder;
class ReceptionistsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('receptionists')->insert([
            'first_name' => 'Alice',
            'last_name' => 'Johnson',
            'email' => 'alice.johnson@example.com',
            'phone_number' => '555-6789',
        ]);
    }
}
