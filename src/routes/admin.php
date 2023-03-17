<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;



Route::get('/login',[AuthController::class, 'showLogin'])->name('login');
Route::post('/handle-login',[AuthController::class, 'handleLogin'])->name('admin.handle.login');
Route::get('/logout',[AuthController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => ['auth:admin']], function() {
    Route::get('/',[DashboardController::class, 'index'])->name('admin.dashboard');
});
