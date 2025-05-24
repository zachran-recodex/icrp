<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ArticleCategory::all();

        if ($categories->isEmpty()) {
            $this->command->warn('No article categories found. Running ArticleCategorySeeder first...');
            $this->call(ArticleCategorySeeder::class);
            $categories = ArticleCategory::all();
        }

        $articles = [
            // Technology Articles
            [
                'category' => 'Technology',
                'title' => 'The Future of Artificial Intelligence in 2025',
                'content' => $this->getTechnologyContent(),
                'is_published' => true,
                'is_featured' => true,
                'published_at' => Carbon::now()->subDays(2),
                'views_count' => 1250,
            ],
            [
                'category' => 'Technology',
                'title' => 'Best Practices for Laravel Development in 2025',
                'content' => $this->getLaravelContent(),
                'is_published' => true,
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(5),
                'views_count' => 890,
            ],

            // Business Articles
            [
                'category' => 'Business',
                'title' => 'Digital Transformation Strategies for SMEs',
                'content' => $this->getBusinessContent(),
                'is_published' => true,
                'is_featured' => true,
                'published_at' => Carbon::now()->subDays(1),
                'views_count' => 2100,
            ],
            [
                'category' => 'Business',
                'title' => 'Remote Work Management Best Practices',
                'content' => $this->getRemoteWorkContent(),
                'is_published' => true,
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(7),
                'views_count' => 675,
            ],

            // Health & Wellness Articles
            [
                'category' => 'Health & Wellness',
                'title' => 'Mindfulness Meditation for Busy Professionals',
                'content' => $this->getHealthContent(),
                'is_published' => true,
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(3),
                'views_count' => 1450,
            ],

            // Education Articles
            [
                'category' => 'Education',
                'title' => 'The Evolution of Online Learning Platforms',
                'content' => $this->getEducationContent(),
                'is_published' => true,
                'is_featured' => true,
                'published_at' => Carbon::now()->subDays(4),
                'views_count' => 920,
            ],

            // Travel Articles
            [
                'category' => 'Travel',
                'title' => 'Hidden Gems of Southeast Asia',
                'content' => $this->getTravelContent(),
                'is_published' => true,
                'is_featured' => false,
                'published_at' => Carbon::now()->subDays(6),
                'views_count' => 1800,
            ],

            // Draft Articles (Unpublished)
            [
                'category' => 'Technology',
                'title' => 'Cybersecurity Trends for 2025',
                'content' => $this->getCybersecurityContent(),
                'is_published' => false,
                'is_featured' => false,
                'published_at' => null,
                'views_count' => 0,
            ],
            [
                'category' => 'Business',
                'title' => 'Sustainable Business Practices',
                'content' => $this->getSustainabilityContent(),
                'is_published' => false,
                'is_featured' => false,
                'published_at' => null,
                'views_count' => 0,
            ],
        ];

        foreach ($articles as $articleData) {
            $category = $categories->where('title', $articleData['category'])->first();

            if ($category) {
                unset($articleData['category']);
                $articleData['article_category_id'] = $category->id;

                Article::create($articleData);
            }
        }

        $this->command->info('Articles seeded successfully!');
    }

    /**
     * Generate Technology content
     */
    private function getTechnologyContent(): string
    {
        return '<h2>Introduction to AI Developments</h2>
        <p>Artificial Intelligence continues to evolve at an unprecedented pace, with 2025 marking significant milestones in machine learning, natural language processing, and computer vision.</p>

        <h3>Key Areas of Growth</h3>
        <ul>
        <li><strong>Large Language Models:</strong> Advanced conversational AI systems</li>
        <li><strong>Computer Vision:</strong> Enhanced image and video recognition</li>
        <li><strong>Robotics Integration:</strong> AI-powered automation in manufacturing</li>
        <li><strong>Healthcare Applications:</strong> Diagnostic and treatment assistance</li>
        </ul>

        <h3>Industry Impact</h3>
        <p>The integration of AI technologies across industries has created new opportunities for innovation while raising important questions about ethics, employment, and data privacy. Companies are investing heavily in AI infrastructure to remain competitive in the digital economy.</p>

        <h3>Future Outlook</h3>
        <p>As we move forward, the focus shifts toward responsible AI development, ensuring that these powerful technologies benefit society while minimizing potential risks. The next decade will likely see even more sophisticated AI applications that seamlessly integrate into our daily lives.</p>';
    }

    /**
     * Generate Laravel content
     */
    private function getLaravelContent(): string
    {
        return '<h2>Modern Laravel Development Patterns</h2>
        <p>Laravel continues to evolve with each release, introducing new features and improving developer experience. Here are the essential practices for 2025.</p>

        <h3>Architecture Best Practices</h3>
        <p>Following SOLID principles and implementing proper separation of concerns:</p>
        <ul>
        <li>Service classes for business logic</li>
        <li>Repository pattern for data access</li>
        <li>Form Request classes for validation</li>
        <li>Resource classes for API responses</li>
        </ul>

        <h3>Performance Optimization</h3>
        <p>Key strategies for improving application performance:</p>
        <ul>
        <li>Eager loading relationships to avoid N+1 queries</li>
        <li>Database indexing and query optimization</li>
        <li>Caching frequently accessed data</li>
        <li>Queue jobs for time-consuming tasks</li>
        </ul>

        <h3>Testing and Quality Assurance</h3>
        <p>Implementing comprehensive testing strategies using PHPUnit and Pest for reliable, maintainable applications.</p>';
    }

    /**
     * Generate Business content
     */
    private function getBusinessContent(): string
    {
        return '<h2>Digital Transformation for SMEs</h2>
        <p>Small and medium enterprises face unique challenges when implementing digital transformation initiatives. Success requires strategic planning and gradual implementation.</p>

        <h3>Assessment and Planning</h3>
        <p>Begin with a thorough assessment of current processes and identify areas where digital solutions can provide the most value.</p>

        <h3>Technology Implementation</h3>
        <ul>
        <li>Cloud-based solutions for scalability</li>
        <li>Customer relationship management systems</li>
        <li>Automated workflow processes</li>
        <li>Data analytics and reporting tools</li>
        </ul>

        <h3>Change Management</h3>
        <p>Successful transformation requires buy-in from all stakeholders and comprehensive training programs for employees.</p>';
    }

    /**
     * Generate Remote Work content
     */
    private function getRemoteWorkContent(): string
    {
        return '<h2>Managing Distributed Teams Effectively</h2>
        <p>Remote work has become a permanent fixture in modern business operations. Effective management requires new approaches and tools.</p>

        <h3>Communication Strategies</h3>
        <p>Establishing clear communication channels and regular check-ins to maintain team cohesion and productivity.</p>

        <h3>Technology Tools</h3>
        <p>Leveraging collaboration platforms, project management software, and video conferencing solutions to facilitate seamless remote work.</p>

        <h3>Performance Management</h3>
        <p>Focusing on results and outcomes rather than hours worked, with clear objectives and measurable goals.</p>';
    }

    /**
     * Generate Health content
     */
    private function getHealthContent(): string
    {
        return '<h2>Mindfulness for the Modern Professional</h2>
        <p>Incorporating mindfulness practices into busy professional lives can significantly improve mental health and productivity.</p>

        <h3>Quick Meditation Techniques</h3>
        <ul>
        <li>5-minute breathing exercises</li>
        <li>Mindful walking during breaks</li>
        <li>Progressive muscle relaxation</li>
        <li>Focused attention meditation</li>
        </ul>

        <h3>Workplace Integration</h3>
        <p>Simple strategies to incorporate mindfulness throughout the workday without disrupting productivity.</p>';
    }

    /**
     * Generate Education content
     */
    private function getEducationContent(): string
    {
        return '<h2>The Digital Education Revolution</h2>
        <p>Online learning platforms have fundamentally changed how we approach education, offering flexibility and accessibility previously unavailable.</p>

        <h3>Platform Evolution</h3>
        <p>From simple video courses to interactive, AI-powered learning experiences that adapt to individual learning styles.</p>

        <h3>Future Trends</h3>
        <p>Virtual reality classrooms, personalized learning paths, and micro-credentialing are shaping the future of education.</p>';
    }

    /**
     * Generate Travel content
     */
    private function getTravelContent(): string
    {
        return '<h2>Exploring Southeast Asia\'s Hidden Treasures</h2>
        <p>Beyond the popular tourist destinations lie incredible hidden gems waiting to be discovered by adventurous travelers.</p>

        <h3>Lesser-Known Destinations</h3>
        <ul>
        <li>Remote villages with authentic cultural experiences</li>
        <li>Pristine beaches away from crowds</li>
        <li>Ancient temples and historical sites</li>
        <li>Local markets and traditional crafts</li>
        </ul>

        <h3>Travel Tips</h3>
        <p>Practical advice for responsible tourism and meaningful cultural exchanges.</p>';
    }

    /**
     * Generate Cybersecurity content
     */
    private function getCybersecurityContent(): string
    {
        return '<h2>Emerging Cybersecurity Challenges</h2>
        <p>As technology advances, so do the threats that organizations face. Understanding these trends is crucial for maintaining security.</p>

        <h3>Current Threat Landscape</h3>
        <p>Analysis of recent cyber attacks and emerging threat vectors that organizations should prepare for.</p>';
    }

    /**
     * Generate Sustainability content
     */
    private function getSustainabilityContent(): string
    {
        return '<h2>Building Sustainable Business Operations</h2>
        <p>Companies are increasingly recognizing the importance of sustainable practices for long-term success and environmental responsibility.</p>

        <h3>Implementation Strategies</h3>
        <p>Practical approaches to integrating sustainability into core business operations.</p>';
    }
}
