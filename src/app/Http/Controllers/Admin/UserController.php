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
        $this->data['users'] = $this->userService->getListUserPaginate($param);
        return view('admin.users.list')->with($this->data);
    }

    public function create()
    {
        $this->data['user']  = new User();
        return view('admin.users.create')->with($this->data);
    }

    public function store(UserRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $path = config('const.path.user');
            $fileName = uploadFile($path ,$request->file('avatar'));
            $data['avatar'] = $fileName;
        }
        $this->userService->storeUser($data);
        return redirect()->route('admin.users.list');
    }

    public function permission($id)
    {
        $this->data['user'] = $this->userService->findModelById($id);
        $this->data['permissionUserChecked'] = $this->data['user']->permissions;
        $this->data['permissions'] = $this->permissionService->getAll();
        $this->data['permissionsRoleChecked'] = $this->userRoleService->getPermissionRoleByUserId($id);
        return view('admin.users.permission')->with($this->data);
    }

    public function createPermission(Request $request, $id)
    {
        $param = $request->all();
        $this->userService->createPermission($param, $id);
        return redirect()->route('admin.users.list');
    }

    public function edit($id)
    {
        $this->data['user'] = $this->userService->findModelById($id);
        return view('admin.users.edit')->with($this->data);
    }

    public function update(UserRequest $request, $id)
    {
        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $path = config('const.path.user');
            $fileName = uploadFile($path ,$request->file('avatar'));
            $data['avatar'] = $fileName;
        }
        $this->userService->updateModel($data, $id);
        return redirect()->route('admin.users.list');
    }

    public function delete(Request $request)
    {
        $ids = $request->get('id');
        $this->userService->deleteMultiple($ids);
        return back();
    }

    public function trash()
    {
        $param = [
            'limit' => 10,
        ];
        $this->data['users'] = $this->userService->getListUserTrash($param);
        return view('admin.users.trash')->with($this->data);
    }

    public function forceDelete(Request $request)
    {
        $ids = $request->get('id');
        $this->userService->forceDeleteMultiple($ids);
        return back();
    }

    public function restore(Request $request)
    {
        $ids = $request->get('id');
        $this->userService->restoreMultiple($ids);
        return redirect()->back();
    }

    public function status(Request $request)
    {
        $id = $request->get('id');
        $is_visible = $request->get('is_visible') == config('const.activate.on') ? config('const.activate.off') : config('const.activate.on');
        $param = [
            'is_visible' => $is_visible
        ];
        $this->userService->updateModel($param, $id);
    }
}
