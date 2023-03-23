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
        $columns = [
            'users.name',
            'users.username',
            'users.email',
            'users.day_of_birth',
            'users.avatar',
            'users.role',
            'users.is_visible',
         ];
        $result = $this->userRepository->scopeQuery( function($query) use ($param){
            return $query;
        });
        $result->orderBy('id', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function getUserById($id)
    {
        $columns = [
            'users.name',
            'users.username',
            'users.email',
            'users.day_of_birth',
            'users.avatar',
            'users.role',
            'users.is_visible',
        ];
        return $this->userRepository->find($id, $columns);
    }

    public function createPermission($param, $id)
    {
       $user = $this->getUserById($id);
       $user->permissions()->sync($param['id_permissions']);
       return $user;
    }

    public function store($data)
    {
        $data['password'] = bcrypt('123456');
        return $this->userRepository->create($data);
    }

    public function update($data ,$id)
    {
        return $this->userRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }
}
