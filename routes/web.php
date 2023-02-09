<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DataController;
 

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

/*Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [App\Http\Controllers\BookSearchController::class, 'index'])->name('getbook');
Route::post('/searchbook', [App\Http\Controllers\BookSearchController::class, 'searchBook'])->name('searchbook');
Route::get('/addbooks', [App\Http\Controllers\DataController::class, 'index'])->name('setbooks');


Auth::routes();

Route::group(array('before' => 'auth'), function() {

    Route::resource('/books', '\App\Http\Controllers\BookController');

});
/*Route::prefix('admin')->namespace('Admin')->group(static function() {

    Route::middleware('auth')->group(static function () {
        //...
        Route::resource('profile', '\App\Http\Controllers\Admin\ProfileController');
    });
}); */

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
