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

// Auth::routes();

// Guest
Route::middleware('guest')->group(function() {

  Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
  Route::post('login', 'Auth\LoginController@login');

  Route::prefix('password')->group(function() {
    Route::get('reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('reset', 'Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('confirm', 'Auth\ConfirmPasswordController@confirm');
  });

});

// Admin
Route::group(['middleware' => ['auth']], function() {

  Route::post('logout', 'Auth\LoginController@logout')->name('logout');

  Route::prefix('dashboard/post')->group(function() {
    Route::get('', 'Dashboard\PostController@index')->name('post.index');
    Route::get('create', 'Dashboard\PostController@create');
    Route::post('store', 'Dashboard\PostController@store');
    Route::delete('delete', 'Dashboard\PostController@delete');
    Route::get('read_image_api', 'Dashboard\PostController@readImage');
    Route::get('{post}/edit', 'Dashboard\PostController@edit');
    Route::patch('{post}', 'Dashboard\PostController@update');
  });

  Route::prefix('dashboard/image')->group(function() {
    Route::get('', 'Dashboard\ImageController@index')->name('image.index');
    Route::get('create', 'Dashboard\ImageController@create');
    Route::post('store', 'Dashboard\ImageController@store');
    Route::delete('delete', 'Dashboard\ImageController@delete');
    Route::get('{image}/edit', 'Dashboard\ImageController@edit');
    Route::patch('{image}', 'Dashboard\ImageController@update');
  });

  Route::prefix('dashboard/category')->group(function() {
    Route::get('', 'Dashboard\CategoryController@index')->name('category.index');
    Route::get('create', 'Dashboard\CategoryController@create')->name('category.create');
    Route::post('store', 'Dashboard\CategoryController@store');
    Route::delete('delete', 'Dashboard\CategoryController@delete');
    Route::get('{category}/edit', 'Dashboard\CategoryController@edit');
    Route::patch('{category}', 'Dashboard\CategoryController@update');
  });

  Route::prefix('dashboard/tag')->group(function() {
    Route::get('', 'Dashboard\TagController@index')->name('tag.index');
    Route::get('create', 'Dashboard\TagController@create')->name('tag.create');
    Route::post('store', 'Dashboard\TagController@store');
    Route::delete('delete', 'Dashboard\TagController@delete');
    Route::get('{tag}/edit', 'Dashboard\TagController@edit');
    Route::patch('{tag}', 'Dashboard\TagController@update');
  });
});

// フロント
Route::get('/', 'HomeController@index');
Route::get('/category/{id}', 'HomeController@category');
Route::get('/tag/{id}', 'HomeController@tag');
Route::get('{post}', 'HomeController@show');
