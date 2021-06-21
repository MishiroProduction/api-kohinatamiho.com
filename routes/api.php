<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('users')->group(function() {
   Route::get('/', 'UserController@index')->middleware('auth:api')->name('users.index');
   Route::post('/login', 'UserController@login')->name('users.login');
   Route::get('/auth', function() {
      return response()->json([
          'status' => true,
          'errors' => null,
          'message' => '',
          'data' => [],
      ], 200);
   })->name('users.auth');
});
