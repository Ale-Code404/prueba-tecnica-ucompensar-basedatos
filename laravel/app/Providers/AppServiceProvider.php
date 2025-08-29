<?php

namespace App\Providers;

use App\Repositories\Users\EloquentUsersRepository;
use App\Services\Users\UserRepository;
use Illuminate\Support\ServiceProvider;

use App\Repositories\Movies\{
    EloquentMovieFavoriteRepository,
    EloquentMovieManagerRepository,
    HttpMovieRepository
};
use App\Services\Movies\{
    MovieFavoriteRepository,
    MovieManagerRepository,
    MovieRepository
};

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
        $this->app->bind(MovieFavoriteRepository::class, EloquentMovieFavoriteRepository::class);
        $this->app->bind(MovieManagerRepository::class, EloquentMovieManagerRepository::class);
    }
}
