<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Contracts\UserServiceInterface;
use App\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register the user management system services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
