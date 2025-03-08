<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Library extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'author',
        'description',
        'image',
        'publisher',
        'publication_year',
        'isbn',
        'category',
        'page_count',
        'language',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publication_year' => 'date',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the comments for the library.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(LibraryComment::class);
    }

    /**
     * Get the review for the library.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(LibraryReview::class);
    }

}
