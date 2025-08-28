<?php

namespace App\Repositories\Movies\HttpClient\Errors;

use RuntimeException;

class ClientNotConfigured extends RuntimeException
{
    public function __construct(string $missing)
    {
        parent::__construct("The HTTP Client is not configured at: {$missing}");
    }
}
