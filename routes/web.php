<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/user/search', [HomeController::class, 'userSearch'])->name('user.search');

    // User Routes
    Route::group(['as' => 'user.', 'controller' => UserController::class, 'prefix' => 'user'], function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::get('/profile/edit', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
    });

    // Search Result
    Route::get('/user/{username}', [UserController::class, 'searchedResult']);

    // Post Routes
    Route::resource('posts', PostController::class)->only(['store', 'update', 'destroy']);

    Route::post('logout', LogoutController::class)->name('logout');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('register', [RegistrationController::class, 'index'])->name('register');
    Route::post('register', [RegistrationController::class, 'store']);
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});
