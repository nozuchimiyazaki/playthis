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

Route::get('/', 'MusicsController@index');
// 検索結果
Route::post('result', 'MusicsController@result')->name('musics.result');
Route::get('result', 'MusicsController@result')->name('musics.result');
// ユーザが投稿した曲一覧
Route::get('users/{id}', 'MusicsController@usermusics')->name('user.musics');

// サインアップ
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// 管理者
Route::group(['prefix' => 'admin'], function () {
    // ログイン/ログアウト
    Route::get('login', 'AdminController@showAdminLoginForm')->name('admin.login');
    Route::post('login', 'AdminController@adminLogin')->name('admin.login.post');
    Route::get('logout', 'AdminController@logout')->name('admin.logout');

    Route::group(['middleware' => ['auth', 'can:isAdmin']], function () {
        Route::get('/', 'AdminController@index')->name('admin.index');
        // ユーザ一覧表示
        Route::get('users', 'AdminController@showUsers')->name('admin.users');
        Route::post('users', 'AdminController@showUsers')->name('admin.users');
        // ユーザ情報編集
        Route::get('users/{id}/edit', 'AdminController@editUser')->name('admin.useredit');
        Route::post('users/{id}/update', 'AdminController@updateUser')->name('admin.userupdate');
        // プレイスタイル登録
        Route::get('styles', 'AdminController@editStyles')->name('admin.editstyles');
        Route::post('styles', 'AdminController@saveStyle')->name('admin.savestyle');

    });
});

Route::group(['prefix' => 'musics/{id}'], function () {
    // 曲詳細ページ
    Route::get('/', 'MusicsController@show')->name('music.show');
    // コメント登録
    Route::post('comment', 'MusicsController@commentstore')->name('comment.store');
    // いいね
    Route::post('addlike', 'MusicsController@addLike')->name('likes.add');
    Route::post('dellike', 'MusicsController@delLike')->name('likes.del');
});

Route::group(['middleware' => ['auth']], function () {
    // 曲新規登録ページ
    Route::get('new', 'MusicsController@create')->name('music.new');
    Route::post('store', 'MusicsController@store')->name('music.store');

    Route::group(['prefix' => 'musics/{id}'], function () {
        // 曲編集ページ
        Route::get('edit', 'MusicsController@edit')->name('music.edit');
        Route::post('update', 'MusicsController@update')->name('music.update');
    });

    Route::group(['prefix' => 'user/{id}'], function () {
        // ユーザ情報編集
        Route::get('edit', 'UsersController@edit')->name('user.edit');
        Route::post('update', 'UsersController@update')->name('user.update');

    });
});

