<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PageSetup extends Model
{
    protected $fillable = [
        'page',
        'title',
        'meta_description',
        'meta_keywords',
    ];

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('page_setups');
        });

        static::deleted(function () {
            Cache::forget('page_setups');
        });
    }
}
