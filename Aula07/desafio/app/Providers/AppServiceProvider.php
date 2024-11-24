<?php

namespace App\Providers;

use Architecture\Infraestructure\Repository\Eloquent\EloquentReservationRepository;
use Architecture\Infraestructure\Repository\Eloquent\EloquentStoredBookRepository;
use Architecture\Infraestructure\Repository\Eloquent\EloquentUserRepository;
use Architecture\Infraestructure\ReservationRepositoryInterface;
use Architecture\Infraestructure\StoredBookRepositoryInterface;
use Architecture\Infraestructure\UserRepositoryInterface;
use Architecture\Presenter\JsonResponsePresenter;
use Architecture\Presenter\ResponsePresenterInterface;
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
        $this->app->bind(UserRepositoryInterface::class, function () {
            return new EloquentUserRepository();
        });

        $this->app->bind(StoredBookRepositoryInterface::class, function () {
            return new EloquentStoredBookRepository();
        });

        $this->app->bind(ReservationRepositoryInterface::class, function () {
            return new EloquentReservationRepository();
        });

        $this->app->bind(ResponsePresenterInterface::class, function () {
            return new JsonResponsePresenter();
        });
    }
}
