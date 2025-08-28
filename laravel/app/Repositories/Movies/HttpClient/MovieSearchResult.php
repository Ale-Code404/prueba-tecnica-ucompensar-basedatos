<?php

namespace App\Repositories\Movies\HttpClient;

class MovieSearchResult
{
    /** @param array<int, MovieSearchDetail> $results */
    public function __construct(
        public readonly array $results,
        public readonly int $totalResults,
        public readonly int $resultPerPage
    ) {}
}
