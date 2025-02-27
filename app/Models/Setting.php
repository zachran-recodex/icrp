<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'address',
        'phone',
        'email',
        'youtube_link',
        'instagram_link',
        'facebook_link',
        'google_map_link',
        'twitter_link',
        'linkedin_link',
        'footer_text',
        'logo',
        'favicon'
    ];
}
