<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Auth\DTO\LoginInput;
use App\Services\Auth\Errors\InvalidCredentials;
use Illuminate\Support\Facades\Hash;

class LoginUser
{
    /**
     * Performs a user logins
     * 
     * @throws InvalidCredentials
     */
    public function execute(LoginInput $input): string
    {
        $user = User::where('email', $input->email)->first();

        if (!$user || !Hash::check($input->password, $user->password)) {
            throw new InvalidCredentials;
        }

        return $user->createToken($input->email)
            ->plainTextToken;
    }
}
