<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        DB::table('departments')->insert([
            ['name' => 'Agence Compatable'],
            ['name' => 'Audio'],
            ['name' => 'Bekaa'],
            ['name' => 'Bureau du Livre'],
            ['name' => 'Campus France'],
            ['name' => 'Centre de Langes'],
            ['name' => 'Communication'],
            ['name' => 'Culturel'],
            ['name' => 'Deir El Qamar'],
            ['name' => 'Direction'],
            ['name' => 'Jounieh'],
            ['name' => 'Linguistique'],
            ['name' => 'Secrétariat Général'],
            ['name' => 'Sud'],
            ['name' => 'Tripoli'],

            ['name' => 'IT Department'],
            ['name' => 'Finance Department'],
            ['name' => 'HR Department'],

        ]);
    }
}
