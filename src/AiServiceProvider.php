<?php

namespace Devdojo\Ai;

use Illuminate\Support\ServiceProvider;

class AiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'ai');

        $this->app->singleton('ai', function () {
            return new Ai;
        });

        if (file_exists($helpers = __DIR__ . '/helpers.php')) {
            require_once $helpers;
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('ai.php'),
            ], 'config');
        }
    }
}
