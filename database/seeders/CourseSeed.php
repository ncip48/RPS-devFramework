<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::insert([
            [
                'id_institute' => 1,
                'id_department' => 1,
                'id_teacher' => 1,
                'code' => 'JAR',
                'name' => 'Jaringan Komputer',
                'credit' => 0,
            ],
            [
                'id_institute' => 2,
                'id_department' => 3,
                'id_teacher' => 3,
                'code' => 'SO',
                'name' => 'Sistem Operasi',
                'credit' => 4,
            ],
        ]);
    }
}
