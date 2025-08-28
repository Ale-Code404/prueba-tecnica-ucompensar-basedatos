<?php

namespace App\Services\Movies;

use App\Services\Movies\DTO\SearchMoviesInput;

class SearchMovies
{
    public function __construct(
        private MovieRepository $movieRepository
    ) {}

    /**
     * Retrieves a list of movies based on the search criteria.
     */
    public function execute(SearchMoviesInput $input)
    {
        return $this->movieRepository->search(
            query: $input->search,
            year: $input->year,
            page: $input->page
        );
    }
}
