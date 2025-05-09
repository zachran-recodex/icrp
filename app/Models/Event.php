<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'image', 'date', 'time', 'location'];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i'
    ];
}
