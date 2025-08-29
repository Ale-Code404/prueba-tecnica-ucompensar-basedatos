<?php

namespace App\Services\Movies\Errors;

use RuntimeException;

class MovieAlreadyFavorite extends RuntimeException
{
    public function __construct()
    {
        parent::__construct("The movie is already marked as favorite.");
    }
}
