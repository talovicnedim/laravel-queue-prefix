<?php

namespace Talovicnedim\LaravelQueuePrefix;

use Illuminate\Bus\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class QueuePrefixServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('queue-prefix.php'),
        ], 'queue-prefix');

        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'queue-prefix');
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->extend(Dispatcher::class, function (Dispatcher $dispatcher, Container $app) {
            return new CustomDispatcher($app, $dispatcher);
        });
    }
}
