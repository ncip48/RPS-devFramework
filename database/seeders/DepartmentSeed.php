<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::insert([
            [
                'id_institute' => 1,
                'name' => 'Teknik Komputer dan Jaringan',
                'code' => 'TKJ',
            ],
            [
                'id_institute' => 1,
                'name' => 'Teknik Elektro Industri',
                'code' => 'TEI',
            ],
            [
                'id_institute' => 2,
                'name' => 'Teknik Informatika',
                'code' => 'TI',
            ],
            [
                'id_institute' => 2,
                'name' => 'Informatika',
                'code' => 'IF',
            ]
        ]);
    }
}
