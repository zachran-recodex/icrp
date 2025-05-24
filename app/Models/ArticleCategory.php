<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all articles for this category.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Get published articles for this category as an attribute.
     */
    public function getPublishedArticlesAttribute()
    {
        return $this->articles()->published();
    }

    /**
     * Scope to get categories that have published articles.
     */
    public function scopeWithPublishedArticles($query)
    {
        return $query->whereHas('articles', function ($q) {
            $q->published();
        });
    }

    /**
     * Get the count of published articles in this category.
     */
    public function getPublishedArticlesCountAttribute(): int
    {
        return $this->articles()->published()->count();
    }
}
