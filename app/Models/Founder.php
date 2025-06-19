<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Founder extends Model
{
    protected $fillable = [
        'name',
        'nickname',
        'birth_date',
        'death_date',
        'birth_place',
        'known_as',
        'quote',
        'biography',
        'photo',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'death_date' => 'date',
    ];

    public function getAgeAttribute()
    {
        $deathDate = $this->death_date ?? now();
        return $this->birth_date->diffInYears($deathDate);
    }

    public function isAliveAttribute()
    {
        return is_null($this->death_date);
    }
}
