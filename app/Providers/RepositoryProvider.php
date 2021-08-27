<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Contracts\CategoryInterface::class,
            \App\Repositories\CategoryRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Contracts\PostInterface::class,
            \App\Repositories\PostRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Contracts\RecruitmentInterface::class,
            \App\Repositories\RecruitmentRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
