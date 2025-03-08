<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Founder extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nickname',
        'slug',
        'birth_date',
        'death_date',
        'birth_place',
        'known_as',
        'quote',
        'biography',
        'image',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
        'death_date' => 'date',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the contributions for the founder.
     */
    public function contributions(): HasMany
    {
        return $this->hasMany(FounderContribution::class)->orderBy('order');
    }

    /**
     * Get the legacies for the founder.
     */
    public function legacies(): HasMany
    {
        return $this->hasMany(FounderLegacy::class);
    }
}
