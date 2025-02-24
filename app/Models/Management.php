<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    protected $fillable = ['image', 'name', 'position', 'description', 'dewan'];

    protected $casts = [
        'dewan' => 'string',
    ];
}
