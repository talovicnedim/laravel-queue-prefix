<?php

namespace Talovicnedim\LaravelQueuePrefix\Tests;

use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Talovicnedim\LaravelQueuePrefix\Tests\Helpers\ExampleJob;

class CustomDispatchTest extends TestCase
{
    public function test_when_package_is_enabled_and_with_prefix()
    {
        $prefix = Str::uuid()->toString();
        $queue = Str::uuid()->toString();

        config(['queue-prefix.prefix' => $prefix]);

        Queue::fake();

        dispatch(new ExampleJob())->onQueue($queue);

        Queue::assertPushedOn("{$prefix}-$queue", ExampleJob::class);
    }

    public function test_when_package_is_enabled_and_without_prefix()
    {
        $queue = Str::uuid()->toString();

        config(['queue-prefix.prefix' => '']);

        Queue::fake();

        dispatch(new ExampleJob())->onQueue($queue);

        Queue::assertPushedOn($queue, ExampleJob::class);
    }

    public function test_when_package_is_disabled()
    {
        $queue = Str::uuid()->toString();

        config(['queue-prefix.enabled' => false]);

        Queue::fake();

        dispatch(new ExampleJob())->onQueue($queue);

        Queue::assertPushedOn($queue, ExampleJob::class);
    }

    public function test_when_queue_is_in_the_allowed_list()
    {
        $prefix = Str::uuid()->toString();
        $queue = Str::uuid()->toString();

        config([
            'queue-prefix.prefix' => $prefix,
            'queue-prefix.allowed_queues' => [$queue],
        ]);

        Queue::fake();

        dispatch(new ExampleJob())->onQueue($queue);

        Queue::assertPushedOn("{$prefix}-$queue", ExampleJob::class);
    }

    public function test_when_queue_is_in_the_excluded_list()
    {
        $prefix = Str::uuid()->toString();
        $queue = Str::uuid()->toString();

        config([
            'queue-prefix.prefix' => $prefix,
            'queue-prefix.excluded_queues' => [$queue],
        ]);

        Queue::fake();

        dispatch(new ExampleJob())->onQueue($queue);

        Queue::assertPushedOn($queue, ExampleJob::class);
    }
}
