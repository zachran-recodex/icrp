<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Member extends Model
{
    protected $fillable = [
        'name',
        'nickname', 
        'birth_date',
        'death_date',
        'birth_place',
        'known_as',
        'position',
        'dewan_category',
        'quote',
        'biography',
        'photo'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'death_date' => 'date',
    ];

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
            'pengurus harian' => 'Pengurus Harian'
        ];
    }
}
