<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FounderLegacy extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'founder_id',
        'content',
    ];

    /**
     * Get the founder that owns the legacy.
     */
    public function founder(): BelongsTo
    {
        return $this->belongsTo(Founder::class);
    }
}
