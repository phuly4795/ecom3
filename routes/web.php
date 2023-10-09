<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\UserController;
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

Route::prefix('/admin')->group(function(){
    Route::middleware('Authenticate')->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');  
        Route::get('/user', [UserController::class, 'index'])->name('user');  
    });
   

    Route::get('/login', [AuthController::class, 'index'])->name('login');    
    Route::post('/login', [AuthController::class, 'login'])->name('login');    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');    
    
});


