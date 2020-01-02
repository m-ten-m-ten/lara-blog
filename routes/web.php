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
    Route::get('create', 'Dashboard\PostController@create')->name('post.create');
    Route::post('create', 'Dashboard\PostController@store');
    Route::delete('delete', 'Dashboard\PostController@delete');
    Route::get('edit/{post}', 'Dashboard\PostController@edit')->name('post.edit');
    Route::post('edit/{post}', 'Dashboard\PostController@update');
    Route::get('read_image_api', 'Dashboard\PostController@readImage');
  });

  Route::prefix('dashboard/image')->group(function() {
    Route::get('', 'Dashboard\ImageController@index')->name('image.index');
    Route::get('create', 'Dashboard\ImageController@create')->name('image.create');
    Route::post('create', 'Dashboard\ImageController@store');
    Route::delete('delete', 'Dashboard\ImageController@delete');
    Route::get('edit/{image}', 'Dashboard\ImageController@edit')->name('image.edit');
    Route::post('edit/{image}', 'Dashboard\ImageController@update');
  });

  Route::prefix('dashboard/category')->group(function() {
    Route::get('', 'Dashboard\CategoryController@index')->name('category.index');
    Route::get('create', 'Dashboard\CategoryController@create')->name('category.create');
    Route::post('create', 'Dashboard\CategoryController@store');
    Route::delete('delete', 'Dashboard\CategoryController@delete');
    Route::get('edit/{category}', 'Dashboard\CategoryController@edit')->name('category.edit');
    Route::post('edit/{category}', 'Dashboard\CategoryController@update');
  });

  Route::prefix('dashboard/tag')->group(function() {
    Route::get('', 'Dashboard\TagController@index')->name('tag.index');
    Route::get('create', 'Dashboard\TagController@create')->name('tag.create');
    Route::post('create', 'Dashboard\TagController@store');
    Route::delete('delete', 'Dashboard\TagController@delete');
    Route::get('edit/{tag}', 'Dashboard\TagController@edit')->name('tag.edit');
    Route::post('edit/{tag}', 'Dashboard\TagController@update');
  });
});

// フロント
Route::get('/', 'HomeController@index');
Route::get('/category/{id}', 'HomeController@category');
Route::get('/tag/{id}', 'HomeController@tag');
Route::get('{post}', 'HomeController@show');
