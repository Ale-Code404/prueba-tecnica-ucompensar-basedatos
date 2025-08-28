<?php

namespace App\Services\Users\DTO;

use App\Users\UserRole;

class CreateUserInput
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly UserRole $role
    ) {}
}
