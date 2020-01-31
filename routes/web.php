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

// 管理者
Route::prefix('admin')->namespace('Admin')->as('admin.')->group(function (): void {
    Route::middleware('guest:admin')->group(function (): void {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
    });

    Route::middleware('auth:admin')->group(function (): void {
        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::get('', 'IndexController@index')->name('top');

        // メッセージ管理
        Route::get('message', 'MessageController@index')->name('message.index');
        Route::get('message/create', 'MessageController@create')->name('message.create');
        Route::post('message/create', 'MessageController@store');
        Route::get('message/edit/{message}', 'MessageController@edit')->name('message.edit');
        Route::post('message/edit/{message}', 'MessageController@update');
        Route::delete('message/delete', 'MessageController@delete');

        // ユーザー管理
        Route::get('user', 'UserController@index')->name('user.index');
        Route::delete('user/destroy/{user}', 'UserController@destroy')->name('user.destroy');

        // 記事管理
        Route::get('post', 'PostController@index')->name('post.index');
        Route::get('post/create', 'PostController@create')->name('post.create');
        Route::post('post/create', 'PostController@store');
        Route::delete('post/delete', 'PostController@delete');
        Route::get('post/edit/{post}', 'PostController@edit')->name('post.edit');
        Route::post('post/edit/{post}', 'PostController@update');
        Route::get('post/read_image_api', 'PostController@readImage');

        // 画像管理
        Route::get('image', 'ImageController@index')->name('image.index');
        Route::get('image/create', 'ImageController@create')->name('image.create');
        Route::post('image/create', 'ImageController@store');
        Route::delete('image/delete', 'ImageController@delete');
        Route::get('image/edit/{image}', 'ImageController@edit')->name('image.edit');
        Route::post('image/edit/{image}', 'ImageController@update');

        // カテゴリー管理
        Route::get('category', 'CategoryController@index')->name('category.index');
        Route::get('category/create', 'CategoryController@create')->name('category.create');
        Route::post('category/create', 'CategoryController@store');
        Route::delete('category/delete', 'CategoryController@delete');
        Route::get('category/edit/{category}', 'CategoryController@edit')->name('category.edit');
        Route::post('category/edit/{category}', 'CategoryController@update');

        // タグ管理
        Route::get('tag', 'TagController@index')->name('tag.index');
        Route::get('tag/create', 'TagController@create')->name('tag.create');
        Route::post('tag/create', 'TagController@store');
        Route::delete('tag/delete', 'TagController@delete');
        Route::get('tag/edit/{tag}', 'TagController@edit')->name('tag.edit');
        Route::post('tag/edit/{tag}', 'TagController@update');
    });
});

// ユーザー登録
Route::prefix('signup')->as('signup.')->group(function (): void {
    Route::get('', 'SignupController@index')->name('index');
    Route::post('', 'SignupController@postIndex');
    Route::get('confirm', 'SignupController@confirm')->name('confirm');
    Route::post('confirm', 'SignupController@postConfirm');
    Route::get('thanks', 'SignupController@thanks')->name('thanks');
});

// ユーザー専用ページ
Route::prefix('user')->namespace('User')->as('user.')->group(function (): void {
    Route::middleware('guest:user')->group(function (): void {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
    });

    Route::middleware('auth:user')->group(function (): void {
        Route::get('', 'IndexController@index')->name('top');
        Route::post('logout', 'LoginController@logout')->name('logout');

        // 登録情報変更
        Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
        Route::post('profile/edit', 'ProfileController@update');

        // メッセージ閲覧
        Route::get('message', 'MessageController@index')->name('message.index');
        Route::get('message/show/{message}', 'MessageController@show')->name('message.show')->middleware('can:view,message');

        // お支払い情報
        Route::get('payment', 'PaymentController@index')->name('payment.top');
        Route::get('payment/create', 'PaymentController@create')->name('payment.create');
        Route::post('payment/create', 'PaymentController@store');
        Route::delete('payment/delete', 'PaymentController@delete');
        // 定期決済（有料会員）登録
        Route::post('subscribe/create', 'SubscribeController@create')->name('subscribe.create');
        Route::delete('subscribe/delete', 'SubscribeController@delete')->name('subscribe.delete');
    });
});

// 一般公開用ページ
Route::get('/', 'HomeController@index')->name('home');
Route::get('/category/{category}', 'HomeController@category');
Route::get('/tag/{tag}', 'HomeController@tag');
Route::get('{post}', 'HomeController@show');
