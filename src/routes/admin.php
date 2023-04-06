<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\ComicController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\ResponseController;

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
        Route::post('/force-delete', [UserController::class, 'forceDelete'])->name('force-delete')->middleware('can:' . App\Models\User::FORCE_DELETE);
        Route::post('/restore', [UserController::class, 'restore'])->name('restore')->middleware('can:' . App\Models\User::RESTORE);
        Route::post('/status', [UserController::class, 'status'])->name('status');

        // Permission
        Route::get('/permission/{id}', [UserController::class, 'permission'])->name('permission');
        Route::post('/permission/{id}', [UserController::class, 'createPermission'])->name('create_permission');
    });

    // Country
    Route::group(array('prefix' => '/country', 'as' => 'country.'), function () {
        Route::get('/', [CountryController::class, 'index'])->name('list')->middleware('can:' . App\Models\Country::VIEW);
        Route::get('/create', [CountryController::class, 'create'])->name('create')->middleware('can:' . App\Models\Country::CREATE);
        Route::post('/store', [CountryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CountryController::class, 'edit'])->name('edit')->middleware('can:' . App\Models\Country::UPDATE);
        Route::post('/update/{id}', [CountryController::class, 'update'])->name('update');
        Route::post('/delete', [CountryController::class, 'delete'])->name('delete')->middleware('can:' . App\Models\Country::DELETE);
        Route::get('/trash', [CountryController::class, 'trash'])->name('trash');
        Route::post('/force-delete', [CountryController::class, 'forceDelete'])->name('force-delete')->middleware('can:' . App\Models\Country::FORCE_DELETE);
        Route::post('/restore', [CountryController::class, 'restore'])->name('restore')->middleware('can:' . App\Models\Country::RESTORE);
        Route::post('/status', [CountryController::class, 'status'])->name('status');
    });

    // Category
    Route::group(array('prefix' => '/category', 'as' => 'category.'), function () {
        Route::get('/', [CategoryController::class, 'index'])->name('list')->middleware('can:' . App\Models\Category::VIEW);
        Route::get('/create', [CategoryController::class, 'create'])->name('create')->middleware('can:' . App\Models\Category::CREATE);
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit')->middleware('can:' . App\Models\Category::UPDATE);
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::post('/delete', [CategoryController::class, 'delete'])->name('delete')->middleware('can:' . App\Models\Category::DELETE);
        Route::get('/trash', [CategoryController::class, 'trash'])->name('trash');
        Route::post('/force-delete', [CategoryController::class, 'forceDelete'])->name('force-delete')->middleware('can:' . App\Models\Category::FORCE_DELETE);
        Route::post('/restore', [CategoryController::class, 'restore'])->name('restore')->middleware('can:' . App\Models\Category::RESTORE);
        Route::post('/status', [CategoryController::class, 'status'])->name('status');
    });

    // Genre
    Route::group(array('prefix' => '/genre', 'as' => 'genre.'), function () {
        Route::get('/', [GenreController::class, 'index'])->name('list')->middleware('can:' . App\Models\Genre::VIEW);
        Route::get('/create', [GenreController::class, 'create'])->name('create')->middleware('can:' . App\Models\Genre::CREATE);
        Route::post('/store', [GenreController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [GenreController::class, 'edit'])->name('edit')->middleware('can:' . App\Models\Genre::UPDATE);
        Route::post('/update/{id}', [GenreController::class, 'update'])->name('update');
        Route::post('/delete', [GenreController::class, 'delete'])->name('delete')->middleware('can:' . App\Models\Genre::DELETE);
        Route::get('/trash', [GenreController::class, 'trash'])->name('trash');
        Route::post('/force-delete', [GenreController::class, 'forceDelete'])->name('force-delete')->middleware('can:' . App\Models\Genre::FORCE_DELETE);
        Route::post('/restore', [GenreController::class, 'restore'])->name('restore')->middleware('can:' . App\Models\Genre::RESTORE);
        Route::post('/status', [GenreController::class, 'status'])->name('status');
    });

    // Comic
    Route::group(array('prefix' => '/comic', 'as' => 'comic.'), function () {
        Route::get('/', [ComicController::class, 'index'])->name('list')->middleware('can:' . App\Models\Comic::VIEW);
        Route::get('/create', [ComicController::class, 'create'])->name('create')->middleware('can:' . App\Models\Comic::CREATE);
        Route::post('/store', [ComicController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ComicController::class, 'edit'])->name('edit')->middleware('can:' . App\Models\Comic::UPDATE);
        Route::post('/update/{id}', [ComicController::class, 'update'])->name('update');
        Route::post('/delete', [ComicController::class, 'delete'])->name('delete')->middleware('can:' . App\Models\Comic::DELETE);
        Route::get('/trash', [ComicController::class, 'trash'])->name('trash');
        Route::post('/force-delete', [ComicController::class, 'forceDelete'])->name('force-delete')->middleware('can:' . App\Models\Comic::FORCE_DELETE);
        Route::post('/restore', [ComicController::class, 'restore'])->name('restore')->middleware('can:' . App\Models\Comic::RESTORE);
        Route::post('/status', [ComicController::class, 'status'])->name('status');
    });

    // Chapter
    Route::group(array('prefix' => '/chapter', 'as' => 'chapter.'), function () {
        Route::get('/list/{any?}', [ChapterController::class, 'index'])->name('list')->middleware('can:' . App\Models\Comic::VIEW);
        Route::get('/create/{any?}', [ChapterController::class, 'create'])->name('create')->middleware('can:' . App\Models\Comic::CREATE);
        Route::post('/store', [ChapterController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ChapterController::class, 'edit'])->name('edit')->middleware('can:' . App\Models\Comic::UPDATE);
        Route::post('/update/{id}', [ChapterController::class, 'update'])->name('update');
        Route::post('/delete', [ChapterController::class, 'delete'])->name('delete')->middleware('can:' . App\Models\Comic::DELETE);
        Route::get('/trash', [ChapterController::class, 'trash'])->name('trash');
        Route::post('/force-delete', [ChapterController::class, 'forceDelete'])->name('force-delete')->middleware('can:' . App\Models\Comic::FORCE_DELETE);
        Route::post('/restore', [ChapterController::class, 'restore'])->name('restore')->middleware('can:' . App\Models\Comic::RESTORE);
        Route::post('/status', [ChapterController::class, 'update'])->name('status');
        Route::get('/edit-image/{id}', [ChapterController::class, 'editImage'])->name('edit_image');
        Route::post('/update-image/{id}', [ChapterController::class, 'updateImage'])->name('update_image');
    });

    // Response
    Route::group(array('prefix' => '/response', 'as' => 'response.'), function () {
        Route::post('/get-category', [ResponseController::class, 'getCategory'])->name('get_category');
        Route::post('/get-genre', [ResponseController::class, 'getGenre'])->name('get_genre');
        Route::post('/check-type-comic', [ResponseController::class, 'checkTypeComic'])->name('check_type_comic');
    });
});
