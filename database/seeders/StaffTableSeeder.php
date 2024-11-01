<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;  // Add this line to import the DB facade
use Illuminate\Database\Seeder;
class StaffTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('staff')->insert([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane.smith@example.com',
            'phone_number' => '555-1234',
        ]);
    }
}

