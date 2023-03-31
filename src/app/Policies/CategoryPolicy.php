<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
        //
    }

    public function view(): bool
    {
        return checkPermission(Category::VIEW);
    }

    public function create(): bool
    {
        return checkPermission(Category::CREATE);
    }

    public function update(): bool
    {
        return checkPermission(Category::UPDATE);
    }

    public function delete(): bool
    {
        return checkPermission(Category::DELETE);
    }

    public function restore(): bool
    {
        return checkPermission(Category::RESTORE);
    }

    public function forceDelete(): bool
    {
        return checkPermission(Category::FORCE_DELETE);
    }
}
