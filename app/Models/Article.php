<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'article_category_id',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function articleCategory()
    {
        return $this->belongsTo(ArticleCategory::class);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('title')
            ->whereNotNull('content')
            ->where(function ($q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public static function getFeaturedWithCategories()
    {
        return static::published()
            ->with('articleCategory')
            ->latest()
            ->take(1)
            ->get();
    }

    public static function getLatestWithCategories($limit = 9)
    {
        return static::published()
            ->with('articleCategory')
            ->latest()
            ->take($limit)
            ->get();
    }

    public function getProcessedContentAttribute()
    {
        return $this->processYouTubeUrls($this->content);
    }

    private function processYouTubeUrls($content)
    {
        // Convert YouTube URLs ke iframe
        $content = preg_replace_callback(
            '/https?:\/\/(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/',
            function ($matches) {
                $videoId = $matches[1];

                return '<div class="youtube-wrapper"><iframe src="https://www.youtube.com/embed/'.$videoId.'" title="YouTube video player" frameborder="0" allowfullscreen></iframe></div>';
            },
            $content
        );

        return $content;
    }
}
