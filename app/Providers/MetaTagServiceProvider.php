<?php

namespace App\Providers;

use App\Helpers\MetaTag;
use Illuminate\Support\ServiceProvider;

class MetaTagServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('metatag', function ($app) {
            return new MetaTag(
                $app['request'],
                $app['config']->get('app.locale'),
                $app['config']['meta-tag']
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('meta-tags.php')
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['metatag'];
    }
}
