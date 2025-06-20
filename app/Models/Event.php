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

    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', today())
                    ->orderBy('date')
                    ->orderBy('time');
    }

    public static function getUpcoming($limit = 3)
    {
        return static::upcoming()
                     ->take($limit)
                     ->get();
    }
}
