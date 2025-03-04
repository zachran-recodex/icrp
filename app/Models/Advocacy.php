<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advocacy extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image'
    ];
}
