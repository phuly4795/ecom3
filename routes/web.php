<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LanguageController;
use App\Http\Controllers\admin\UserCatalogueController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\ajax\LocationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->group(function () {
    Route::middleware('Authenticate')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('/user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('user');
            Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
            Route::post('/create-user', [UserController::class, 'store'])->name('user.store');
            Route::get('/update-user/{id}', [UserController::class, 'edit'])->where(['id' => '[0-9]+'])->name('user.edit');
            Route::put('/update-user/{id}', [UserController::class, 'update'])->where(['id' => '[0-9]+'])->name('user.update');
            Route::delete('/delete-user/{id}', [UserController::class, 'delete'])->where(['id' => '[0-9]+'])->name('user.delete');
            Route::get('/update-status-user', [UserController::class, 'updateStatus'])->name('user.updateStatus');
            Route::get('/update-status-multiple', [UserController::class, 'updateStatusMultiple'])->name('user.updateStatusMultiple');
        });

        Route::prefix('/user-catalogue')->group(function () {
            Route::get('/', [UserCatalogueController::class, 'index'])->name('user.catalogue');
            Route::get('/create-user', [UserCatalogueController::class, 'create'])->name('user.catalogue.create');
            Route::post('/create-user', [UserCatalogueController::class, 'store'])->name('user.catalogue.store');
            Route::get('/update-user/{id}', [UserCatalogueController::class, 'edit'])->where(['id' => '[0-9]+'])->name('user.catalogue.edit');
            Route::put('/update-user/{id}', [UserCatalogueController::class, 'update'])->where(['id' => '[0-9]+'])->name('user.catalogue.update');
            Route::delete('/delete-user/{id}', [UserCatalogueController::class, 'delete'])->where(['id' => '[0-9]+'])->name('user.catalogue.delete');
            Route::get('/update-status-user', [UserCatalogueController::class, 'updateStatus'])->name('user.catalogue.updateStatus');
            Route::get('/update-status-multiple', [UserCatalogueController::class, 'updateStatusMultiple'])->name('user.catalogue.updateStatusMultiple');
        });

        Route::prefix('/post')->group(function () {
            Route::get('/', [UserCatalogueController::class, 'index'])->name('post');
            Route::get('/create-user', [UserCatalogueController::class, 'create'])->name('post.create');
            Route::post('/create-user', [UserCatalogueController::class, 'store'])->name('post.store');
            Route::get('/update-user/{id}', [UserCatalogueController::class, 'edit'])->where(['id' => '[0-9]+'])->name('post.edit');
            Route::put('/update-user/{id}', [UserCatalogueController::class, 'update'])->where(['id' => '[0-9]+'])->name('post.update');
            Route::delete('/delete-user/{id}', [UserCatalogueController::class, 'delete'])->where(['id' => '[0-9]+'])->name('post.delete');
            Route::get('/update-status-user', [UserCatalogueController::class, 'updateStatus'])->name('post.updateStatus');
            Route::get('/update-status-multiple', [UserCatalogueController::class, 'updateStatusMultiple'])->name('post.updateStatusMultiple');
        });

        Route::prefix('/language')->group(function () {
            Route::get('/', [LanguageController::class, 'index'])->name('language');
            Route::get('/create-language', [LanguageController::class, 'create'])->name('language.create');
            Route::post('/create-language', [LanguageController::class, 'store'])->name('language.store');
            Route::get('/update-language/{id}', [LanguageController::class, 'edit'])->where(['id' => '[0-9]+'])->name('language.edit');
            Route::put('/update-language/{id}', [LanguageController::class, 'update'])->where(['id' => '[0-9]+'])->name('language.update');
            Route::delete('/delete-language/{id}', [LanguageController::class, 'delete'])->where(['id' => '[0-9]+'])->name('language.delete');
            Route::get('/update-status-language', [LanguageController::class, 'updateStatus'])->name('language.updateStatus');
            Route::get('/update-status-multiple', [LanguageController::class, 'updateStatusMultiple'])->name('language.updateStatusMultiple');
        });
    });


    Route::get('/login', [AuthController::class, 'index'])->name('login.index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::prefix('/ajax')->group(function () {
    Route::get('/location/getLocation', [LocationController::class, 'getLocation'])->name('getLocation');
});
