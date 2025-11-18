<?php

namespace App\Providers;


use App\Services\Auth\AuthService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class AuthServiceProvider extends ServiceProvider implements DeferrableProvider
{

   
    /**
     * Register services.
     */
    public function register(): void
    {
         $this->app->singleton(AuthService::class, function ($app) {
            return new AuthService();
        });
    }
     public function provides(): array
    {
        return [AuthService::class];
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
