<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Services\Movies\{
    DTO\SearchMoviesInput,
    SearchMovies
};

class MovieController extends Controller
{
    public function __construct(
        private SearchMovies $searchMovies
    ) {}

    /**
     * Retrieves a list of movies by searching.
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'required|string|max:255',
            'page' => 'integer|min:1',
        ]);

        $movies = $this->searchMovies->execute(
            new SearchMoviesInput(
                search: $request->input('search'),
                page: $request->input('page', 1)
            )
        );

        return JsonResource::collection($movies);
    }

    /**
     * Display a movie details.
     */
    public function show(string $id) {}
}
