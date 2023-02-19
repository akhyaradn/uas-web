<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/login', [Controllers\HomeController::class, 'login'])->name('login');
Route::post('/login', [Controllers\UserController::class, 'login'])->name('login.post');

Route::get('/register', [Controllers\UserController::class, 'register'])->name('register');
Route::post('/register', [Controllers\UserController::class, 'registerPost'])->name('register.post');

Route::middleware(['web', 'extra'])->group(function() {
    Route::post('/logout', [Controllers\UserController::class, 'logout'])->name('logout.post');
    Route::get('/', [Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::prefix('users')->group(function() {
        Route::get('/', [Controllers\UserController::class, 'users'])->name('users.users');
        Route::get('/create', [Controllers\UserController::class, 'create'])->name('users.create');
        Route::post('/create', [Controllers\UserController::class, 'createPost'])->name('users.create.post');

        Route::get('/update/{id}', [Controllers\UserController::class, 'update'])->name('users.update');
        Route::post('/update/{id}', [Controllers\UserController::class, 'updatePost'])->name('users.update.post');
        Route::post('delete/{id}', [Controllers\UserController::class, 'deletePost'])->name('users.delete.post');
    });

    Route::prefix('tours')->group(function() {
        Route::get('/', [Controllers\TourController::class, 'tours'])->name('tours.tours');
        Route::get('/create', [Controllers\TourController::class, 'create'])->name('tours.create');
        Route::post('/create', [Controllers\TourController::class, 'createPost'])->name('tours.create.post');

        Route::get('/update/{id}', [Controllers\TourController::class, 'update'])->name('tours.update');
        Route::post('/update/{id}', [Controllers\TourController::class, 'updatePost'])->name('tours.update.post');

        Route::post('delete/{id}', [Controllers\TourController::class, 'deletePost'])->name('tours.delete.post');

        Route::get('/pemesanan/{id}', [Controllers\TourController::class, 'userView'])->name('tours.userView');
    });
});