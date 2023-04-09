<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\ChapterController;
use App\Http\Controllers\Api\ComicController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/country/get-list', [CountryController::class, 'getList']);
Route::get('/category/get-list', [CategoryController::class, 'getList']);
Route::get('/genre/get-list', [GenreController::class, 'getList']);

Route::group(array('prefix' => '/comic'), function () {
    Route::get('/get-list-new', [ComicController::class, 'HomePageApi']);
    Route::get('/detail/{slug}', [ComicController::class, 'DetailComicApi']);
});
