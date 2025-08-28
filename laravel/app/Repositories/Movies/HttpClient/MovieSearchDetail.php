<?php

namespace App\Repositories\Movies\HttpClient;

class MovieSearchDetail
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly string $posterUrl,
        public readonly string $releaseYear
    ) {}
}
