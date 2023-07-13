<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Clients\HomeController;
use App\Http\Controllers\SystemController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/change-language/{lang}', [SystemController::class, 'changeLanguage'])->name('system.language');

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
