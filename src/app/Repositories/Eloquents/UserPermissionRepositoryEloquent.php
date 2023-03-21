<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\UserPermissionRepository;
use App\Models\UserPermission;
use App\Validators\UserPermissionValidator;

/**
 * Class UserPermissionRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class UserPermissionRepositoryEloquent extends BaseRepository implements UserPermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserPermission::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
