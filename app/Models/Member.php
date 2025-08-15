<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Member extends Model
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
        'position',
        'dewan_category',
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

    protected function age(): Attribute
    {
        return Attribute::make(
            get: function () {
                $endDate = $this->death_date ?? now();

                return $this->birth_date->diffInYears($endDate);
            }
        );
    }

    protected function isAlive(): Attribute
    {
        return Attribute::make(
            get: fn () => is_null($this->death_date)
        );
    }

    public function getDewanCategoryOptions()
    {
        return [
            'direktur eksekutif' => 'Direktur Eksekutif',
            'pengurus' => 'Pengurus',
            'kehormatan' => 'Kehormatan',
            'pembina' => 'Pembina',
            'pengawas' => 'Pengawas',
            'pengurus harian' => 'Pengurus Harian',
        ];
    }
}
