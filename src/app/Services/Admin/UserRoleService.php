<?php
namespace App\Services\Admin;

use App\Repositories\Contracts\UserRoleRepository;
use Exception;
use Illuminate\Support\Facades\DB;
class UserRoleService
{
   protected $userRoleRepository;

   public function __construct(UserRoleRepository $userRoleRepository)
   {
        $this->userRoleRepository = $userRoleRepository;
   }

   public function getPermissionRoleByUserId(int $id)
   {
    try {
        $columns = [
            DB::raw('permissions.*')
        ];
        $result = $this->userRoleRepository->select($columns)
            ->leftJoin('permission_roles', 'permission_roles.role_id', '=', 'user_roles.role_id')
            ->leftJoin('permissions', 'permissions.id', '=', 'permission_roles.permission_id')
            ->whereUserId($id)->get();
    } catch (Exception $ex) {
        // throw new NotFoundException(__('common.not_found'));
    }
    return $result;
   }
}