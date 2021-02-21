<?php
namespace App\Http\Controllers;
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

Route::redirect('/','/books');

Route::get('/books', [BookController::class, 'index'])->name('home.index');

Route::get('/books/{id}', [BookController::class, 'show'])->name('home.show');

Route::get('/search', [SearchBarController::class, 'index'])->name('searchBar.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
	return view('dashboard');
})->name('dashboard');




Route::group(['middleware' => 'auth'], function(){

	Route::get('redirects', 'App\Http\Controllers\HomeController@index');


	Route::group(['middleware' =>'role:admin','prefix'=>'admin','as'=>'admin.'],function(){
	//Route::resource('',\App\Http\Controllers\Admin\AdminHomeController::class);

		Route::resource('users',Admin\AdminManageUsersController::class);

		Route::resource('books',Admin\AdminBooksController::class);

		Route::get('', [Admin\AdminHomeController::class, 'index'])->name('home.index');

		Route::post('books/{id}/status', [Admin\AdminBooksStatusController::class, 'update'])->name('BooksStatus.update');


	});
	Route::group(['middleware'=>'role:user','prefix'=>'user','as'=>'user.'],function(){
	//Route::resource('',\App\Http\Controllers\User\UserHomeController::class);
		Route::resource('books',User\UserBooksController::class);

		Route::get('books/{id}/report',[User\BooksReportController::class, 'index'])->name('BooksReport.index');

		Route::post('books/{id}/report',[User\BooksReportController::class, 'send'])->name('BooksReport.send');


	});







});