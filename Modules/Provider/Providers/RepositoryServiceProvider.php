<?php

namespace Modules\Provider\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
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
        $this->app->bind(\Modules\Provider\Repositories\ProviderRepository::class, \Modules\Provider\Repositories\ProviderRepositoryEloquent::class);
        //:end-bindings:
    }
}
