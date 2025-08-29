<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'description',
        'poster',
        'year',
    ];

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'movies_favorites_tables');
    }
}
