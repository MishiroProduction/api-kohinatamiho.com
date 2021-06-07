<?php

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

Route::redirect('/', '/auth/login');

/* Top Page */
Route::get('/top', 'HomeController@index')->name('top_page');

/* Auth */
Route::prefix('auth')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('auth.login');
    Route::post('/login', 'Auth\LoginController@login')->name('auth.login.post');
    Route::get('/logout', 'Auth\LoginController@logout')->name('auth.logout');
});

/* News */
Route::prefix('news')->group(function() {
    Route::get('/', 'NewsController@index')->name('news.index');
    Route::get('/create', 'NewsController@create')->name('news.create');
    Route::post('/', 'NewsController@store')->name('news.store');
    Route::put('/{news}', 'NewsController@update')->where('news', '[0-9]+')->name('news.update');
    Route::get('/{news}/edit', 'NewsController@edit')->where('news', '[0-9]+')->name('news.edit');
    Route::delete('/{news}', 'NewsController@destroy')->where('news', '[0-9]+')->name('news.destroy');
});

/* Users */
Route::prefix('admin_users')->group(function() {
    Route::get('/','AdminUserController@index')->name('admin_users.index');
    Route::get('/create','AdminUserController@create')->name('admin_users.create');
    Route::post('/','AdminUserController@store')->name('admin_users.store');
    Route::get('/{adminUser}/edit','AdminUserController@edit')->where('user', '[0-9]+')->name('admin_users.edit');
    Route::put('/{adminUser}','AdminUserController@update')->where('user', '[0-9]+')->name('admin_users.update');
    Route::delete('/{adminUser}','AdminUserController@destroy')->where('user', '[0-9]+')->name('admin_users.destroy');
});
