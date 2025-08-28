<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'imdb_id',
        'title',
        'description',
        'poster',
        'released_at',
    ];

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'movies_favorites_tables');
    }
}
