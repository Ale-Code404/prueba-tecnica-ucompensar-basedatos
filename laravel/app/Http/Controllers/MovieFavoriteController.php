<?php

namespace App\Http\Controllers;

use App\Http\Resources\Movies\MovieResource;
use Illuminate\Http\Request;

class MovieFavoriteController extends Controller
{
    public function __construct(
        private GetCurrentUser $getCurrentUser,
        private GetFavoriteMovies $getFavoriteMovies,
        private AddFavoriteMovie $addFavoriteMovie,
        private RemoveFavoriteMovie $removeFavoriteMovie
    ) {}

    /**
     * Retrieves a list of favorite movies.
     */
    public function index()
    {
        $user = $this->getCurrentUser->execute();

        return MovieResource::collection(
            $this->getFavoriteMovies->execute($user->id)
        );
    }

    /**
     * Add a new favorite movie.
     */
    public function store(Request $request) {}

    /**
     * Remove a movie from favorites.
     */
    public function destroy(string $id)
    {
        //
    }
}
