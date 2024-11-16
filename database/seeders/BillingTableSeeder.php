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
            // Billing records for different patients and treatments
            [
                'patient_id' => 1,
                'treatment_id' => 1,
                'amount' => 200.00,
                'billing_date' => '2023-12-04',
                'status' => 'Pending',
            ],
            [
                'patient_id' => 2,
                'treatment_id' => 2,
                'amount' => 350.00,
                'billing_date' => '2023-12-05',
                'status' => 'Paid',
            ],
            [
                'patient_id' => 3,
                'treatment_id' => 1,
                'amount' => 150.00,
                'billing_date' => '2023-12-06',
                'status' => 'Paid',
            ],
            [
                'patient_id' => 4,
                'treatment_id' => 3,
                'amount' => 450.00,
                'billing_date' => '2023-12-07',
                'status' => 'Pending',
            ],
            [
                'patient_id' => 5,
                'treatment_id' => 2,
                'amount' => 300.00,
                'billing_date' => '2023-12-08',
                'status' => 'Overdue',
            ],
            [
                'patient_id' => 6,
                'treatment_id' => 1,
                'amount' => 220.00,
                'billing_date' => '2023-12-09',
                'status' => 'Paid',
            ],
            [
                'patient_id' => 7,
                'treatment_id' => 3,
                'amount' => 500.00,
                'billing_date' => '2023-12-10',
                'status' => 'Pending',
            ],
            [
                'patient_id' => 8,
                'treatment_id' => 2,
                'amount' => 330.00,
                'billing_date' => '2023-12-11',
                'status' => 'Paid',
            ],
            [
                'patient_id' => 9,
                'treatment_id' => 1,
                'amount' => 210.00,
                'billing_date' => '2023-12-12',
                'status' => 'Overdue',
            ],
            [
                'patient_id' => 10,
                'treatment_id' => 3,
                'amount' => 480.00,
                'billing_date' => '2023-12-13',
                'status' => 'Pending',
            ],
        ]);
    }
}
