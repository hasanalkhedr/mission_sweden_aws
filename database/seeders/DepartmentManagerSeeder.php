<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dep = Department::find(1);
        $dep->manager_id = 1;
        $dep->save();

        $dep = Department::find(3);
        $dep->manager_id = 5;
        $dep->save();

        $dep = Department::find(4);
        $dep->manager_id = 10;
        $dep->save();

        $dep = Department::find(5);
        $dep->manager_id = 15;
        $dep->save();

        $dep = Department::find(6);
        $dep->manager_id = 19;
        $dep->save();

        $dep = Department::find(8);
        $dep->manager_id = 26;
        $dep->save();

        $dep = Department::find(9);
        $dep->manager_id = 28;
        $dep->save();

        $dep = Department::find(2);
        $dep->manager_id = 33;
        $dep->save();

        $dep = Department::find(7);
        $dep->manager_id = 33;
        $dep->save();

        $dep = Department::find(10);
        $dep->manager_id = 33;
        $dep->save();

        $dep = Department::find(11);
        $dep->manager_id = 35;
        $dep->save();

        $dep = Department::find(12);
        $dep->manager_id = 39;
        $dep->save();

        $dep = Department::find(13);
        $dep->manager_id = 42;
        $dep->save();

        $dep = Department::find(14);
        $dep->manager_id = 52;
        $dep->save();

        $dep = Department::find(15);
        $dep->manager_id = 57;
        $dep->save();

    }
}
