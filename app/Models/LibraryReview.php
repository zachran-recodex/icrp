<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryReview extends Model
{
    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'library_id',
        'reviewer',
        'review',
    ];

    // Relasi ke tabel libraries
    public function library()
    {
        return $this->belongsTo(Library::class);
    }
}
