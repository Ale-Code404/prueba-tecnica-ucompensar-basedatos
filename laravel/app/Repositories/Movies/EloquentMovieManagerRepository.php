<?php

namespace App\Repositories\Movies;

use App\Models\Movie;

use App\Services\Movies\{
    DTO\MovieDetails,
    MovieManagerRepository
};

class EloquentMovieManagerRepository implements MovieManagerRepository
{
    public function createOrUpdate(string $movieId, MovieDetails $details): Movie
    {
        return Movie::query()->updateOrCreate(
            ['id' => $movieId],
            [
                'title' => $details->title,
                'description' => $details->description,
                'poster' => $details->posterUrl,
                'year' => $details->year
            ]
        );
    }
}
