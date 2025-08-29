<?php

namespace App\Services\Movies;

class DeleteMovieFavorite
{
    public function __construct(private MovieFavoriteRepository $movieFavoriteRepository) {}

    public function execute(string $userId, string $movieId): void
    {
        $this->movieFavoriteRepository->delete($userId, $movieId);
    }
}
