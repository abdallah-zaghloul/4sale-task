<?php

namespace Modules\Transaction\Providers;

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
        $this->app->bind(\Modules\Transaction\Repositories\TransactionRepository::class, \Modules\Transaction\Repositories\TransactionRepositoryEloquent::class);
        //:end-bindings:
    }
}
