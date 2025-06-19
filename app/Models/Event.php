<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'date',
        'time',
        'location',
        'description',
        'image',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];
}
