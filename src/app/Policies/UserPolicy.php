<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user): bool
    {
        return checkPermission($user::VIEW);
    }

    public function create(User $user): bool
    {
        return checkPermission($user::CREATE);
    }

    public function update(User $user): bool
    {
        return checkPermission($user::UPDATE);
    }


    public function delete(User $user): bool
    {
        return checkPermission($user::DELETE);
    }

    public function restore(User $user): bool
    {
        return checkPermission($user::RESTORE);
    }

    public function forceDelete(User $user): bool
    {
        return checkPermission($user::FORCE_DELETE);
    }
}
