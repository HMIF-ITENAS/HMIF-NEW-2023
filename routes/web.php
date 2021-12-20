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
    Route::get('/category', 'Admin\CategoryController@index')->name('category');
    Route::get('/category/create', 'Admin\CategoryController@create')->name('category.create');
    Route::post('/category/store', 'Admin\CategoryController@store')->name('category.store');
    Route::get('/category/edit/{category}', 'Admin\CategoryController@edit')->name('category.edit');
    Route::get('/category/show/{category}', 'Admin\CategoryController@show')->name('category.show');
    Route::put('/category/update/{category}', 'Admin\CategoryController@update')->name('category.update');
    Route::delete('/category/delete/{category}', 'Admin\CategoryController@destroy')->name('category.delete');
    Route::get('/category/list', 'Admin\CategoryController@getCategories')->name('category.list');

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
    Route::post('/meeting/user/notlist', 'Admin\MeetingController@getUserNotMeeting')->name('meeting.user.notlist');
    Route::get('/meeting/export/{id}', 'Admin\MeetingController@exportMeetingById')->name('meeting.byid.export');

    // Chart
    Route::get('/api-chart/get-users-by-angkatan', 'Admin\HomeController@getUsersByAngkatan')->name('chart.users.angkatan');
    Route::get('/api-chart/get-posts-by-month', 'Admin\HomeController@getPostsByMonth')->name('chart.posts.month');
    Route::get('/api-chart/get-internal-by-month', 'Admin\HomeController@getInternalByMonth')->name('chart.internal.month');
    Route::get('/api-chart/get-external-by-month', 'Admin\HomeController@getExternalByMonth')->name('chart.external.month');
    Route::get('/api-chart/get-meeting', 'Admin\HomeController@getMeeting')->name('chart.meeting');
    Route::get('/api-chart/get-meeting-by-angkatan/{angkatan}', 'Admin\HomeController@getMeetingByAngkatan')->name('chart.meeting.angkatan');

    // Route Permission
    Route::get('/permission', 'Admin\PermissionController@index')->name('permission');
    Route::get('/permission/create', 'Admin\PermissionController@create')->name('permission.create');
    Route::post('/permission/store', 'Admin\PermissionController@store')->name('permission.store');
    Route::get('/permission/edit/{permission}', 'Admin\PermissionController@edit')->name('permission.edit');
    Route::put('/permission/update/{permission}', 'Admin\PermissionController@update')->name('permission.update');
    Route::delete('/permission/delete/{permission}', 'Admin\PermissionController@destroy')->name('permission.delete');
    Route::get('/permission/list', 'Admin\PermissionController@getPermissions')->name('permission.list');

    // Route Role
    Route::get('/role', 'Admin\RoleController@index')->name('role');
    Route::get('/role/create', 'Admin\RoleController@create')->name('role.create');
    Route::post('/role/store', 'Admin\RoleController@store')->name('role.store');
    Route::get('/role/show/{role}', 'Admin\RoleController@show')->name('role.show');
    Route::get('/role/edit/{role}', 'Admin\RoleController@edit')->name('role.edit');
    Route::put('/role/update/{role}', 'Admin\RoleController@update')->name('role.update');
    Route::delete('/role/delete/{role}', 'Admin\RoleController@destroy')->name('role.delete');
    Route::get('/role/list', 'Admin\RoleController@getRoles')->name('role.list');

    // Route Unit
    Route::get('/unit', 'Admin\UnitController@index')->name('unit');
    Route::get('/unit/create', 'Admin\UnitController@create')->name('unit.create');
    Route::post('/unit/store', 'Admin\UnitController@store')->name('unit.store');
    Route::get('/unit/show/{unit}', 'Admin\UnitController@show')->name('unit.show');
    Route::get('/unit/edit/{unit}', 'Admin\UnitController@edit')->name('unit.edit');
    Route::put('/unit/update/{unit}', 'Admin\UnitController@update')->name('unit.update');
    Route::delete('/unit/delete/{unit}', 'Admin\UnitController@destroy')->name('unit.delete');
    Route::get('/unit/list', 'Admin\UnitController@getUnits')->name('unit.list');

    // Route Unit
    Route::get('/item', 'Admin\ItemController@index')->name('item');
    Route::get('/item/create', 'Admin\ItemController@create')->name('item.create');
    Route::post('/item/store', 'Admin\ItemController@store')->name('item.store');
    Route::get('/item/show/{item}', 'Admin\ItemController@show')->name('item.show');
    Route::get('/item/edit/{item}', 'Admin\ItemController@edit')->name('item.edit');
    Route::put('/item/update/{item}', 'Admin\ItemController@update')->name('item.update');
    Route::delete('/item/delete/{item}', 'Admin\ItemController@destroy')->name('item.delete');
    Route::get('/item/list', 'Admin\ItemController@getItems')->name('item.list');

    // Route Peminjaman
    Route::get('/borrow/list', 'Admin\BorrowController@getBorrows')->name('borrow.list');
    Route::post('/borrow/status/{id}', 'Admin\BorrowController@status')->name('borrow.status');
    Route::post('/borrow/returned/{id}', 'Admin\BorrowController@returned')->name('borrow.returned');
    Route::get('/borrow/listDetail/{id}', 'Admin\BorrowController@listDetail')->name('borrow.listDetail');
    Route::get('/borrow', 'Admin\BorrowController@index')->name('borrow');
    Route::get('/borrow/create', 'Admin\BorrowController@create')->name('borrow.create');
    Route::post('/borrow/store', 'Admin\BorrowController@store')->name('borrow.store');
    Route::get('/borrow/show/{borrow}', 'Admin\BorrowController@show')->name('borrow.show');
    Route::get('/borrow/edit/{borrow}', 'Admin\BorrowController@edit')->name('borrow.edit');
    Route::put('/borrow/update/{borrow}', 'Admin\BorrowController@update')->name('borrow.update');
    Route::delete('/borrow/delete/{borrow}', 'Admin\BorrowController@destroy')->name('borrow.delete');
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
    Route::get('/struktur-organisasi', 'Main\AboutController@struktur')->name('about.struktur');
    Route::get('/ketua-himpunan', 'Main\AboutController@kahim')->name('about.kahim');
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

    // Route Peminjaman
    Route::get('/user/borrow', 'User\BorrowController@index')->name('borrow');
    Route::get('/user/borrow/list', 'User\BorrowController@list')->name('borrow.list');
    Route::get('/user/borrow/listDetail/{id}', 'User\BorrowController@listDetail')->name('borrow.listDetail');
    Route::get('/user/borrow/create', 'User\BorrowController@create')->name('borrow.create');
    Route::get('/user/borrow/alat', 'User\BorrowController@alat')->name('borrow.alat');
    Route::get('/user/borrow/confirm', 'User\BorrowController@confirm')->name('borrow.confirm');
    Route::post('/user/borrow/confirm', 'User\BorrowController@confirmStore')->name('borrow.confirmStore');
    Route::post('/user/borrow/store', 'User\BorrowController@store')->name('borrow.store');
    Route::get('/user/borrow/show/{borrow}', 'User\BorrowController@show')->name('borrow.show');
    Route::get('/user/borrow/edit/{borrow}', 'User\BorrowController@edit')->name('borrow.edit');
    Route::put('/user/borrow/update/{borrow}', 'User\BorrowController@update')->name('borrow.update');
    Route::delete('/user/borrow/delete/{borrow}', 'User\BorrowController@destroy')->name('borrow.delete');

    // Route Item
    Route::get('/user/item/list', 'User\ItemController@list')->name('item.list');
    Route::get('/user/item/confirm', 'User\ItemController@confirm')->name('item.confirm');
    Route::post('/user/item/checkQty', 'User\ItemController@checkQty')->name('item.checkqty');
    Route::post('/user/item/{id}/cart', 'User\ItemController@addToCart')->name('item.cart');
    Route::get('/user/item/getCartCount', 'User\ItemController@getCartCount')->name('item.getCartCount');

    Route::get('/user/item/cartList', 'User\ItemController@cartList')->name('item.cartList');
    Route::put('/user/item/updateCart', 'User\ItemController@updateCart')->name('item.updateCart');
    Route::delete('/user/item/deleteCart', 'User\ItemController@deleteCart')->name('item.deleteCart');
});

Route::middleware(['auth'])->get('/profile', 'ProfileController@index')->name('profile');
Route::middleware(['auth'])->get('/profile/show/{user}', 'ProfileController@show')->name('profile.show');
Route::middleware(['auth'])->get('/profile/edit/{user}', 'ProfileController@edit')->name('profile.edit');
Route::middleware(['auth'])->put('/profile/update/{user}', 'ProfileController@update')->name('profile.update');
Route::middleware(['auth'])->put('/profile/updatepass/{user}', 'ProfileController@updatePassword')->name('profile.updatepass');
