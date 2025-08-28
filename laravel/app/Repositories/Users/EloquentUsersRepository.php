<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Services\Users\UserRepository;

use Illuminate\Contracts\Pagination\{
    LengthAwarePaginator,
    Paginator
};

class EloquentUsersRepository implements UserRepository
{
    /**
     * @return Paginator<int, User>
     */
    public function all(int $page = 1): LengthAwarePaginator
    {
        return User::query()->paginate(
            config('app.pagination.per_page'),
            ['*'],
            'page',
            $page
        );
    }

    public function create(User $user): User
    {
        if ($user->exists) {
            return $user;
        }

        $user->save();

        return $user;
    }
}
