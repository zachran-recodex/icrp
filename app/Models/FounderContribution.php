<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FounderContribution extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'founder_id',
        'title',
        'description',
        'order',
    ];

    /**
     * Get the founder that owns the contribution.
     */
    public function founder(): BelongsTo
    {
        return $this->belongsTo(Founder::class);
    }
}
