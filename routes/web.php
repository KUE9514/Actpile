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

Route::get('/', 'ActivitiesController@index');
// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
// ユーザ機能
Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    //フォロー機能    
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        Route::get('activities/{activity_id}', 'ActivitiesController@show')->name('activity.show');
        Route::get('activities/{activity_id}/edit', 'ActivitiesController@edit')->name('activity.edit');
        Route::post('activities/{activity_id}', 'ActivitiesController@update')->name('activity.update');
        Route::get('applauses', 'UsersController@applauses')->name('users.applauses');
    });
    Route::group(['prefix' => 'applauses/{id}'], function() {
        Route::post('applause', 'ApplauseController@store')->name('applauses.applause');
    });
    
    Route::resource('activities', 'ActivitiesController', ['only' => ['store', 'destroy']]);
});

