<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Freemium',
                'slug' => 'freemium',
                'description' => '3 RPS, dll',
                'price' => 0,
            ],
            [
                'name' => 'Paket A',
                'slug' => 'paket-a',
                'description' => '10 RPS, dll',
                'price' => 600000,
            ],
            [
                'name' => 'Paket B',
                'slug' => 'paket-b',
                'description' => '20 RPS, dll',
                'price' => 1000000,
            ]
        ]);
    }
}
