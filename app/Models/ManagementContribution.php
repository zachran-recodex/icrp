<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ManagementContribution extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'management_id',
        'title',
        'description',
        'order',
    ];

    /**
     * Get the management that owns the contribution.
     */
    public function management(): BelongsTo
    {
        return $this->belongsTo(Management::class);
    }
}
