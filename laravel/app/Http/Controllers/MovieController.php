<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Services\Movies\{
    DTO\SearchMoviesInput,
    Errors\MovieNotExists,
    GetMovieDetails,
    SearchMovies
};

class MovieController extends Controller
{
    public function __construct(
        private SearchMovies $searchMovies,
        private GetMovieDetails $getMovieDetails
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
    public function show(string $movieId)
    {
        try {
            $movie = $this->getMovieDetails->execute($movieId);

            return response()->json([
                'data' => $movie
            ]);
        } catch (MovieNotExists $e) {
            abort(404, $e->getMessage());
        }
    }
}
