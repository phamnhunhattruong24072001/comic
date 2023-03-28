<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('checkPermission')) {
    function checkPermission($permissionCheck): bool
    {
        if (Auth::guard('admin')->user()->role == 'admin') {
            return true;
        }
        $roles = auth()->user()->roles;
        foreach ($roles as $role) {
            $permissions = $role->permissions;
            $userPermission = auth()->user()->permissions;
            if ($permissions->contains('key_code', $permissionCheck)) {
                return true;
            }
            if ($userPermission->contains('key_code', $permissionCheck)) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('is_admin')) {
    function is_admin(): bool
    {
        if(Auth::guard('admin')->user()->role == config('const.admin.role.admin')) {
            return true;
        }
        return false;
    }
}

