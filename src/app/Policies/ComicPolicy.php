<?php

namespace App\Policies;

use App\Models\Comic;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComicPolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {

    }

    public function view(): bool
    {
        return checkPermission(Comic::VIEW);
    }

    public function create(): bool
    {
        return checkPermission(Comic::CREATE);
    }

    public function update(): bool
    {
        return checkPermission(Comic::UPDATE);
    }

    public function delete(): bool
    {
        return checkPermission(Comic::DELETE);
    }

    public function restore(): bool
    {
        return checkPermission(Comic::RESTORE);
    }

    public function forceDelete(): bool
    {
        return checkPermission(Comic::FORCE_DELETE);
    }
}
