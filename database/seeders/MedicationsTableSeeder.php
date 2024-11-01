<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;  // Add this line to import the DB facade
use Illuminate\Database\Seeder;
class MedicationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('medications')->insert([
            'name' => 'Amoxicillin',
            'description' => 'Antibiotic used to treat various infections',
        ]);
    }
}
