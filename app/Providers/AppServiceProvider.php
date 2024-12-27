<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\CheckForPrice; // Import the middleware
use App\Http\Middleware\CheckForAuth;  // Import the middleware

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app['router']->aliasMiddleware('check.for.price', CheckForPrice::class);
        $this->app['router']->aliasMiddleware('check.for.auth', CheckForAuth::class);
    }
}
