<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user)
    {
        return checkPermission($user::VIEW);
    }

    public function create(User $user)
    {
        return checkPermission($user::CREATE);
    }

    public function update(User $user)
    {
        return checkPermission($user::UPDATE);
    }


    public function delete(User $user)
    {
        return checkPermission($user::DELETE);
    }

    public function restore(User $user)
    {
        return checkPermission($user::RESTORE);
    }

    public function forceDelete(User $user)
    {
        return checkPermission($user::FORCE_DELETE);
    }
}
