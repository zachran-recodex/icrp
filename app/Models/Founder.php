<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Founder extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

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
