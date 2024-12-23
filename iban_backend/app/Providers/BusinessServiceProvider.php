<?php

namespace App\Providers;

use App\Services\AuthService;
use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\IbanServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\IbanService;
use App\Services\UserService;

class BusinessServiceProvider extends ServiceProvider
{
    public $singletons = [
        AuthServiceInterface::class => AuthService::class,
        UserServiceInterface::class => UserService::class,
        IbanServiceInterface::class => IbanService::class
    ];
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
