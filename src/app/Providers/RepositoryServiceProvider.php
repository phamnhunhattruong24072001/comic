<?php

namespace App\Providers;

use App\Repositories\Contracts\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Contracts\CategoryRepository::class, \App\Repositories\Eloquents\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\AdminRepository::class, \App\Repositories\Eloquents\AdminRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
