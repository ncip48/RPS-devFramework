<?php

namespace Database\Seeders;

use App\Models\TemplateFill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateFillSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TemplateFill::insert([
            [
                'id_template' => 1,
                'position' => 1,
                'title' => 'Gambaran Umum',
                'type' => 'text',
                'column' => null,
            ],
            [
                'id_template' => 1,
                'position' => 2,
                'title' => 'Aturan Berlaku',
                'type' => 'text',
                'column' => null,
            ],
            [
                'id_template' => 1,
                'position' => 3,
                'title' => 'RPP',
                'type' => 'fill_table',
                'column' => json_encode(["No", "Kegiatan", "Sub Kegiatan", "Waktu"]),
            ],
        ]);
    }
}
