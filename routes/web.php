<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\checkAge;
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
    Route::get('/', function () {
        return view('pages/home');
    });

    Route::resource('/users', UserController::class);

    //Route::get('/user', function () {
    //$items = DB::table('users')->get();
    //return view('pages/user/index', ['items' => $items, 'controller' => 'user']);
    //});

    Route::get('/book', function () {
        return view('pages/book/index');
    });
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
