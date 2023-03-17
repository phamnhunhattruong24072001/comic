<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Clients\HomeController;

Route::get('/', [HomeController::class, 'index']);