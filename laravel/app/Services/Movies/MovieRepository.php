<?php

namespace App\Services\Movies;

use App\Services\Movies\DTO\{
    MovieDetails,
    MovieSearchResult
};
use Illuminate\Contracts\Pagination\{
    LengthAwarePaginator,
    Paginator
};

interface MovieRepository
{
    /**
     * Retrieves a list of movies based on the search criteria.
     * 
     * @return Paginator<int, MovieSearchResult>
     */
    public function search(
        string $query,
        ?int $year = null,
        ?int $page = 1
    ): LengthAwarePaginator;

    /**
     * Retrieves full movie details
     */
    public function findById(string $movieId): ?MovieDetails;
}
