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
  return view('app');
});
Route::prefix('app')->group(function () {
  Route::prefix('auth')->group(function () {
    Route::post('install', 'AppUserController@install');
    Route::get('init', 'AppUserController@init');
    Route::post('login', 'AppUserController@login');
    Route::post('register', 'AppUserController@register');
    Route::post('logout', 'AppUserController@logout');
  });
});
Route::prefix('admin')->group(function () {
  Route::get('getDashboardData', 'AdminAdministratorsController@getDashboardData');
  Route::prefix('auth')->group(function () {
    Route::post('install', 'AdminController@install');
    Route::get('init', 'AdminController@init');
    Route::post('login', 'AdminController@login');
    Route::post('logout', 'AdminController@logout');
  });
  Route::prefix('settings')->group(function () {
    Route::get('/', 'AdminSettingsController@browse');
    Route::post('populate', 'AdminSettingsController@populate');
    Route::post('save', 'AdminSettingsController@save');
    Route::post('populateDatabaseWithTestData', 'AdminSettingsController@populateDatabaseWithTestData');
    Route::post('emptyDatabase', 'AdminSettingsController@emptyDatabase');
  });
  Route::prefix('users')->group(function () {
    Route::get('getById/{id}', 'AdminUsersController@getById');
    Route::post('create', 'AdminUsersController@create');
    Route::post('update', 'AdminUsersController@update');
    Route::post('delete/{id}', 'AdminUsersController@delete');
    Route::get('/', 'AdminUsersController@browse');
  });
  Route::prefix('admins')->group(function () {
    Route::get('getById/{id}', 'AdminAdministratorsController@getById');
    Route::post('create', 'AdminAdministratorsController@create');
    Route::post('update', 'AdminAdministratorsController@update');
    Route::post('delete/{id}', 'AdminAdministratorsController@delete');
    Route::get('/', 'AdminAdministratorsController@browse');
  });

  Route::get('/', 'AdminController@adminApp');
});
