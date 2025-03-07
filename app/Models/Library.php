<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    // Kolom yang dapat diisi (fillable)
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

    // Relasi ke tabel library_comments
    public function comments()
    {
        return $this->hasMany(LibraryComment::class);
    }

    // Relasi ke tabel library_reviews
    public function reviews()
    {
        return $this->hasMany(LibraryReview::class);
    }

}
