<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::insert([
            [
                'id_institute' => 1,
                'name' => 'Yudi Wahyudi S.Kom',
                'nip' => '111111',
                'nik' => Random::generate(6, '0-9'),
                'gender' => 'L',
                'phone' => '081234567890',
            ],
            [
                'id_institute' => 1,
                'name' => 'Dani Setiawan S.Kom',
                'nip' => '121212',
                'nik' => Random::generate(6, '0-9'),
                'gender' => 'L',
                'phone' => '081234567890',
            ],
            [
                'id_institute' => 2,
                'name' => 'Barka Satya S.Kom, M.Kom',
                'nip' => '222222',
                'nik' => Random::generate(6, '0-9'),
                'gender' => 'L',
                'phone' => '081234567890',
            ]
        ]);
    }
}
