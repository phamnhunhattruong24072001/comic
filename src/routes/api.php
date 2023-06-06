<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\ComponentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ClientController;

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


Route::group(array('prefix' => '/page'), function () {
    Route::get('/home-page', [PageController::class, 'HomePageApi']);
    Route::get('/right-content', [PageController::class, 'RightContentApi']);
    Route::get('/detail-page/{slug}', [PageController::class, 'DetailPageApi']);
    Route::get('/read-page/{slug}/{slug_chapter}', [PageController::class, 'ViewChapterPageApi']);
    Route::get('/genre-comic/{any?}', [PageController::class, 'GenrePageApi']);
    Route::get('/country-comic/{any?}', [PageController::class, 'CountryPageApi']);
    Route::get('/category-comic/{any?}', [PageController::class, 'CategoryPageApi']);
    Route::get('/all-comic', [PageController::class, 'GetAllComicApi']);
    Route::post('/filter-genre-comic', [PageController::class, 'FilterComicApi']);
});

Route::group(array('prefix' => '/component'), function () {
    Route::get('/header', [ComponentController::class, 'GetHeaderApi']);
    Route::post('/search', [ComponentController::class, 'SearchComic']);
});

Route::group(array('prefix' => '/auth'), function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.api');
});

Route::group(array('prefix' => '/client'), function () {
    Route::post('/add-favorite', [ClientController::class, 'addFavoriteApi'])->middleware('auth.api');
    Route::post('/remove-favorite', [ClientController::class, 'removeFavoriteApi'])->middleware('auth.api');
    Route::get('/get-list-favorite/{id}', [ClientController::class, 'getListComicFavoriteApi'])->middleware('auth.api');
    Route::get('/check-favorite/{clientId}/{slug}', [ClientController::class, 'checkFavoriteApi'])->middleware('auth.api');
    Route::post('/add-follow', [ClientController::class, 'addFollowApi'])->middleware('auth.api');
    Route::post('/remove-follow', [ClientController::class, 'removeFollowApi'])->middleware('auth.api');
    Route::get('/get-list-follow/{id}', [ClientController::class, 'getListComicFollowApi'])->middleware('auth.api');
    Route::get('/check-follow/{clientId}/{slug}', [ClientController::class, 'checkFollowApi'])->middleware('auth.api');
});

Route::post('/comment', [CommentController::class, 'StoreCommentApi'])->middleware('auth.api');
Route::get('/comment/get-list/{id}', [CommentController::class, 'GetCommentByComicApi']);
