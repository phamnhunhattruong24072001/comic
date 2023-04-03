<?php

namespace App\Policies;

use App\Models\Chapter;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChapterPolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {

    }

    public function view(): bool
    {
        return checkPermission(Chapter::VIEW);
    }

    public function create(): bool
    {
        return checkPermission(Chapter::CREATE);
    }

    public function update(): bool
    {
        return checkPermission(Chapter::UPDATE);
    }

    public function delete(): bool
    {
        return checkPermission(Chapter::DELETE);
    }

    public function restore(): bool
    {
        return checkPermission(Chapter::RESTORE);
    }

    public function forceDelete(): bool
    {
        return checkPermission(Chapter::FORCE_DELETE);
    }
}
