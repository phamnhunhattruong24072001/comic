<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Admin\UserService;
use App\Services\Admin\PermissionService;
use App\Services\Admin\UserRoleService;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    protected $userService;
    protected $permissionService;

    protected $userRoleService;

    public function __construct(
        UserService $userService,
        PermissionService $permissionService,
        UserRoleService $userRoleService
    ) {
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

    public function create()
    {
        $user  = new User();
        return view('admin.users.create', compact('user'));
    }

    public function store(UserRequest $request)
    {
        $data = $request->all();
        $this->userService->store($data);
        return redirect()->route('admin.users');
    }

    public function permission($id)
    {
        $user = $this->userService->getUserById($id);
        $permissionUserChecked = $user->permissions();
        $permissions = $this->permissionService->getAll();
        $permissionsRoleChecked = $this->userRoleService->getPermissionRoleByUserId($id);
        return view('admin.users.permission',
            compact('user', 'permissionUserChecked', 'permissions', 'permissionsRoleChecked'));
    }

    public function createPermission(Request $request, $id)
    {
        $param = $request->all();
        $this->userService->createPermission($param, $id);
        return redirect()->route('admin.users');
    }

    public function edit($id)
    {
        $user = $this->userService->getUserById($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->userService->update($data, $id);
        return redirect()->route('admin.users');
    }

    public function delete($id)
    {
        $this->userService->delete($id);
        return redirect()->back();
    }
}
