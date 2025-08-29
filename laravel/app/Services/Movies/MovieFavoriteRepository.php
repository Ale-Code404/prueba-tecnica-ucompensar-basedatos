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
    public function create(string $userId, string $movieId): void;

    /**
     * Remove a movie from the user's favorites.
     */
    public function delete(string $userId, string $movieId): void;

    /**
     * Check if a movie is favorite by a user.
     */
    public function exists(string $userId, string $movieId): bool;
}
