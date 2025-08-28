<?php

namespace App\Services\Users;

use App\Events\Users\UserCreated;
use App\Models\User;
use App\Services\Users\DTO\CreateUserInput;

class CreateUser
{
    public function __construct(private UserRepository $userRepository) {}

    public function execute(CreateUserInput $data): User
    {
        $user = new User([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
            'role' => $data->role->value
        ]);

        $this->userRepository->create($user);

        event(new UserCreated($user));

        return $user;
    }
}
