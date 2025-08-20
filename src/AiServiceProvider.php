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

        if (file_exists($functions = __DIR__ . '/functions.php')) {
            require_once $functions;
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

            $this->publishes([
                __DIR__.'/../examples/' => resource_path('views/livewire/'),
            ], 'ai-examples');

            $this->commands([
                \Devdojo\Ai\Commands\InstallExamplesCommand::class,
            ]);
        }
    }
}
