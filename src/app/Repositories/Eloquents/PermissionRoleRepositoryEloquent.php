<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\PermissionRoleRepository;
use App\Models\PermissionRole;
use App\Validators\PermissionRoleValidator;

/**
 * Class PermissionRoleRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class PermissionRoleRepositoryEloquent extends BaseRepository implements PermissionRoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PermissionRole::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
