<?php

namespace App\Services\Movies;

use App\Models\Movie;
use App\Services\Movies\DTO\MovieDetails;

interface MovieManagerRepository
{
    public function createOrUpdate(string $movieId, MovieDetails $details): Movie;
}
