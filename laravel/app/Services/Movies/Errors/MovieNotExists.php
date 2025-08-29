<?php

namespace App\Services\Movies\Errors;

use RuntimeException;

class MovieNotExists extends RuntimeException
{
    public function __construct(string $movieId)
    {
        parent::__construct("Movie with ID [{$movieId}] does not exist.");
    }
}
