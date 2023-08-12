# Laravel Queue Prefix

This package adds queue name prefixes in Laravel to avoid conflicts between different environments. 

It's recommended to use separate queues for different environments when hosting under one cloud account. 

By simplifying your queue management, you can improve your application's efficiency and avoid potential issues.

## Installation

You can install the package via Composer:

```bash
composer require talovicnedim/laravel-queue-prefix
```

The package will automatically register itself. If, for some reason, the package is not registered automatically, you can add the following line to your config/app.php file:
```php
'providers' => [
    // ...
    Talovicnedim\LaravelQueuePrefix\QueuePrefixServiceProvider::class,
],
```


You can publish the configuration file with:

```bash
php artisan vendor:publish --provider="Talovicnedim\LaravelQueuePrefix\QueuePrefixServiceProvider"
```

This will create a **`laravel-queue-prefix.php`** file in your config directory.

## Usage

Once you have installed the package and published the configuration file, you can enable or disable prefixing of queue names by setting the enabled option in the configuration file.

```php
return [
    'enabled' => true, // enable prefixing
    'prefix' => env('APP_ENV', 'prod') // the prefix to use (if enabled)
    'allowed_queues' => ['*'] // prefix all queues
    'excluded_queues' => [] // queues to exclude from prefixing
];
```

If prefixing is enabled, the package will automatically add the prefix to the names of all queues before they are dispatched.

For example, if you have a queue named emails, and your prefix is set to `prod` the queue name will be changed to `prod-emails`.

If prefixing is disabled, the package will not modify the names of queues before they are dispatched.

## Testing

You can run the tests with:

```bash
composer test
```

## Credits

* Nedim Talovic 
* All Contributors

## License

The MIT License (MIT). Please see License File for more information.
    



