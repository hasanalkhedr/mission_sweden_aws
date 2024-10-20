<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MissionOrder;

class MissionOrderSeeder extends Seeder
{
    public function run()
    {
        MissionOrder::create([
            'order_date' => now(),
            'order_number' => 'MO-001',
            'employee_id' => 3, // Assuming Employee One
            'purpose' => 'Client Visit',
            'description' => 'Visit to client for project discussion',

            'arrive_location'  => 'USA',
            'departure_location' => 'USA',
            'bareme_id' => 1, // USA Bareme
            'no_meals' => 3,
            'no_accomodation' => 2,
            'no_ded_meals' => 1,
            'no_ded_accomodation' => 0,
            'start_date' => now()->addDays(2),
            'end_date' => now()->addDays(5),
            'start_time' => '11:00',
            'end_time' => '11:00',
            'charge' => '1',
            'ijm' => '1',
            'assurance' => '1',
            'total_amount' => 300.00,
            'currency' => 'USD',
            'status' => 'draft',
        ]);

        MissionOrder::create([
            'order_date' => now(),
            'order_number' => 'MO-002',
            'employee_id' => 2, // Assuming Supervisor One
            'purpose' => 'Conference',
            'description' => 'Attend IT conference',

            'arrive_location'  => 'USA',
            'departure_location' => 'USA',
            'bareme_id' => 3, // UK Bareme
            'no_meals' => 4,
            'no_accomodation' => 3,
            'no_ded_meals' => 2,
            'no_ded_accomodation' => 1,
            'start_date' => now()->addDays(10),
            'end_date' => now()->addDays(12),
            'start_time' => '11:00',
            'end_time' => '11:00',
            'charge' => '1',
            'ijm' => '1',
            'assurance' => '0',
            'total_amount' => 400.00,
            'currency' => 'GBP',
            'status' => 'draft',
        ]);
    }
}
