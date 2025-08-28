<?php

namespace App\Services\Users;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepository
{
    /**
     * Get all users paginated
     */
    public function all(int $page = 1): LengthAwarePaginator;

    /**
     * Creates a new user
     */
    public function create(User $user): User;
}
