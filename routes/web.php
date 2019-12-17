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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('dashboard/post')->group(function() {
  Route::get('index', 'Dashboard\PostController@index');
  Route::get('create', 'Dashboard\PostController@create');
  Route::POST('store', 'Dashboard\PostController@store');
  Route::get('{id}/edit', 'Dashboard\PostController@edit');
  Route::patch('{id}', 'Dashboard\PostController@update');
  Route::delete('delete', 'Dashboard\PostController@delete');
});



