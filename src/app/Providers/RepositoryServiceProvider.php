<?php

namespace App\Providers;

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
        $this->app->bind(\App\Repositories\Contracts\UserRepository::class, \App\Repositories\Eloquents\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\PermissionRepository::class, \App\Repositories\Eloquents\PermissionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\RoleRepository::class, \App\Repositories\Eloquents\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\UserRoleRepository::class, \App\Repositories\Eloquents\UserRoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\PermissionRoleRepository::class, \App\Repositories\Eloquents\PermissionRoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\CategoryRepository::class, \App\Repositories\Eloquents\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\CountryRepository::class, \App\Repositories\Eloquents\CountryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\GenreRepository::class, \App\Repositories\Eloquents\GenreRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ComicRepository::class, \App\Repositories\Eloquents\ComicRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ChapterRepository::class, \App\Repositories\Eloquents\ChapterRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\FigureRepository::class, \App\Repositories\Eloquents\FigureRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\ClientRepository::class, \App\Repositories\Eloquents\ClientRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contracts\CommentRepository::class, \App\Repositories\Eloquents\CommentRepositoryEloquent::class);
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
