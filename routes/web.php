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

// Public Routes
Route::group(['middleware' => 'guest'], function() {
    Route::get('/', 'AuthController@getLogin')->name('getLogin');
    Route::get('login', 'AuthController@getLogin')->name('login');
    Route::post('login', 'AuthController@postLogin')->name('postLogin');

    Route::get('registro', 'RegisterController@getRegister')->name('getRegister');
    Route::post('registro', 'RegisterController@postRegister')->name('postRegister');
});

// Private Routes
Route::group(['middleware' => 'auth'], function() {
    Route::get('home', 'HomeController@getHome')->name('getHome');

    Route::post('logout', 'AuthController@postLogout')->name('postLogout');

    Route::get('perfil', 'UserProfileController@getProfile')->name('getProfile');
    Route::post('perfil', 'UserProfileController@postProfile')->name('postProfile');
    Route::get('perfil/alterarsenha', 'UserProfileController@getChangePassword')->name('getChangePassword');
    Route::post('perfil/alterarsenha', 'UserProfileController@postChangePassword')->name('postChangePassword');

    Route::resource('usuarios', 'UserController')->middleware('can:admin');

    Route::resource('clientes', 'ClientController')->middleware('can:admin');

    Route::resource('telefones', 'PhoneController');
    Route::post('telefones/pesquisar', 'PhoneController@search')->name('telefones.search');

    Route::resource('grupos', 'GroupController')->middleware('can:admin');

    Route::get('logdeatividades', 'ActivityLogController@index')->name('logs.index');
});