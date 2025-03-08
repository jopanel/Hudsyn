<?php

namespace Jopanel\Hudsyn;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Jopanel\Hudsyn\Middleware\HudsynMiddleware;

class HudsynServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $router = $this->app->make(Router::class);

        // Ensure CSRF protection is applied
        $router->pushMiddlewareToGroup('web', VerifyCsrfToken::class);

        // Register the Hudsyn authentication middleware
        $router->aliasMiddleware('hudsyn.auth', HudsynMiddleware::class);

        // Load package routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Load package views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'hudsyn');

        // Load package migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Publish configuration file
        $this->publishes([
            __DIR__.'/../config/hudsyn.php' => config_path('hudsyn.php'),
        ], 'hudsyn-config');

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

        // Publish seeders
        $this->publishes([
            __DIR__.'/../database/seeders' => database_path('seeders'),
        ], 'hudsyn-seeders');

        // Automatically merge authentication settings for the Hudsyn guard
        $this->mergeAuthConfig();
    }

    public function register()
    {
        // Register package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/hudsyn.php', 'hudsyn');
    }

    private function mergeAuthConfig()
    {
        // Define the custom authentication settings for Hudsyn
        $authConfig = [
            'guards' => [
                'hudsyn' => [
                    'driver' => 'session',
                    'provider' => 'hudsyn_users',
                ],
            ],
            'providers' => [
                'hudsyn_users' => [
                    'driver' => 'eloquent',
                    'model' => \Jopanel\Hudsyn\Models\User::class,
                    'table' => 'hud_users', // Ensures that authentication uses the hud_users table
                ],
            ],
        ];

        // Merge with Laravel's default authentication config
        foreach ($authConfig as $key => $value) {
            config(["auth.$key" => array_merge(config("auth.$key", []), $value)]);
        }
    }
}
