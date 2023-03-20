<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\UserService;
use App\Services\Admin\PermissionService;
use App\Services\Admin\UserRoleService;

class UserController extends Controller
{
    protected UserService $userService;
    protected PermissionService $permissionService;
    
    protected UserRoleService $userRoleService;

    public function __construct(UserService $userService, PermissionService $permissionService, UserRoleService $userRoleService)
    {
       $this->userService = $userService;
       $this->permissionService = $permissionService;
       $this->userRoleService = $userRoleService;
    }
    public function index(Request $request) 
    {
       $param = [
         'limit' => 10,
       ];
       $users = $this->userService->getListUserPaginate($param);
       return view('admin.users.list', compact('users'));
    }

    public function permission($id)
    {
       $user = $this->userService->getUserById($id);
       $permissionUserChecked = $user->permissions();
       $permissions = $this->permissionService->getAll();
       $permissionsRoleChecked = $this->userRoleService->getPermissionRoleByUserId($id);
       return view('admin.users.permission', compact('user', 'permissionUserChecked', 'permissions', 'permissionsRoleChecked'));
    }
}
