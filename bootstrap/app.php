<?php


$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    Api\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    Api\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Api\Exceptions\Handler::class
);

/*
 | -----------------------------------------------
 |   ADDED AUTHENTICATOR HELPER CLASS
 |
*/

$app->singleton('Authenticator', function ($app) {
	return new \Api\Auth\Authentication();
});

return $app;
