<?php

namespace App\Policies;

use App\Models\Country;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
{
    use HandlesAuthorization;

    public function viewAny(): bool
    {
        return true;
    }

    public function view(): bool
    {
        return checkPermission(Country::VIEW);
    }

    public function create(): bool
    {
        return checkPermission(Country::CREATE);
    }
    public function update(): bool
    {
        return checkPermission(Country::UPDATE);
    }

    public function delete(): bool
    {
        return checkPermission(Country::DELETE);
    }

    public function restore(): bool
    {
        return checkPermission(Country::RESTORE);
    }

    public function forceDelete(): bool
    {
        return checkPermission(Country::FORCE_DELETE);
    }
}
