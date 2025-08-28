<?php

namespace App\Services\Movies;

use App\Services\Movies\DTO\MovieDetails;
use App\Services\Movies\Errors\MovieNotExists;

class GetMovieDetails
{
    public function __construct(private MovieRepository $movieRepository) {}

    public function execute(string $movieId): MovieDetails
    {
        $movie = $this->movieRepository->findById($movieId);

        if (!$movie) {
            throw new MovieNotExists($movieId);
        }

        return $movie;
    }
}
