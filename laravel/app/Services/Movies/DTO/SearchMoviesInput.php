<?php

namespace App\Services\Movies\DTO;

class SearchMoviesInput
{
    public function __construct(
        public readonly ?string $search = null,
        public readonly ?int $year = null,
        public readonly ?int $page = 1
    ) {}
}
