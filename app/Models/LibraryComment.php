<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryComment extends Model
{
    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'library_id',
        'user_id',
        'content',
    ];

    // Relasi ke tabel libraries
    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    // Relasi ke tabel users (jika ada)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
