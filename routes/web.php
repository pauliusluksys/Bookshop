<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

use App\Http\Resources\BookResource;
use App\Http\Resources\BookCollection;

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
Route::get('/api/v1/books',[Api\v1\BookController::class, 'index']);

Route::get('/api/v1/books/{book}',[Api\v1\BookController::class, 'show']);



Route::redirect('/','/books');
Route::get('/books', [BookController::class, 'index'])->name('home.index');

Route::get('/books/{id}', [BookController::class, 'show'])->name('home.show');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
	return view('dashboard');
})->name('dashboard');




Route::group(['middleware' => 'auth'], function(){

	Route::get('redirects', 'App\Http\Controllers\HomeController@index');

	Route::group(['middleware' =>'role:admin','prefix'=>'admin','as'=>'admin.'],function(){
	//Route::resource('',\App\Http\Controllers\Admin\AdminHomeController::class);

		Route::resource('users',Admin\AdminManageUsersController::class);
		Route::resource('books',Admin\AdminBooksController::class);
		Route::redirect('','/books');
		Route::post('books/{id}/status', [Admin\AdminBooksStatusController::class, 'update'])->name('BooksStatus.update');

	});
	Route::group(['middleware'=>'role:user','prefix'=>'user','as'=>'user.'],function(){

		Route::resource('books',User\UserBooksController::class);

		Route::post('books/{id}/report',[User\BooksReportController::class, 'send'])->name('BooksReport.send');

	});

});
