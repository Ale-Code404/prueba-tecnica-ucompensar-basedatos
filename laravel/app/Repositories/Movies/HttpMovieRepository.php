<?php

namespace App\Repositories\Movies;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\LengthAwarePaginator as PaginationLengthAwarePaginator;

use App\Repositories\Movies\HttpClient\{
    MovieClient,
    MovieSearchDetail
};
use App\Services\Movies\{
    DTO\MovieDetails,
    DTO\MovieSearchResult,
    MovieRepository
};

class HttpMovieRepository implements MovieRepository
{
    public function __construct(private MovieClient $client) {}

    public function search(
        string $query,
        ?int $year = null,
        ?int $page = 1
    ): LengthAwarePaginator {
        $movies = $this->client->search($query, $year, $page);

        return new PaginationLengthAwarePaginator(
            array_map(function (MovieSearchDetail $movie) {
                return new MovieSearchResult(
                    id: $movie->id,
                    title: $movie->title,
                    posterUrl: $movie->posterUrl,
                    releaseYear: $movie->releaseYear
                );
            }, $movies->results),
            $movies->totalResults,
            $movies->resultPerPage
        );
    }

    public function findById(string $id): ?MovieDetails
    {
        return null;
    }
}
