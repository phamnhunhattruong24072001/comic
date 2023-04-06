<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\UserRoleRepository;
use App\Models\UserRole;

/**
 * Class UserRoleRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class UserRoleRepositoryEloquent extends BaseRepository implements UserRoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserRole::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function deleteMultiple(array $ids)
    {
        // TODO: Implement deleteMultiple() method.
    }

    public function forceDeleteMultiple(array $ids)
    {
        // TODO: Implement forceDeleteMultiple() method.
    }

    public function restoreMultiple(array $ids)
    {
        // TODO: Implement restoreMultiple() method.
    }
}
