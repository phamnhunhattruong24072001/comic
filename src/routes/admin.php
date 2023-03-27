<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/handle-login', [AuthController::class, 'handleLogin'])->name('admin.handle.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::group(array('middleware' => ['auth:admin', 'localization'], 'as' => 'admin.'), function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    Route::group(array('prefix' => '/users', 'as' => 'users.'), function () {
        Route::get('/', [UserController::class, 'index'])->name('list')->middleware('can:' . App\Models\User::VIEW);
        Route::get('/create', [UserController::class, 'create'])->name('create')->middleware('can:' . App\Models\User::CREATE);
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit')->middleware('can:' . App\Models\User::UPDATE);
        Route::post('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::post('/delete', [UserController::class, 'delete'])->name('delete')->middleware('can:' . App\Models\User::DELETE);
        Route::get('/trash', [UserController::class, 'trash'])->name('trash');
        Route::post('/force-delete', [UserController::class, 'forceDelete'])->name('force-delete');
        Route::post('/restore', [UserController::class, 'restore'])->name('restore');
        Route::post('/status', [UserController::class, 'status'])->name('status');
        // Permission
        Route::get('/permission/{id}', [UserController::class, 'permission'])->name('permission');
        Route::post('/permission/{id}', [UserController::class, 'createPermission'])->name('create_permission');
    });
});
