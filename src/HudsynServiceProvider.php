<?php

namespace jopanel\Hudsyn;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Router;

class HudsynServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load routes, views, migrations, etc.
        $router = $this->app->make(Router::class);
        // Ensure CSRF middleware is applied to package routes
        $router->pushMiddlewareToGroup('web', VerifyCsrfToken::class);
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'hudsyn');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        

        // Publish views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/hudsyn'),
        ], 'hudsyn-views');

        // Publish migrations
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'hudsyn-migrations');

        // Publish public assets (static folders)
        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/hudsyn'),
        ], 'hudsyn-public');

        // Publish seeders if desired
        $this->publishes([
            __DIR__.'/../database/seeders' => database_path('seeders'),
        ], 'hudsyn-seeders');
    }

    public function register()
    {
        // Register any package services or bindings.
    }
}
