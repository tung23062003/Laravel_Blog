<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\CommentRepositoryInterface;
use App\Repositories\Interface\PostRepositoryInterface;
use App\Repositories\Interface\PostTagRepositoryInterface;
use App\Repositories\Interface\TagRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\PostRepository;
use App\Repositories\PostTagRepository;
use App\Repositories\TagRepository;
use App\Repositories\UserRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(PostTagRepositoryInterface::class, PostTagRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
