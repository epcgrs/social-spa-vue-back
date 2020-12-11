<?php

namespace App\Providers;

use App\Core\API\Repositories\Contracts\IUserRepository;
use App\Core\API\Repositories\UserRepository;
use App\Core\API\Services\Contracts\IUserService;
use App\Core\API\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        // API Repositories
        $this->app->bind(IUserRepository::class, UserRepository::class);

        // API Services
        $this->app->bind(IUserService::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
