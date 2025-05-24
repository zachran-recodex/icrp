<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'article_category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image_path',
        'meta_title',
        'meta_description',
        'is_published',
        'is_featured',
        'published_at',
        'views_count',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'views_count' => 'integer',
    ];

    protected $appends = [
        'reading_time',
        'featured_image_url',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * Configure media collections.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    /**
     * Configure media conversions.
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(200)
            ->sharpen(10)
            ->performOnCollections('featured', 'gallery');

        $this->addMediaConversion('large')
            ->width(1200)
            ->height(800)
            ->sharpen(10)
            ->performOnCollections('featured');
    }

    /**
     * Get the category that owns the article.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    /**
     * Scope to get only published articles.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope to get only featured articles.
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope to get articles by category.
     */
    public function scopeByCategory(Builder $query, $categoryId): Builder
    {
        return $query->where('article_category_id', $categoryId);
    }

    /**
     * Scope to get popular articles based on views.
     */
    public function scopePopular(Builder $query, int $limit = 10): Builder
    {
        return $query->orderBy('views_count', 'desc')->limit($limit);
    }

    /**
     * Scope to get recent articles.
     */
    public function scopeRecent(Builder $query, int $limit = 10): Builder
    {
        return $query->latest('published_at')->limit($limit);
    }

    /**
     * Scope for search functionality.
     */
    public function scopeSearch(Builder $query, string $term): Builder
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('excerpt', 'like', "%{$term}%")
              ->orWhere('content', 'like', "%{$term}%");
        });
    }

    /**
     * Get estimated reading time in minutes.
     */
    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->content ?? ''));
        return max(1, ceil($wordCount / 200)); // Assuming 200 words per minute
    }

    /**
     * Get featured image URL.
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('featured') ?: $this->image_path;
    }

    /**
     * Get thumbnail image URL.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->getFirstMediaUrl('featured', 'thumb') ?: $this->image_path;
    }

    /**
     * Get meta title with fallback.
     */
    public function getMetaTitleAttribute(): string
    {
        return $this->attributes['meta_title'] ?: $this->title;
    }

    /**
     * Get meta description with fallback.
     */
    public function getMetaDescriptionAttribute(): string
    {
        return $this->attributes['meta_description'] ?:
               Str::limit(strip_tags($this->excerpt ?: $this->content), 160);
    }

    /**
     * Increment views count.
     */
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    /**
     * Publish the article.
     */
    public function publish(): bool
    {
        return $this->update([
            'is_published' => true,
            'published_at' => now(),
        ]);
    }

    /**
     * Unpublish the article.
     */
    public function unpublish(): bool
    {
        return $this->update([
            'is_published' => false,
            'published_at' => null,
        ]);
    }
}
