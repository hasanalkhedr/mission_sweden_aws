<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseSeeder extends Seeder
{
    public function run()
    {
        DB::table('expenses')->insert([
            [
                'mission_order_id' => 1, // MO-001
                'amount' => 50.00,
                'currency' => 'USD',
                'description' => 'Taxi fare',
                'document' => 'taxi_receipt.pdf',
            ],
            [
                'mission_order_id' => 2, // MO-002
                'amount' => 100.00,
                'currency' => 'GBP',
                'description' => 'Hotel booking',
                'document' => 'hotel_receipt.pdf',
            ],
        ]);
    }
}
