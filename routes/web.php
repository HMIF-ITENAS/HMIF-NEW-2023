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

    // Route Tag
    Route::get('/tag', 'Admin\TagController@index')->name('tag');
    Route::get('/tag/create', 'Admin\TagController@create')->name('tag.create');
    Route::post('/tag/store', 'Admin\TagController@store')->name('tag.store');
    Route::get('/tag/edit/{tag}', 'Admin\TagController@edit')->name('tag.edit');
    Route::get('/tag/show/{tag}', 'Admin\TagController@show')->name('tag.show');
    Route::put('/tag/update/{tag}', 'Admin\TagController@update')->name('tag.update');
    Route::delete('/tag/delete/{tag}', 'Admin\TagController@destroy')->name('tag.delete');
    Route::get('/tag/list', 'Admin\TagController@getTags')->name('tag.list');

    // Route Internal Aspiration
    Route::prefix('aspiration')->name('aspiration.')->group(function () {
        Route::get('/internal', 'Admin\InternalAspirationController@index')->name('internal');
        Route::get('/internal/create', 'Admin\InternalAspirationController@create')->name('internal.create');
        Route::get('/internal/show/{aspiration}', 'Admin\InternalAspirationController@show')->name('internal.show');
        Route::post('/internal/store', 'Admin\InternalAspirationController@store')->name('internal.store');
        Route::get('/internal/edit/{aspiration}', 'Admin\InternalAspirationController@edit')->name('internal.edit');
        Route::put('/internal/update/{id}', 'Admin\InternalAspirationController@update')->name('internal.update');
        Route::delete('/internal/delete/{id}', 'Admin\InternalAspirationController@destroy')->name('internal.delete');
        Route::get('/internal/list', 'Admin\InternalAspirationController@getAspirations')->name('internal.list');
    });

    // Route External Aspiration
    Route::prefix('aspiration')->name('aspiration.')->group(function () {
        Route::get('/external', 'Admin\ExternalAspirationController@index')->name('external');
        Route::get('/external/create', 'Admin\ExternalAspirationController@create')->name('external.create');
        Route::get('/external/show/{aspiration}', 'Admin\ExternalAspirationController@show')->name('external.show');
        Route::post('/external/store', 'Admin\ExternalAspirationController@store')->name('external.store');
        Route::get('/external/edit/{aspiration}', 'Admin\ExternalAspirationController@edit')->name('external.edit');
        Route::put('/external/update/{id}', 'Admin\ExternalAspirationController@update')->name('external.update');
        Route::delete('/external/delete/{id}', 'Admin\ExternalAspirationController@destroy')->name('external.delete');
        Route::get('/external/list', 'Admin\ExternalAspirationController@getAspirations')->name('external.list');
    });
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::middleware(['auth', 'user'])->get('/home', 'HomeController@index')->name('home');
