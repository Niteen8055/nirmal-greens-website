<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Catalog\Domain\Variety\VarietyRepository;
use Src\Catalog\Infrastructure\Persistence\Eloquent\EloquentVarietyRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            VarietyRepository::class,
            EloquentVarietyRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
