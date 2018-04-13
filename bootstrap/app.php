<?php


$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
 | -----------------------------------------------
 |   ADDED AUTHENTICATOR HELPER CLASS
 |
*/

$app->singleton('Authenticator', function ($app) {
	return new \App\Auth\Authentication();
});

return $app;
