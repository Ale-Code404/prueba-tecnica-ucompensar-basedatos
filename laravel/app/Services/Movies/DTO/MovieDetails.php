<?php

namespace App\Services\Movies\DTO;

class MovieDetails
{
    public function __construct(
        public readonly string $id,
        public readonly string $title
    ) {}
}
