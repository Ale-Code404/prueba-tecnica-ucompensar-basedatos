<?php

namespace App\Providers;

use App\Repositories\Movies\HttpMovieRepository;
use App\Repositories\Users\EloquentUsersRepository;
use App\Services\Movies\MovieRepository;
use App\Services\Users\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(UserRepository::class, EloquentUsersRepository::class);
        $this->app->bind(MovieRepository::class, HttpMovieRepository::class);
    }
}
