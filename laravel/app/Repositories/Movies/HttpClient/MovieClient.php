<?php

namespace App\Repositories\Movies\HttpClient;

use App\Repositories\Movies\HttpClient\Errors\ClientNotConfigured;
use App\Repositories\Movies\HttpClient\Responses\MovieDetailResponse;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class MovieClient
{
    public function __construct(private ?PendingRequest $client = null) {}

    public function getClient(): PendingRequest
    {
        if (!$this->client) {
            $this->init();
        }

        return $this->client;
    }

    /**
     * Search movies using an external service
     */
    public function search(
        string $query,
        ?int $year = null,
        ?int $page = null
    ): MovieSearchResult {
        $params = [
            's' => $query,
            'type' => 'movie',
            'page' => $page ?? 1
        ];

        if (!is_null($year)) {
            $params['y'] = $year;
        }

        $movies = $this->getClient()->get('/', $params)->json();

        return new MovieSearchResult(
            results: array_map(function (array $movie) {
                return new MovieSearchDetail(
                    id: $movie['imdbID'] ?? null,
                    title: $movie['Title'] ?? null,
                    posterUrl: $movie['Poster'] ?? null,
                    releaseYear: $movie['Year'] ?? null
                );
            }, $movies['Search'] ?? []),
            totalResults: intval($movies['totalResults'] ?? 0),
            resultPerPage: 10
        );
    }

    /**
     * Find a movie by his imbID
     */
    public function findById(string $movieId): ?MovieDetailResponse
    {
        $movie = $this->getClient()
            ->get('/', ['i' => $movieId,])->json();

        if (!$movie || data_get($movie, 'Response') === 'False') {
            return null;
        }

        return new MovieDetailResponse(
            id: $movie['imdbID'],
            title: $movie['Title'],
            year: $movie['Year'],
            description: $movie['Plot'],
            posterUrl: $movie['Poster'],
            directors: explode(', ', $movie['Director']),
            writers: explode(', ', $movie['Writer']),
            actors: explode(', ', $movie['Actors']),
            genres: explode(', ', $movie['Genre']),
        );
    }

    private function init(): void
    {
        $baseUrl = config('services.movies.url');
        $apiKey = config('services.movies.key');

        if (!$baseUrl) {
            throw new ClientNotConfigured('url');
        }

        if (!$apiKey) {
            throw new ClientNotConfigured('apiKey');
        }

        $this->client = Http::baseUrl(config('services.movies.url'))
            ->timeout(45)
            ->retry(3, 1_000)
            ->withQueryParameters([
                'apiKey' => config('services.movies.key'),

            ]);
    }
}
