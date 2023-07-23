<?php

namespace Database\Seeders;

use App\Models\Personal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Personal::insert([
            [
                'id_institute' => 1,
                'email' => 'yudi@gmail.com',
                'password' => bcrypt('password'),
                'id_teacher' => 1,
                'photo' => 'yudi.png',
            ],
            [
                'id_institute' => 1,
                'email' => 'dani@gmail.com',
                'password' => bcrypt('password'),
                'id_teacher' => 2,
                'photo' => 'dani.png',
            ],
            [
                'id_institute' => 2,
                'email' => 'barka@gmail.com',
                'password' => bcrypt('password'),
                'id_teacher' => 3,
                'photo' => 'barka.png',
            ],
        ]);
    }
}
