<?php

namespace App\Repositories\Movies\HttpClient\Responses;

class MovieDetailResponse
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly int $year,
        public readonly string $description,
        public readonly string $posterUrl,
        public readonly array $directors,
        public readonly array $writers,
        public readonly array $actors,
        public readonly array $genres,
    ) {}
}
