<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ambil semua kategori yang ada
        $categories = Category::pluck('id')->toArray();

        // Data artikel statis
        $articles = [
            [
                'title' => 'Strengthening Religious Harmony in Indonesia',
                'content' => 'This article discusses various initiatives to strengthen religious harmony in Indonesia.',
                'image' => 'articles/article1.jpg',
            ],
            [
                'title' => 'ICRP Promotes Religious Tolerance',
                'content' => 'ICRP has been actively promoting interfaith tolerance in communities across the country.',
                'image' => 'articles/article2.jpg',
            ],
            [
                'title' => 'Minister Supports ICRP’s New Initiatives',
                'content' => 'The Minister of Religion has expressed support for ICRP’s efforts in fostering unity.',
                'image' => 'articles/article3.jpg',
            ],
            [
                'title' => 'ICRP Expands Its Programs to More Communities',
                'content' => 'ICRP is launching new programs aimed at fostering unity among diverse communities.',
                'image' => 'articles/article4.jpg',
            ],
            [
                'title' => 'Interfaith Collaboration is Key to National Unity',
                'content' => 'Religious leaders emphasize the importance of interfaith collaboration in maintaining national unity.',
                'image' => 'articles/article5.jpg',
            ],
            [
                'title' => 'ICRP Holds Dialogue for Religious Leaders',
                'content' => 'A special dialogue was held to address concerns about interfaith relationships.',
                'image' => 'articles/article6.jpg',
            ],
            [
                'title' => 'Bringing Peace through Interfaith Activities',
                'content' => 'Various interfaith activities have been carried out to promote peace and tolerance.',
                'image' => 'articles/article7.jpg',
            ],
            [
                'title' => 'ICRP Encourages Youth Engagement in Interfaith Movements',
                'content' => 'Young people are encouraged to take an active role in interfaith dialogues.',
                'image' => 'articles/article8.jpg',
            ],
            [
                'title' => 'Minister of Religion and ICRP Agree on New Policies',
                'content' => 'Government and interfaith organizations are working together on new policies.',
                'image' => 'articles/article9.jpg',
            ],
            [
                'title' => 'ICRP Launches Educational Campaign on Tolerance',
                'content' => 'A new educational campaign aims to instill tolerance values from an early age.',
                'image' => 'articles/article10.jpg',
            ],
            [
                'title' => 'Faith-Based Organizations Unite for Social Welfare',
                'content' => 'Faith-based organizations are joining forces to tackle social issues.',
                'image' => 'articles/article11.jpg',
            ],
            [
                'title' => 'ICRP Strengthens Collaboration with Government and NGOs',
                'content' => 'A new collaboration agreement aims to further promote religious harmony.',
                'image' => 'articles/article12.jpg',
            ],
        ];

        // Masukkan data ke dalam database
        foreach ($articles as $data) {
            Article::create([
                'category_id' => $categories[array_rand($categories)], // Pilih kategori secara acak
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'content' => $data['content'],
                'image' => $data['image'], // Path gambar di dalam storage
            ]);
        }
    }
}
