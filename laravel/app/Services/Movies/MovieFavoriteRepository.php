<?php

namespace App\Services\Movies;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface MovieFavoriteRepository
{
    /**
     * List favorite movies for a user.
     */
    public function listFavorites(string $userId, int $page = 1): LengthAwarePaginator;

    /**
     * Add a movie to the user's favorites.
     */
    public function addFavorite(string $userId, string $movieId): void;

    /**
     * Remove a movie from the user's favorites.
     */
    public function removeFavorite(string $userId, string $movieId): void;
}
