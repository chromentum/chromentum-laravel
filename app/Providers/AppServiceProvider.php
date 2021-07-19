<?php

namespace App\Providers;

use App\Contracts\BackgroundImageService;
use App\Services\UnsplashService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BackgroundImageService::class, function ($app) {
            return new UnsplashService(config('app.background-image.unsplash'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
