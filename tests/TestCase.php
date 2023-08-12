<?php

namespace Talovicnedim\LaravelQueuePrefix\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Talovicnedim\LaravelQueuePrefix\QueuePrefixServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            QueuePrefixServiceProvider::class,
        ];
    }
}
