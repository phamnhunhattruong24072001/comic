<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\AuthRequest;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
           return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function handleLogin(AuthRequest $request)
    {
       $dataLogin = array_merge($request->only(['email', 'password']), ['is_visible' => config('const.admin.status.active')]);
       if (Auth::guard('admin')->attempt($dataLogin)) {
            return redirect()->route('admin.dashboard');
       }
       return redirect()->back()->with('error', 'Email or Password is not true');
    }

    public function profile()
    {
        return view('admin.auth.profile');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
