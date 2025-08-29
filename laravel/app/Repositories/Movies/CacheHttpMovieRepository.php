<?php

namespace App\Repositories\Movies;

use App\Services\Movies\DTO\MovieDetails;
use Illuminate\Support\Facades\Cache;

class CacheHttpMovieRepository extends HttpMovieRepository
{
    public function findById(string $movieId): ?MovieDetails
    {
        return Cache::remember(
            sprintf('movie.%s', $movieId),
            3600,
            function () use ($movieId) {
                return parent::findById($movieId);
            }
        );
    }
}
