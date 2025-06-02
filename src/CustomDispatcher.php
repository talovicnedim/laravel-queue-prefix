<?php

namespace Talovicnedim\LaravelQueuePrefix;

use Illuminate\Bus\Dispatcher;
use Illuminate\Contracts\Container\Container;

class CustomDispatcher extends Dispatcher
{
    /**
     * Construct the custom dispatcher.
     */
    public function __construct(Container $app, Dispatcher $dispatcher)
    {
        parent::__construct($app, $dispatcher->queueResolver);
    }

    /**
     * Dispatch a job to queue.
     */
    public function dispatchToQueue($command): mixed
    {
        $isAddingPrefixEnabled = config('queue-prefix.enabled');

        if (! $isAddingPrefixEnabled) {
            return parent::dispatchToQueue($command);
        }

        // Use default queue name from config if none is provided
        if (empty($command->queue)) {
            $defaultQueue = config('queue.connections.' . config('queue.default') . '.queue', 'default');
            $command->queue = $defaultQueue;
        }

        if (! $this->shouldBePrefixed($command->queue)) {
            return parent::dispatchToQueue($command);
        }

        return $this->prefixAndDispatchToQueue($command);
    }

    /**
     * Determine whether the queue name should be prefixed.
     */
    protected function shouldBePrefixed(?string $queue): bool
    {
        if (empty($queue)) {
            return false; // just in case
        }

        $allowedQueues = config('queue-prefix.allowed_queues', ['*']);
        $excludedQueues = config('queue-prefix.excluded_queues', []);

        if (in_array($queue, $excludedQueues)) {
            return false;
        }

        if (! in_array($queue, $allowedQueues) && ! in_array('*', $allowedQueues)) {
            return false;
        }

        return true;
    }

    /**
     * Prefix the queue name and dispatch the command to the queue.
     */
    protected function prefixAndDispatchToQueue($command)
    {
        $prefix = config('queue-prefix.prefix');

        $command->queue = $prefix ? "{$prefix}-{$command->queue}" : $command->queue;

        return parent::dispatchToQueue($command);
    }
}
