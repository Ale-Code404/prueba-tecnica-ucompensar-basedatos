<?php

namespace App\Http\Controllers;

use App\Http\Resources\Movies\MovieResource;
use App\Services\Auth\GetCurrentUser;
use Dedoc\Scramble\Attributes\BodyParameter;
use Illuminate\Http\Request;

use App\Services\Movies\{
    Errors\MovieAlreadyFavorite,
    Errors\MovieNotExists,
    CreateMovieFavorite,
    DeleteMovieFavorite,
    GetMovieFavorites
};

class MovieFavoriteController extends Controller
{
    public function __construct(
        private GetCurrentUser $getCurrentUser,
        private GetMovieFavorites $getMovieFavorites,
        private CreateMovieFavorite $createMovieFavorite,
        private DeleteMovieFavorite $deleteMovieFavorite
    ) {}

    /**
     * Retrieves a list of favorite movies.
     */
    public function index(Request $request)
    {
        $user = $this->getCurrentUser->execute();

        return MovieResource::collection(
            $this->getMovieFavorites->execute(
                $user->id,
                $request->get('page', 1)
            )
        );
    }

    /**
     * Add a new favorite movie.
     */
    #[BodyParameter(name: 'movie', description: 'The movie ID', example: 'tt1234567')]
    public function store(Request $request)
    {
        $request->validate([
            'movie' => 'required|string'
        ]);

        $user = $this->getCurrentUser->execute();

        try {
            $this->createMovieFavorite->execute(
                $user->id,
                $request->get('movie')
            );
        } catch (MovieNotExists | MovieAlreadyFavorite $e) {
            abort(400, $e->getMessage());
        }

        return response()->noContent();
    }

    /**
     * Remove a movie from favorites.
     */
    public function destroy(string $movieId)
    {
        $user = $this->getCurrentUser->execute();

        try {
            $this->deleteMovieFavorite->execute(
                $user->id,
                $movieId
            );
        } catch (MovieNotExists $e) {
            abort(400, $e->getMessage());
        }

        return response()->noContent();
    }
}
