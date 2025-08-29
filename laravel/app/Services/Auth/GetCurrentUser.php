<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GetCurrentUser
{
    public function execute(): ?User
    {
        /** @var User */
        return Auth::user();
    }
}
