<?php

namespace App\Http\Controllers;

use App\Http\Resources\Users\UserResource;
use App\Users\UserRole;

use App\Http\Requests\Auth\{
    LoginRequest,
    RegisterRequest
};
use App\Services\Auth\{
    DTO\LoginInput,
    Errors\InvalidCredentials,
    LoginUser
};
use App\Services\Users\{
    DTO\CreateUserInput,
    CreateUser
};

class AuthController extends Controller
{
    public function __construct(
        private LoginUser $loginUser,
        private CreateUser $createUser
    ) {}

    /**
     * Authenticate as a user
     * 
     * @unauthenticated
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        try {
            $token = $this->loginUser->execute(
                new LoginInput(
                    email: $validated['email'],
                    password: $validated['password']
                )
            );

            return response()->json(['token' => $token]);
        } catch (InvalidCredentials $e) {
            abort(401, $e->getMessage());
        }
    }

    /**
     * Register a new user
     * 
     * @unauthenticated
     */
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        return new UserResource(
            $this->createUser->execute(new CreateUserInput(
                name: $validated['name'],
                email: $validated['email'],
                password: $validated['password'],
                role: UserRole::User
            ))
        );
    }
}
