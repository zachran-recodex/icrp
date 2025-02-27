<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryComment extends Model
{
    protected $fillable = [
        'library_id',
        'user_id',
        'content',
    ];

    public function book()
    {
        return $this->belongsTo(Library::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
