<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'article_category_id',
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

    public function articleCategory()
    {
        return $this->belongsTo(ArticleCategory::class);
    }
}
