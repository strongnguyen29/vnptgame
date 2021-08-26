<?php

namespace App\Providers;

use App\Models\Menu;
use App\View\Composers\Front\PostsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('front.sections.posts-latest', PostsComposer::class);
    }
}
