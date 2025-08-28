<?php

namespace App\Services\Movies\DTO;

use Illuminate\Contracts\Support\Arrayable;

class MovieSearchResult implements Arrayable
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly string $posterUrl,
        public readonly string $releaseYear,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'poster_url' => $this->posterUrl,
            'release_year' => $this->releaseYear,
        ];
    }
}
