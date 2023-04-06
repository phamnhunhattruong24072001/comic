<?php

namespace App\Policies;

use App\Models\Figure;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FigurePolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {

    }

    public function view(): bool
    {
        return checkPermission(Figure::VIEW);
    }

    public function create(): bool
    {
        return checkPermission(Figure::CREATE);
    }

    public function update(): bool
    {
        return checkPermission(Figure::UPDATE);
    }

    public function delete(): bool
    {
        return checkPermission(Figure::DELETE);
    }

    public function restore(): bool
    {
        return checkPermission(Figure::RESTORE);
    }

    public function forceDelete(): bool
    {
        return checkPermission(Figure::FORCE_DELETE);
    }
}
