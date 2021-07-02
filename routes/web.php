<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', 'Admin\HomeController@index')->name('home');

    // Route Post
    Route::get('/post', 'Admin\PostController@index')->name('post');
    Route::get('/post/create', 'Admin\PostController@create')->name('post.create');
    Route::post('/post/store', 'Admin\PostController@store')->name('post.store');
    Route::get('/post/edit/{post}', 'Admin\PostController@edit')->name('post.edit');
    Route::get('/post/show/{post}', 'Admin\PostController@show')->name('post.show');
    Route::put('/post/update/{post}', 'Admin\PostController@update')->name('post.update');
    Route::delete('/post/delete/{post}', 'Admin\PostController@destroy')->name('post.delete');
    Route::get('/post/list', 'Admin\PostController@getPosts')->name('post.list');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::middleware(['auth', 'user'])->get('/home', 'HomeController@index')->name('home');
