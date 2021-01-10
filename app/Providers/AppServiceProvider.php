<?php

namespace App\Providers;

use App\Core\API\Repositories\CommentRepository;
use App\Core\API\Repositories\ContentRepository;
use App\Core\API\Repositories\Contracts\ICommentsRepository;
use App\Core\API\Repositories\Contracts\IContentRepository;
use App\Core\API\Repositories\Contracts\IUserRepository;
use App\Core\API\Repositories\UserRepository;
use App\Core\API\Services\CommentService;
use App\Core\API\Services\ContentService;
use App\Core\API\Services\Contracts\ICommentService;
use App\Core\API\Services\Contracts\IContentService;
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
        $this->app->bind(IContentRepository::class, ContentRepository::class);
        $this->app->bind(ICommentsRepository::class, CommentRepository::class);

        // API Services
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IContentService::class, ContentService::class);
        $this->app->bind(ICommentService::class, CommentService::class);
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
