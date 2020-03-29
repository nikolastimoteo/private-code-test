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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('login', 'AuthController@getLogin')->middleware(['guest'])->name('login');
Route::get('/', 'AuthController@getLogin')->middleware(['guest'])->name('getLogin');
Route::post('login', 'AuthController@postLogin')->middleware(['guest'])->name('postLogin');
Route::post('logout', 'AuthController@postLogout')->middleware(['auth'])->name('postLogout');
Route::get('home', 'HomeController@getHome')->middleware(['auth'])->name('getHome');
Route::get('registro', 'RegisterController@getRegister')->middleware(['guest'])->name('getRegister');
Route::post('registro', 'RegisterController@postRegister')->middleware(['guest'])->name('postRegister');

Route::get('perfil', 'UserProfileController@getProfile')->middleware(['auth'])->name('getProfile');
Route::post('perfil', 'UserProfileController@postProfile')->middleware(['auth'])->name('postProfile');
Route::get('perfil/alterarsenha', 'UserProfileController@getChangePassword')->middleware(['auth'])->name('getChangePassword');
Route::post('perfil/alterarsenha', 'UserProfileController@postChangePassword')->middleware(['auth'])->name('postChangePassword');