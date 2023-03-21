<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;

Route::get('/login',[AuthController::class, 'showLogin'])->name('login');
Route::post('/handle-login',[AuthController::class, 'handleLogin'])->name('admin.handle.login');
Route::get('/logout',[AuthController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => ['auth:admin', 'localization']], function() {
    Route::get('/',[DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile',[AuthController::class, 'profile'])->name('admin.profile');

    Route::group(array('prefix' => '/users'), function () {
        Route::get('/',[UserController::class, 'index'])->name('admin.users')->middleware('can:'.App\Models\User::VIEW);
        Route::get('/permission/{id}',[UserController::class, 'permission'])->name('admin.permission');
        Route::post('/permission/{id}',[UserController::class, 'createPermission'])->name('admin.create.permission');

        Route::get('/create',[UserController::class, 'create'])->name('admin.users.create');
        Route::get('/store',[UserController::class, 'store'])->name('admin.users.store');
    });
});
