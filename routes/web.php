<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::group(['middleware' => 'auth'], function(){
	Route::get('redirects', 'App\Http\Controllers\HomeController@index');

	Route::group(['middleware' =>'role:admin','prefix'=>'admin','as'=>'admin.'],function(){
		//Route::resource('',\App\Http\Controllers\Admin\AdminHomeController::class);
		Route::get('', [\App\Http\Controllers\Admin\AdminHomeController::class, 'index'])->name('home.index');

		Route::post('books/{id}/status', [\App\Http\Controllers\Admin\AdminBooksStatusController::class, 'update'])->name('BooksStatus.update');

		Route::resource('books',\App\Http\Controllers\Admin\AdminBooksController::class);
	});
	Route::group(['middleware'=>'role:user','prefix'=>'user','as'=>'user.'],function(){
		//Route::resource('',\App\Http\Controllers\User\UserHomeController::class);
		Route::get('', [\App\Http\Controllers\User\UserHomeController::class, 'index'])->name('home.index');

		Route::resource('books',\App\Http\Controllers\User\UserBooksController::class);

	});





});