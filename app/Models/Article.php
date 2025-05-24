<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'article_category_id',
        'title',
        'slug',
        'content',
        'image',
        'is_published',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_published' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug) && !empty($article->title)) {
                $article->slug = Str::slug($article->title);
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('title') && !$article->isDirty('slug')) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    /**
     * Get the category that owns the article.
     */
    public function articleCategory(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class);
    }

    /**
     * Scope to get only published articles.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope to get only draft articles.
     */
    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('is_published', false);
    }

    /**
     * Scope to search articles by title or content.
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('content', 'like', "%{$search}%");
        });
    }

    /**
     * Scope to get articles by category.
     */
    public function scopeByCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('article_category_id', $categoryId);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the article's excerpt.
     */
    public function getExcerptAttribute(): string
    {
        return Str::limit(strip_tags($this->content), 150);
    }

    /**
     * Get the article's reading time in minutes.
     */
    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->content));
        return max(1, ceil($wordCount / 200)); // Average reading speed: 200 words per minute
    }

    /**
     * Get the full image URL.
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    /**
     * Check if the article is published.
     */
    public function isPublished(): bool
    {
        return $this->is_published;
    }

    /**
     * Check if the article is draft.
     */
    public function isDraft(): bool
    {
        return !$this->is_published;
    }

    /**
     * Publish the article.
     */
    public function publish(): bool
    {
        return $this->update(['is_published' => true]);
    }

    /**
     * Unpublish the article (make it draft).
     */
    public function unpublish(): bool
    {
        return $this->update(['is_published' => false]);
    }
}
