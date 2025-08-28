<?php

namespace Database\Seeders;

use App\Users\UserRole;
use Illuminate\Database\Seeder;

use App\Services\Users\{
    DTO\CreateUserInput,
    CreateUser
};

class UserSeeder extends Seeder
{
    public function __construct(private CreateUser $createUser) {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createUser->execute(
            new CreateUserInput(
                name: 'Administrator',
                email: 'admin@movies.com',
                password: 'password',
                role: UserRole::Admin
            )
        );
    }
}
