<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::prefix('/admin')->middleware('auth')->group(function () {

    Route::get('/', [Dashboard::class, 'index']);

    // profile
    Route::prefix('/')->middleware('owner')->group(function () {
        Route::resource('/profiles', ProfileController::class)->except(['index']);
        Route::get('/profiles/{userId}/create', [ProfileController::class, 'createProfile'])->name('create-profile');
    });
    Route::prefix('/')->middleware('permission:admin')->group(function () {
        // user
        Route::resource('/users', UserController::class);
        Route::get('/users/status/{id}/{value}', [UserController::class, 'updateStatus'])->name('users.status');


        // group
        Route::resource('/groups', GroupController::class);
        Route::get('/groups/status/{id}/{value}', [GroupController::class, 'updateStatus'])->name('groups.status');
    });


    // category
    Route::resource('/categories', CategoryController::class);
    Route::get('/categories/status/{id}/{value}', [CategoryController::class, 'updateStatus'])->name('categories.status');

    // book
    Route::resource('/books', BookController::class);
    Route::get('/books/status/{id}/{value}', [BookController::class, 'updateStatus'])->name('books.status');
});

// DEFAULT
Route::get('/', function () {
    return redirect('/admin');
});

// AUTH
Auth::routes();

// HOME
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
