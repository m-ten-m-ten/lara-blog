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

// フロント
Route::get('/', 'HomeController@index');
Route::get('{post}', 'HomeController@show');

// Auth::routes();

// Auth:登録機能以外のルート
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::prefix('password')->group(function() {
  Route::get('reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
  Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
  Route::get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
  Route::post('reset', 'Auth\ResetPasswordController@reset')->name('password.update');
  Route::get('confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
  Route::post('confirm', 'Auth\ConfirmPasswordController@confirm');
});

// Dashboard
Route::group(['middleware' => ['auth']], function() {
  Route::prefix('dashboard/post')->group(function() {
    Route::get('', 'Dashboard\PostController@index');
    Route::get('create', 'Dashboard\PostController@create');
    Route::post('store', 'Dashboard\PostController@store');
    Route::get('{post}/edit', 'Dashboard\PostController@edit');
    Route::patch('{post}', 'Dashboard\PostController@update');
    Route::delete('delete', 'Dashboard\PostController@delete');
  });
});
