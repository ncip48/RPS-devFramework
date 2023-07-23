<?php

namespace Database\Seeders;

use App\Models\LearningPlanDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearningPlanDetailSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LearningPlanDetail::insert([
            [
                'id_learning_plan' => 1,
                'id_template_fill' => 1,
                'value' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            ],
            [
                'id_learning_plan' => 1,
                'id_template_fill' => 2,
                'value' => 'Ipsum Aute voluptate voluptatem, quibusdam, quia, quos quod voluptatibus quas voluptatum quidem.',
            ],
            [
                'id_learning_plan' => 1,
                'id_template_fill' => 3,
                'value' => json_encode([
                    ["1", "Pengenalan Jaringan Komputer", "Pengenalan 1", "2 x 50 menit"],
                    ["1", "Pengenalan Jaringan Komputer", "Pengenalan 2", "2 x 50 menit"],
                    ["2", "Pengenalan Jaringan Komputer 3", "Pengenalan 3", "2 x 50 menit"],
                    ["3", "Pengenalan Jaringan Komputer 4", "Pengenalan 4", "2 x 50 menit"],
                    ["4", "Pengenalan Jaringan Komputer 5", "Pengenalan 5", "2 x 50 menit"],
                ]),
            ]
        ]);
    }
}
