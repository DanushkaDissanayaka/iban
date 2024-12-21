<?php

namespace App\Providers;

use App\Repositories\Contracts\IbanRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\IbanRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public $singletons = [
        UserRepositoryInterface::class => UserRepository::class,
        IbanRepositoryInterface::class => IbanRepository::class
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
