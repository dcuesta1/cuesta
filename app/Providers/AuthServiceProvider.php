<?php

namespace Api\Providers;

use Api\{
    Car, Customer, Invoice, Policies\CarPolicy, User
};
use Api\policies\{UserPolicy, InvoicePolicy};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Invoice::class => InvoicePolicy::class,
        Car::class => CarPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
