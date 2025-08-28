<?php

namespace App\Services\Auth\DTO;

class LoginInput
{
    public function __construct(
        public readonly string $email,
        public readonly string $password
    ) {}
}
