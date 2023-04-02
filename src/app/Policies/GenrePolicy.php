<?php

namespace App\Policies;

use App\Models\Genre;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GenrePolicy
{
    use HandlesAuthorization;
    public function viewAny()
    {
        //
    }

    public function view()
    {
        return checkPermission(Genre::VIEW);
    }

    public function create()
    {
        return checkPermission(Genre::CREATE);
    }

    public function update()
    {
        return checkPermission(Genre::UPDATE);
    }

    public function delete()
    {
        return checkPermission(Genre::DELETE);
    }

    public function restore()
    {
        return checkPermission(Genre::RESTORE);
    }

    public function forceDelete()
    {
        return checkPermission(Genre::FORCE_DELETE);
    }
}
