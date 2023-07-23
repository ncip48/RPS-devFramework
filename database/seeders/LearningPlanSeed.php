<?php

namespace Database\Seeders;

use App\Models\LearningPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LearningPlanSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LearningPlan::insert([
            [
                'id_institute' => 2,
                'id_template' => 1,
                'semester' => 1,
                'periode' => '2020/2021',
            ]
        ]);
    }
}
