<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function list(User $user): bool
    {
        return $user->isAdmin();
    }
}
