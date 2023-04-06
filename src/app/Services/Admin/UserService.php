<?php

namespace App\Services\Admin;

use App\Repositories\Contracts\UserRepository;
use App\Services\BaseService;
use Illuminate\Http\Request;

class UserService extends BaseService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct($userRepository);
        $this->userRepository = $userRepository;
    }

    public function getListUserPaginate($param)
    {
        $columns = ['*'];
        $result = $this->userRepository->scopeQuery(function ($query) use ($param) {
            $query->where('role', '!=', config('const.admin.role.admin'));
            return $query;
        });
        $result->orderBy('id', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function createPermission($param, $id)
    {
        $user = parent::findModelById($id);
        $arr = !isset($param['id_permissions']) ? [] : $param['id_permissions'];
        $user->permissions()->sync($arr);
        return $user;
    }

    public function storeUser($data)
    {
        $data['password'] = bcrypt('123456');
        return $this->userRepository->create($data);
    }

    public function getListUserTrash($param)
    {
        $columns = ['*'];
        $result = $this->userRepository->scopeQuery(function ($query) use ($param) {
            $query->where('role', '!=', config('const.admin.role.admin'));
            $query->onlyTrashed();
            return $query;
        });
        $result->orderBy('id', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }
}
