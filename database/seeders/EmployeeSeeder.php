<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        // Create HR user
        $userHr = User::create([
            'name' => 'HR Manager',
            'email' => 'hr@company.com',
            'password' => Hash::make('password'), // Default password for testing
        ]);

        Employee::create([
            'full_name' => 'HR Manager',
            'email' => 'hr@company.com',
            'phone' => '123456789',
            'department_id' => 3, // HR Department
            'user_id' => $userHr->id,
            'role' => 'hr',
            'position' => 'HR Manager',
            'administrativ_residence' => 'Beyrouth',
            'service' => 'any service',
        ]);

        // Create Supervisor user
        $userSupervisor = User::create([
            'name' => 'Supervisor One',
            'email' => 'supervisor@company.com',
            'password' => Hash::make('password'),
        ]);

        Employee::create([
            'full_name' => 'Supervisor Manager',
            'email' => 'supervisor@company.com',
            'phone' => '987654321',
            'department_id' => 1, // IT Department
            'user_id' => $userSupervisor->id,
            'role' => 'supervisor',
            'position' => 'IT Supervisor',
            'administrativ_residence' => 'Beyrouth',
            'service' => 'any service',
        ]);

        // Create Employee user
        $userEmployee = User::create([
            'name' => 'Employee One',
            'email' => 'employee@company.com',
            'password' => Hash::make('password'),
        ]);

        Employee::create([
            'full_name' => 'Employee One',
            'email' => 'employee@company.com',
            'phone' => '555123456',
            'department_id' => 1, // IT Department
            'user_id' => $userEmployee->id,
            'role' => 'employee',
            'position' => 'Tschnical Support',
            'administrativ_residence' => 'Beyrouth',
            'service' => 'any service',
        ]);

        // Create SG user
        $userSga = User::create([
            'name' => 'SG Manager',
            'email' => 'sg@company.com',
            'password' => Hash::make('password'),
        ]);

        Employee::create([
            'full_name' => 'SG Manager',
            'email' => 'sg@company.com',
            'phone' => '444123456',
            'department_id' => 2, // Finance Department
            'user_id' => $userSga->id,
            'role' => 'sg',
            'position' => 'SG',
            'administrativ_residence' => 'Beyrouth',
            'service' => 'any service',
        ]);
    }
}
