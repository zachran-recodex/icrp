<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $events = [
            [
                'title' => 'Interfaith Dialogue Forum',
                'description' => 'A forum to promote understanding and cooperation among different religious communities.',
                'image' => 'interfaith_dialogue.jpg',
                'date' => Carbon::create(2023, 11, 10),
                'time' => Carbon::createFromTime(9, 0, 0),
                'location' => 'Convention Center, Jakarta'
            ],
            [
                'title' => 'Peacebuilding Workshop',
                'description' => 'A workshop focusing on strategies for building and sustaining peace in diverse societies.',
                'image' => 'peacebuilding_workshop.jpg',
                'date' => Carbon::create(2023, 11, 12),
                'time' => Carbon::createFromTime(13, 0, 0),
                'location' => 'Grand Ballroom, Yogyakarta'
            ],
            [
                'title' => 'Religion and Social Justice Symposium',
                'description' => 'A symposium exploring the role of religion in promoting social justice and human rights.',
                'image' => 'religion_social_justice.jpg',
                'date' => Carbon::create(2023, 11, 15),
                'time' => Carbon::createFromTime(10, 0, 0),
                'location' => 'University Auditorium, Bandung'
            ],
            [
                'title' => 'Environmental Stewardship and Faith',
                'description' => 'A conference discussing the intersection of religion and environmental sustainability.',
                'image' => 'environment_faith.jpg',
                'date' => Carbon::create(2023, 11, 18),
                'time' => Carbon::createFromTime(14, 0, 0),
                'location' => 'Eco Center, Bali'
            ],
            [
                'title' => 'Conflict Resolution and Religious Leaders',
                'description' => 'A panel discussion on the role of religious leaders in resolving conflicts and fostering reconciliation.',
                'image' => 'conflict_resolution.jpg',
                'date' => Carbon::create(2023, 11, 20),
                'time' => Carbon::createFromTime(11, 0, 0),
                'location' => 'Peace Hall, Surabaya'
            ]
        ];

        // Insert data ke tabel events
        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
