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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', 'Admin\HomeController@index')->name('home');

    // Route Users
    Route::get('/users', 'Admin\UsersController@index')->name('users');
    Route::get('/users/list', 'Admin\UsersController@getUsers')->name('users.list');
    Route::get('/users/create', 'Admin\UsersController@create')->name('users.create');
    Route::get('/users/edit/{user}', 'Admin\UsersController@edit')->name('users.edit');
    Route::get('/users/show/{user}', 'Admin\UsersController@show')->name('users.show');
    Route::post('/users/store', 'Admin\UsersController@store')->name('users.store');
    Route::put('/users/update/{user}', 'Admin\UsersController@update')->name('users.update');
    Route::delete('/users/delete/{user}', 'Admin\UsersController@destroy')->name('users.delete');

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

    // Route kategori 
    // ........

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

    // Route Album
    Route::get('/album', 'Admin\AlbumController@index')->name('album');
    Route::get('/album/create', 'Admin\AlbumController@create')->name('album.create');
    Route::post('/album/store', 'Admin\AlbumController@store')->name('album.store');
    Route::get('/album/edit/{album}', 'Admin\AlbumController@edit')->name('album.edit');
    Route::get('/album/show/{album}', 'Admin\AlbumController@show')->name('album.show');
    Route::put('/album/update/{album}', 'Admin\AlbumController@update')->name('album.update');
    Route::delete('/album/delete/{album}', 'Admin\AlbumController@destroy')->name('album.delete');
    Route::get('/album/list', 'Admin\AlbumController@getAlbums')->name('album.list');

    // Route Photo
    Route::get('/photo', 'Admin\PhotoController@index')->name('photo');
    Route::get('/photo/create/{album}', 'Admin\PhotoController@create')->name('photo.create');
    Route::post('/photo/store', 'Admin\PhotoController@store')->name('photo.store');
    Route::get('/photo/edit/{photo}', 'Admin\PhotoController@edit')->name('photo.edit');
    Route::delete('/photo/delete/{photo}', 'Admin\PhotoController@destroy')->name('photo.delete');

    // Route Meeting Category
    Route::get('/meeting_category', 'Admin\MeetingCategoryController@index')->name('meeting_category');
    Route::get('/meeting_category/create', 'Admin\MeetingCategoryController@create')->name('meeting_category.create');
    Route::post('/meeting_category/store', 'Admin\MeetingCategoryController@store')->name('meeting_category.store');
    Route::get('/meeting_category/edit/{id}', 'Admin\MeetingCategoryController@edit')->name('meeting_category.edit');
    Route::put('/meeting_category/update/{id}', 'Admin\MeetingCategoryController@update')->name('meeting_category.update');
    Route::delete('/meeting_category/delete/{id}', 'Admin\MeetingCategoryController@destroy')->name('meeting_category.delete');
    Route::get('/meeting_category/list', 'Admin\MeetingCategoryController@getMeetingCategory')->name('meeting_category.list');

    // Route Meeting 
    Route::get('/meeting', 'Admin\MeetingController@index')->name('meeting');
    Route::get('/meeting/create', 'Admin\MeetingController@create')->name('meeting.create');
    Route::post('/meeting/store', 'Admin\MeetingController@store')->name('meeting.store');
    Route::get('/meeting/detail/{id}', 'Admin\MeetingController@show')->name('meeting.show');
    Route::get('/meeting/edit/{id}', 'Admin\MeetingController@edit')->name('meeting.edit');
    Route::put('/meeting/update/{id}', 'Admin\MeetingController@update')->name('meeting.update');
    Route::delete('/meeting/delete/{id}', 'Admin\MeetingController@destroy')->name('meeting.delete');
    Route::get('/meeting/list', 'Admin\MeetingController@getMeeting')->name('meeting.list');
    Route::get('/meeting/user/{id}', 'Admin\MeetingController@getMeetingById')->name('meeting.byid');
    Route::put('/meeting/user/edit', 'Admin\MeetingController@editUserMeeting')->name('meeting.user.edit');
    Route::delete('/meeting/user/delete', 'Admin\MeetingController@deleteUserMeeting')->name('meeting.user.delete');
    Route::put('/meeting/status/{id}', 'Admin\MeetingController@editStatusMeeting')->name('meeting.edit.status');
    Route::get('/meeting/user/list/{id}', 'Admin\MeetingController@getUserToMeeting')->name('meeting.user.get');
    Route::post('/meeting/user/create/{id}', 'Admin\MeetingController@createUserToMeeting')->name('meeting.user.create');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::name('app.')->group(function () {
    Route::get('/', 'Main\HomeController@homepage')->name('home');

    // Route Post
    Route::get('/post', 'Main\PostController@index')->name('post');
    Route::get('/post/detail/{post}', 'Main\PostController@show')->name('post.show');
    Route::get('/post/category/{category}', 'Main\PostController@category')->name('post.category');
    Route::get('/post/tag/{tag}', 'Main\PostController@tag')->name('post.tag');

    // Route Album
    Route::get('/album', 'Main\AlbumController@index')->name('album');
    Route::get('/album/{slug}', 'Main\AlbumController@show')->name('album.show');

    // Route Aspiration
    Route::get('/aspiration', 'Main\AspirationController@index')->name('aspiration');
    Route::post('/aspiration', 'Main\AspirationController@store')->name('aspiration.store');

    // Route About
    Route::get('/sejarah', 'Main\AboutController@sejarah')->name('about.sejarah');
});

// Route::middleware(['auth', 'user'])->get('/home', 'HomeController@index')->name('home');
Route::name('user.')->middleware(['auth', 'user'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Route Aspiration
    Route::get('/user/aspiration', 'User\AspirationController@create')->name('aspiration.create');
    Route::post('/user/aspiration', 'User\AspirationController@store')->name('aspiration.store');

    // Route Meeting
    Route::get('/user/meeting/testing', 'User\MeetingController@testing')->name('meeting.testing');
    Route::get('/user/meeting/list', 'User\MeetingController@getMeeting')->name('meeting.list');
    Route::post('/user/meeting/check/{id}', 'User\MeetingController@check')->name('meeting.check');
});

Route::middleware(['auth'])->get('/profile', 'ProfileController@index')->name('profile');
Route::middleware(['auth'])->get('/profile/show/{user}', 'ProfileController@show')->name('profile.show');
Route::middleware(['auth'])->get('/profile/edit/{user}', 'ProfileController@edit')->name('profile.edit');
Route::middleware(['auth'])->put('/profile/update/{user}', 'ProfileController@update')->name('profile.update');
Route::middleware(['auth'])->put('/profile/updatepass/{user}', 'ProfileController@updatePassword')->name('profile.updatepass');
