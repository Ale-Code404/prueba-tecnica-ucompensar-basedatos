<?php

namespace App\Services\Movies\DTO;

use Illuminate\Contracts\Support\Arrayable;

class MovieDetails implements Arrayable
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly string $year,
        public readonly string $description,
        public readonly string $posterUrl,
        public readonly array $directors,
        public readonly array $writers,
        public readonly array $actors,
        public readonly array $genres,
    ) {}

    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'year' => $this->year,
            'description' => $this->description,
            'poster_url' => $this->posterUrl,
            'directors' => $this->directors,
            'writers' => $this->writers,
            'actors' => $this->actors,
            'genres' => $this->genres,
        ];
    }
}
