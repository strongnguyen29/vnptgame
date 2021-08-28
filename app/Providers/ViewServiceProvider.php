<?php

namespace App\Providers;

use App\View\Composers\Backend\NewPostsComposer;
use App\View\Composers\Backend\NewRecruitmentAppliesComposer;
use App\View\Composers\Backend\NewRecruitmentComposer;
use App\View\Composers\Front\PostsComposer;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();
        View::composer('front.sections.posts-latest', PostsComposer::class);
        View::composer('backend.pages.dashboard.sections.new_posts', NewPostsComposer::class);
        View::composer('backend.pages.dashboard.sections.new_recruitment', NewRecruitmentComposer::class);
        View::composer('backend.pages.dashboard.sections.new_applies', NewRecruitmentAppliesComposer::class);
    }
}
