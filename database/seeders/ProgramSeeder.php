<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            [
                'title' => 'Interfaith Dialogue Program',
                'description' => 'A comprehensive program promoting dialogue and understanding between different religious communities in Indonesia.',
            ],
            [
                'title' => 'Peace Education Initiative',
                'description' => 'Educational programs designed to foster peace, tolerance, and mutual respect among diverse religious groups.',
            ],
            [
                'title' => 'Community Harmony Project',
                'description' => 'Grassroots initiatives that bring together religious leaders and community members to build lasting peace.',
            ],
            [
                'title' => 'Youth Leadership Development',
                'description' => 'Training and mentorship programs for young people to become ambassadors of peace in their communities.',
            ],
            [
                'title' => 'Religious Literacy Campaign',
                'description' => 'Educational initiatives to increase understanding and awareness of different religious traditions and practices.',
            ],
        ];

        foreach ($programs as $program) {
            Program::create($program);
        }
    }
}