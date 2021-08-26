<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Project;
use App\Observers\CreateSiteMapObserver;
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
        $this->app->bind('option', \App\Models\Option::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(CreateSiteMapObserver::class);
        Category::observe(CreateSiteMapObserver::class);
    }
}
