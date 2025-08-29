<?php

namespace App\Services\Movies;

class GetMovieFavorites
{
    public function __construct(private MovieFavoriteRepository $movieFavoriteRepository) {}

    public function execute(string $userId, int $page = 1)
    {
        return $this->movieFavoriteRepository->listFavorites(
            $userId,
            $page
        );
    }
}
