<?php 

namespace App\Services;
use Illuminate\Support\Facades\Gate;

class PermissionGateAndPolicy
{
    public function setGateAndPolicy()
    {
        $this->defineGateUser();
    }

    public function defineGateUser()
    {
        Gate::define(\App\Models\User::LIST, 'App\Policies\UserPolicy@view');
        Gate::define(\App\Models\User::CREATE, 'App\Policies\UserPolicy@create');
        Gate::define(\App\Models\User::UPDATE, 'App\Policies\UserPolicy@update');
        Gate::define(\App\Models\User::DELETE, 'App\Policies\UserPolicy@delete');
        Gate::define(\App\Models\User::RESTORE, 'App\Policies\UserPolicy@restore');
        Gate::define(\App\Models\User::FORCE_DELETE, 'App\Policies\UserPolicy@forceDelete');
    }
}