<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Library extends Model
{
    use HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'author',
        'description',
        'image',
    ];

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

    public function scopePublished($query)
    {
        return $query->whereNotNull('title')
            ->whereNotNull('author');
    }

    public static function getFeatured($limit = 3)
    {
        return static::published()
            ->latest()
            ->take($limit)
            ->get();
    }
}
