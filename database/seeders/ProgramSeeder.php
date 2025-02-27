<?php

namespace Database\Seeders;

use App\Models\Program;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelPrograms;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Interfaith Dialogue Forum',
                'description' => 'A forum to promote understanding and cooperation among different religious communities.',
                'image' => 'interfaith_dialogue.jpg',
            ],
            [
                'title' => 'Peacebuilding Workshop',
                'description' => 'A workshop focusing on strategies for building and sustaining peace in diverse societies.',
                'image' => 'peacebuilding_workshop.jpg',
            ],
            [
                'title' => 'Religion and Social Justice Symposium',
                'description' => 'A symposium exploring the role of religion in promoting social justice and human rights.',
                'image' => 'religion_social_justice.jpg',
            ],
        ];

        // Insert data ke tabel events
        foreach ($events as $event) {
            Program::create($event);
        }
    }
}
