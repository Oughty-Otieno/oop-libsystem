<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', 'App\Http\Controllers\RoleController');
    Route::resource('users', 'App\Http\Controllers\UserController');
    Route::resource('categories', 'App\Http\Controllers\CategoryController');
    Route::resource('books', 'App\Http\Controllers\BookController');
    Route::resource('borrows', 'App\Http\Controllers\BorrowingController');
    Route::get('borrow/{borrow_id}/clear', 'App\Http\Controllers\BorrowingController@clearBorrow')->name('borrow.clear');
});

require __DIR__.'/auth.php';
