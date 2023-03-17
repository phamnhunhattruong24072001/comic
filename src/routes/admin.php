<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;

Route::get('/',[DashboardController::class, 'index']);

Route::get('/login',[AuthController::class, 'showLogin']);
