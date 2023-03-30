<?php
namespace App\Services\Admin;

use App\Repositories\Contracts\UserRepository;
use Illuminate\Http\Request;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
       $this->userRepository = $userRepository;
    }

    public function getListUserPaginate($param)
    {
        $columns = ['*'];
        $result = $this->userRepository->scopeQuery( function($query) use ($param){
            $query->where('role', '!=' , config('const.admin.role.admin'));
            return $query;
        });
        $result->orderBy('id', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function getUserById($id)
    {
        $columns = ['*'];
        return $this->userRepository->find($id, $columns);
    }

    public function createPermission($param, $id)
    {
       $user = $this->getUserById($id);
       $arr = !isset($param['id_permissions']) ? [] : $param['id_permissions'];
       $user->permissions()->sync($arr);
       return $user;
    }

    public function storeUser($data)
    {
        $data['password'] = bcrypt('123456');
        return $this->userRepository->create($data);
    }

    public function updateUser($data ,$id)
    {
        return $this->userRepository->update($data, $id);
    }

    public function deleteUser(array $ids)
    {
        return $this->userRepository->deleteMultiple($ids);
    }

    public function getListUserTrash($param)
    {
        $columns = ['*'];
        $result = $this->userRepository->scopeQuery( function($query) use ($param){
            $query->where('role', '!=' , config('const.admin.role.admin'));
            $query->onlyTrashed();
            return $query;
        });
        $result->orderBy('id', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function forceDeleteUser(array $ids)
    {
        return $this->userRepository->forceDeleteMultiple($ids);
    }

    public function restoreUser(array $ids)
    {
        return $this->userRepository->restoreMultiple($ids);
    }

    public function updateStatus($param ,$id)
    {
        return $this->userRepository->update($param, $id);
    }
}
