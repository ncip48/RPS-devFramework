<?php

namespace Database\Seeders;

use App\Models\Institute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Institute::insert([
            [
                'type' => 'SMK',
                'name' => 'SMKN 1 Ngawi',
                'email' => 'sch@gmail.com',
                'password' => bcrypt('password'),
                'address' => 'Jl. Raya Ngawi - Sine, Kec. Ngawi, Kabupaten Ngawi, Jawa Timur 63219',
                'phone' => '0351-908-000',
                'province' => 'Jawa Timur',
                'city' => 'Ngawi',
                'district' => 'Kec. Ngawi',
                'logo' => 'skansa.png',
                'status' => 1,
                'id_product' => 1
            ],
            [
                'type' => 'PT',
                'name' => 'Universitas Amikom Yogyakarta',
                'email' => 'amikom@gmail.com',
                'password' => bcrypt('password'),
                'address' => 'Jl. Ring Road Utara, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55283',
                'phone' => '0274-884-201',
                'province' => 'Daerah Istimewa Yogyakarta',
                'city' => 'Sleman',
                'district' => 'Kec. Depok',
                'logo' => 'amikom.png',
                'status' => 1,
                'id_product' => 2
            ]
        ]);
    }
}
