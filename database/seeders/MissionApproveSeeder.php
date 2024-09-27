<?php

namespace Database\Seeders;

use App\Models\MissionApprove;
use Illuminate\Database\Seeder;

class MissionApproveSeeder extends Seeder
{
    public function run()
    {
        MissionApprove::create([
            'mission_order_id' => 1, // MO-001
            'approval_id' => 2, // Supervisor One
            'approval_role' => 'supervisor',
            'comment' => 'Looks good',
            'status' => 'sup_approve',
        ]);

        MissionApprove::create([
            'mission_order_id' => 2, // MO-002
            'approval_id' => 4, // SGA Role Employee
            'approval_role' => 'sga',
            'comment' => 'Approved for conference',
            'status' => 'sg_approve',
        ]);
    }
}
