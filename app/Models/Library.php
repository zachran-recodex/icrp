<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'author',
        'description',
        'image',
        'reviewer',
        'review',
    ];

    public function comments()

    {
        return $this->hasMany(LibraryComment::class);
    }
}
