<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\ComponentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;

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
    Route::post('/filter-genre-comic', [PageController::class, 'FilterComicApi']);
});

Route::group(array('prefix' => '/component'), function () {
    Route::get('/header', [ComponentController::class, 'GetHeaderApi']);
    Route::post('/search', [ComponentController::class, 'SearchComic']);
});

Route::group(array('prefix' => '/auth'), function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/comment', [CommentController::class, 'StoreCommentApi']);
Route::get('/comment/get-list/{id}', [CommentController::class, 'GetCommentByComicApi']);
