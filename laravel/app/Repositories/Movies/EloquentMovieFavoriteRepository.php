<?php

namespace App\Repositories\Movies;

use App\Models\Movie;
use App\Services\Movies\MovieFavoriteRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentMovieFavoriteRepository implements MovieFavoriteRepository
{
    public function listFavorites(string $userId, int $page = 1): LengthAwarePaginator
    {
        return Movie::query()
            ->whereHas(
                'favorites',
                fn($query) => $query->where('user_id', $userId)
            )->paginate();
    }

    public function create(string $userId, string $movieId): void
    {
        Movie::query()
            ->findOrFail($movieId)
            ->favorites()
            ->attach($userId);
    }

    public function delete(string $userId, string $movieId): void
    {
        Movie::query()
            ->findOrFail($movieId)
            ->favorites()
            ->detach($userId);
    }

    public function exists(string $userId, string $movieId): bool
    {
        return Movie::query()->whereHas(
            'favorites',
            fn($query) => $query
                ->where('user_id', $userId)
                ->where('movie_id', $movieId)
        )->exists();
    }
}
