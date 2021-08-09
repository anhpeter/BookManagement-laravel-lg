<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\checkAge;
use App\Models\Category;
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

Route::get('/test', function () {
    return View('pages/test');
});

Route::prefix('/admin')->group(function () {

    Route::get('/', [Dashboard::class, 'index']);

    // user
    Route::resource('/users', UserController::class);
    Route::get('/users/status/{id}/{value}', [UserController::class, 'updateStatus'])->name('users.status');

    // profile
    Route::resource('/profiles', ProfileController::class)->except(['index']);

    Route::get('/profiles/{userId}/create', [ProfileController::class, 'createProfile'])->name('create-profile');


    // category
    Route::resource('/categories', CategoryController::class);
    Route::get('/categories/status/{id}/{value}', [CategoryController::class, 'updateStatus'])->name('categories.status');

    // book
    Route::resource('/books', BookController::class);
    Route::get('/books/status/{id}/{value}', [BookController::class, 'updateStatus'])->name('books.status');
});

// CHECK MIDDLEWARE
Route::get('/check-age/{age?}', function () {
    return redirect('/admin');
})->middleware(checkAge::class);

Route::get('/fail', function () {
    return 'Fail!';
});

// DEFAULT
Route::get('/', function () {
    return redirect('/admin');
});
