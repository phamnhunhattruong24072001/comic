<?php

namespace App\Services;
use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicy
{
    public function setGateAndPolicy()
    {
        $this->defineGateUser();
        $this->defineGateCountry();
        $this->defineGateCategory();
        $this->defineGateGenre();
        $this->defineGateComic();
        $this->defineGateChapter();
    }

    public function defineGateUser()
    {
        Gate::define(\App\Models\User::VIEW, 'App\Policies\UserPolicy@view');
        Gate::define(\App\Models\User::CREATE, 'App\Policies\UserPolicy@create');
        Gate::define(\App\Models\User::UPDATE, 'App\Policies\UserPolicy@update');
        Gate::define(\App\Models\User::DELETE, 'App\Policies\UserPolicy@delete');
        Gate::define(\App\Models\User::RESTORE, 'App\Policies\UserPolicy@restore');
        Gate::define(\App\Models\User::FORCE_DELETE, 'App\Policies\UserPolicy@forceDelete');
    }

    public function defineGateCountry()
    {
        Gate::define(\App\Models\Country::VIEW, 'App\Policies\CountryPolicy@view');
        Gate::define(\App\Models\Country::CREATE, 'App\Policies\CountryPolicy@create');
        Gate::define(\App\Models\Country::UPDATE, 'App\Policies\CountryPolicy@update');
        Gate::define(\App\Models\Country::DELETE, 'App\Policies\CountryPolicy@delete');
        Gate::define(\App\Models\Country::RESTORE, 'App\Policies\CountryPolicy@restore');
        Gate::define(\App\Models\Country::FORCE_DELETE, 'App\Policies\CountryPolicy@forceDelete');
    }

    public function defineGateCategory()
    {
        Gate::define(\App\Models\Category::VIEW, 'App\Policies\CategoryPolicy@view');
        Gate::define(\App\Models\Category::CREATE, 'App\Policies\CategoryPolicy@create');
        Gate::define(\App\Models\Category::UPDATE, 'App\Policies\CategoryPolicy@update');
        Gate::define(\App\Models\Category::DELETE, 'App\Policies\CategoryPolicy@delete');
        Gate::define(\App\Models\Category::RESTORE, 'App\Policies\CategoryPolicy@restore');
        Gate::define(\App\Models\Category::FORCE_DELETE, 'App\Policies\CategoryPolicy@forceDelete');
    }

    public function defineGateGenre()
    {
        Gate::define(\App\Models\Genre::VIEW, 'App\Policies\GenrePolicy@view');
        Gate::define(\App\Models\Genre::CREATE, 'App\Policies\GenrePolicy@create');
        Gate::define(\App\Models\Genre::UPDATE, 'App\Policies\GenrePolicy@update');
        Gate::define(\App\Models\Genre::DELETE, 'App\Policies\GenrePolicy@delete');
        Gate::define(\App\Models\Genre::RESTORE, 'App\Policies\GenrePolicy@restore');
        Gate::define(\App\Models\Genre::FORCE_DELETE, 'App\Policies\GenrePolicy@forceDelete');
    }

    public function defineGateComic()
    {
        Gate::define(\App\Models\Comic::VIEW, 'App\Policies\ComicPolicy@view');
        Gate::define(\App\Models\Comic::CREATE, 'App\Policies\ComicPolicy@create');
        Gate::define(\App\Models\Comic::UPDATE, 'App\Policies\ComicPolicy@update');
        Gate::define(\App\Models\Comic::DELETE, 'App\Policies\ComicPolicy@delete');
        Gate::define(\App\Models\Comic::RESTORE, 'App\Policies\ComicPolicy@restore');
        Gate::define(\App\Models\Comic::FORCE_DELETE, 'App\Policies\ComicPolicy@forceDelete');
    }

    public function defineGateChapter()
    {
        Gate::define(\App\Models\Chapter::VIEW, 'App\Policies\ChapterPolicy@view');
        Gate::define(\App\Models\Chapter::CREATE, 'App\Policies\ChapterPolicy@create');
        Gate::define(\App\Models\Chapter::UPDATE, 'App\Policies\ChapterPolicy@update');
        Gate::define(\App\Models\Chapter::DELETE, 'App\Policies\ChapterPolicy@delete');
        Gate::define(\App\Models\Chapter::RESTORE, 'App\Policies\ChapterPolicy@restore');
        Gate::define(\App\Models\Chapter::FORCE_DELETE, 'App\Policies\ChapterPolicy@forceDelete');
    }
}
