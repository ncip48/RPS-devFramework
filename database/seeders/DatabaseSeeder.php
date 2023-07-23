<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //run seeder
        $this->call([
            UserSeeder::class,
            ProductSeeder::class,
            InstituteSeeder::class,
            TeacherSeeder::class,
            PersonalSeeder::class,
            DepartmentSeed::class,
            CourseSeed::class,
            TemplateSeed::class,
            TemplateFillSeed::class,
            LearningPlanSeed::class,
            LearningPlanDetailSeed::class,
        ]);
    }
}
