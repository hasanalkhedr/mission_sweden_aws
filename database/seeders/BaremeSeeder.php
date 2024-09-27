<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaremeSeeder extends Seeder
{
    public function run()
    {
        DB::table('baremes')->insert([
            [
                'pays' => 'USA',
                'currency' => 'USD',
                'pays_per_day' => 100.00,
                'meal_cost' => 30.00,
                'accomodation_cost' => 70.00,
            ],
            [
                'pays' => 'France',
                'currency' => 'EUR',
                'pays_per_day' => 90.00,
                'meal_cost' => 25.00,
                'accomodation_cost' => 65.00,
            ],
            [
                'pays' => 'UK',
                'currency' => 'GBP',
                'pays_per_day' => 85.00,
                'meal_cost' => 28.00,
                'accomodation_cost' => 57.00,
            ],
        ]);
    }
}
