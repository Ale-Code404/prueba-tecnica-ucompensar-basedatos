<?php

namespace App\Services\Auth\Errors;

use RuntimeException;

class InvalidCredentials extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Credentials are invalid');
    }
}
