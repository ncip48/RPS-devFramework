<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //batch insert
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role' => 0,
            ],
            [
                'name' => 'Barka Satya',
                'email' => 'dosen@gmail.com',
                'password' => bcrypt('password'),
                'role' => 1,
            ],
        ]);
    }
}
