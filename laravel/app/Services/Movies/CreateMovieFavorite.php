<?php

namespace App\Services\Movies;

use App\Services\Movies\Errors\{
    MovieAlreadyFavorite,
    MovieNotExists
};

class CreateMovieFavorite
{
    public function __construct(
        private MovieRepository $movieRepository,
        private MovieManagerRepository $movieManagerRepository,
        private MovieFavoriteRepository $movieFavoriteRepository
    ) {}

    public function execute(string $userId, string $movieId): void
    {
        $details = $this->movieRepository->findById($movieId);

        if (!$details) {
            throw new MovieNotExists($movieId);
        }

        $this->movieManagerRepository->createOrUpdate(
            $movieId,
            $details
        );

        if ($this->movieFavoriteRepository->exists($userId, $movieId)) {
            throw new MovieAlreadyFavorite();
        }

        $this->movieFavoriteRepository->create(
            $userId,
            $movieId
        );
    }
}
