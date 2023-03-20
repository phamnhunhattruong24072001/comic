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

    public function getListUserPaginate(array $param)
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
            $query->where('users.is_visible', 1);
            return $query;
        });
        $result->orderBy('id', 'DESC');
        return $result->paginate($param['limit'], $columns);
    }

    public function getUserById($id)
    {
        $columns = [
            'users.id',
            'users.name',
            'users.role',
            'users.is_visible',
        ];
        $result = $this->userRepository->select($columns)->findOrFail($id);
        return $result;
    }
}