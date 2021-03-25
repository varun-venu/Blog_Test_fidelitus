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
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentsController;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::get('test', function(){
	return view('posts');
});


Route::resource('posts', PostController::class);
Route::middleware('auth')->group(function(){
	Route::get('create-post', [PostController::class, 'postAddForm'])->name('posts.postform');
	Route::post('store-comment', [CommentsController::class, 'store'])->name('comments.store');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
