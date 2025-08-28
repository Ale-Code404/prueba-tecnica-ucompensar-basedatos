<?php

namespace App\Services\Users;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

class GetAllUsers
{
    public function __construct(private UserRepository $userRepository) {}

    public function execute(int $page = 1)
    {
        Gate::authorize('list', User::class);

        return $this->userRepository->all($page);
    }
}
