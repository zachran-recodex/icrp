<?php

namespace Database\Seeders;

use App\Models\Library;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $libraries = [
            [
                'title' => 'The Anatomy of Peace',
                'slug' => Str::slug('The Anatomy of Peace'),
                'author' => 'The Arbinger Institute',
                'description' => 'A book that explores the root causes of conflict and how to resolve them through changing hearts.',
                'image' => 'anatomy_of_peace.jpg',
                'reviewer' => 'Dr. Ahmad Fauzi',
                'review' => 'A transformative read on understanding and resolving conflicts.',
            ],
            [
                'title' => 'Religions for Peace',
                'slug' => Str::slug('Religions for Peace'),
                'author' => 'William F. Vendley',
                'description' => 'A comprehensive guide on how religious communities can work together to promote global peace.',
                'image' => 'religions_for_peace.jpg',
                'reviewer' => 'Prof. Siti Aminah',
                'review' => 'An inspiring book that highlights the power of interfaith collaboration.',
            ],
            [
                'title' => 'The Faith Club',
                'slug' => Str::slug('The Faith Club'),
                'author' => 'Ranya Idliby, Suzanne Oliver, and Priscilla Warner',
                'description' => 'A story of three women from different faiths who come together to understand and respect each other\'s beliefs.',
                'image' => 'faith_club.jpg',
                'reviewer' => 'Maria Santoso',
                'review' => 'A heartfelt narrative on building bridges between religions.',
            ],
            [
                'title' => 'Peacebuilding in Divided Societies',
                'slug' => Str::slug('Peacebuilding in Divided Societies'),
                'author' => 'John Paul Lederach',
                'description' => 'A practical guide to peacebuilding and conflict resolution in societies with deep divisions.',
                'image' => 'peacebuilding_divided_societies.jpg',
                'reviewer' => 'Dr. Budi Raharjo',
                'review' => 'An essential resource for anyone working in conflict resolution.',
            ],
            [
                'title' => 'The Book of Joy',
                'slug' => Str::slug('The Book of Joy'),
                'author' => 'Dalai Lama and Desmond Tutu',
                'description' => 'A conversation between two spiritual leaders on finding joy and peace in a troubled world.',
                'image' => 'book_of_joy.jpg',
                'reviewer' => 'Anita Wijaya',
                'review' => 'A deeply uplifting and insightful book on the nature of joy and peace.',
            ],
        ];

        foreach ($libraries as $library) {
            Library::create($library);
        }
    }
}
