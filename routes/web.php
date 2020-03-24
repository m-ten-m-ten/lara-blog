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
    Route::post('resend', 'VerificationController@resend')->name('verification.resend');
    Route::get('verify', 'VerificationController@show')->name('verification.notice');
    Route::get('verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');

    Route::middleware('guest:admin')->group(function (): void {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::get('forgot', 'ForgotPasswordController@showLinkRequestForm')->name('forgot');
        Route::post('forgot', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('reset', 'ResetsPasswordController@reset')->name('update');
        Route::get('reset/{token}', 'ResetsPasswordController@showResetForm')->name('reset');
        Route::get('signup', 'SignupController@showRegistrationForm')->name('signup.show');
        Route::post('signup', 'SignupController@checkData');
        Route::get('signup/confirm', 'SignupController@confirm')->name('signup.confirm');
        Route::post('signup/confirm', 'SignupController@store');
    });

    Route::middleware('auth:admin', 'verified:admin.verification.notice')->group(function (): void {
        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::get('', 'IndexController@index')->name('index');

        // メッセージ管理
        Route::get('message', 'MessageController@index')->name('message.index');
        Route::get('message/create', 'MessageController@create')->name('message.create');
        Route::post('message/create', 'MessageController@store');
        Route::get('message/edit/{message}', 'MessageController@edit')->name('message.edit');
        Route::post('message/edit/{message}', 'MessageController@update');
        Route::delete('message/delete', 'MessageController@delete');

        // ユーザー管理
        Route::get('user', 'UserController@index')->name('user.index');
        Route::delete('user/delete', 'UserController@delete');

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

        // カテゴリー管理
        Route::get('category', 'CategoryController@index')->name('category.index');
        Route::get('category/create', 'CategoryController@create')->name('category.create');
        Route::post('category/create', 'CategoryController@store');
        Route::post('category/ajaxCreate', 'CategoryController@ajaxStore');
        Route::delete('category/delete', 'CategoryController@delete');
        Route::get('category/edit/{category}', 'CategoryController@edit')->name('category.edit');
        Route::post('category/edit/{category}', 'CategoryController@update');

        // タグ管理
        Route::get('tag', 'TagController@index')->name('tag.index');
        Route::get('tag/create', 'TagController@create')->name('tag.create');
        Route::post('tag/create', 'TagController@store');
        Route::post('tag/ajaxCreate', 'TagController@ajaxStore');
        Route::delete('tag/delete', 'TagController@delete');
        Route::get('tag/edit/{tag}', 'TagController@edit')->name('tag.edit');
        Route::post('tag/edit/{tag}', 'TagController@update');
    });
});

// ユーザー登録
Route::prefix('signup')->as('signup.')->group(function (): void {
    Route::get('', 'SignupController@show')->name('show');
    Route::post('', 'SignupController@checkData');
    Route::get('confirm', 'SignupController@confirm')->name('confirm');
    Route::post('confirm', 'SignupController@store');
    Route::get('thanks', 'SignupController@thanks')->name('thanks');
});

// ユーザーメール確認
Route::prefix('user')->namespace('User')->as('user.')->group(function (): void {
    Route::post('resend', 'VerificationController@resend')->name('verification.resend');
    Route::get('verify', 'VerificationController@show')->name('verification.notice');
    Route::get('verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
});

// ユーザー専用ページ
Route::prefix('user')->namespace('User')->as('user.')->group(function (): void {
    Route::middleware('guest:user')->group(function (): void {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::get('forgot', 'ForgotPasswordController@showLinkRequestForm')->name('forgot');
        Route::post('forgot', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('reset', 'ResetsPasswordController@reset')->name('update');
        Route::get('reset/{token}', 'ResetsPasswordController@showResetForm')->name('reset');
    });

    Route::middleware('auth:user', 'verified:user.verification.notice')->group(function (): void {
        Route::get('', 'IndexController@index')->name('index');
        Route::post('logout', 'LoginController@logout')->name('logout');

        // 登録情報変更
        Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
        Route::post('profile/edit', 'ProfileController@update');

        // メッセージ閲覧
        Route::get('message', 'MessageController@index')->name('message.index');

        // お支払い情報
        Route::get('payment', 'PaymentController@index')->name('payment.index');
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
Route::get('/category/{category}', 'HomeController@category')->name('category');
Route::get('/tag/{tag}', 'HomeController@tag')->name('tag');
Route::get('{post}', 'HomeController@show')->name('post');
