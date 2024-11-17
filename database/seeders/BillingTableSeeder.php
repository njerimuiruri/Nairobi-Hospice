<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;  // Add this line to import the DB facade
use Illuminate\Database\Seeder;
class BillingTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('billing')->insert([
            'patient_id' => 1,
            'treatment_id' => 1,
            'amount' => 200.00,
            'billing_date' => '2023-12-04',
            'status' => 'Pending',
        ]);
    }
}