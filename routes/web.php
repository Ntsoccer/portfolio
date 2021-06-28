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

Route::group(['prefix' => 'data/physical', 'middleware' => 'auth'], function(){
  Route::get('{user_id}/index', 'PhysicalController@index')->name('data.physical.index');
  Route::get('{user_id}/create', 'PhysicalController@create')->name('data.physical.create');
  Route::post('{user_id}/store', 'PhysicalController@store')->name('data.physical.store');
  Route::get('{user_id}/edit/{id}', 'PhysicalController@edit')->name('data.physical.edit');
  Route::put('{user_id}/update/{id}', 'PhysicalController@update')->name('data.physical.update');
  Route::put('{user_id}/displayUpdate', 'PhysicalController@displayUpdate')->name('data.physical.displayUpdate');
  Route::delete('{user_id}/destroy/{id}', 'PhysicalController@destroy')->name('data.physical.destroy');
});

Route::group(['prefix' => 'data/weights', 'middleware' => 'auth'], function(){
  Route::get('{user_id}/index', 'WeightsController@index')->name('data.weights.index');
  Route::get('{user_id}/create', 'WeightsController@create')->name('data.weights.create');
  Route::post('{user_id}/store', 'WeightsController@store')->name('data.weights.store');
  Route::get('{user_id}/edit/{id}', 'WeightsController@edit')->name('data.weights.edit');
  Route::put('{user_id}/update/{id}', 'WeightsController@update')->name('data.weights.update');
  Route::put('{user_id}/displayUpdate', 'WeightsController@displayUpdate')->name('data.weights.displayUpdate');
  Route::delete('{user_id}/destroy/{id}', 'WeightsController@destroy')->name('data.weights.destroy');
});

Route::group(['prefix' => 'data/todos', 'middleware' => 'auth'], function(){
  Route::get('{user_id}/index', 'TodosController@index')->name('data.todos.index');
  Route::get('{user_id}/create', 'TodosController@create')->name('data.todos.create');
  Route::post('{user_id}/store', 'TodosController@store')->name('data.todos.store');
  Route::get('{user_id}/edit/{id}', 'TodosController@edit')->name('data.todos.edit');
  Route::get('{user_id}/update/{id}', 'TodosController@update')->name('data.todos.update');
  Route::put('{user_id}/displayUpdate', 'TodosController@displayUpdate')->name('data.todos.displayUpdate');
  Route::delete('{user_id}/destroy/{id}', 'TodosController@destroy')->name('data.todos.destroy');
});

Route::group(['middleware' => 'auth'], function(){
  Route::get('/users', 'UserController@index')->name('users.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');

Route::get('register/verify/{token}', 'Auth\RegisterController@showForm');

Route::get('register/main_check/{token}', 'Auth\RegisterController@mainCheck')->name('register.main_pre_check');
Route::post('register/main_register/{token}', 'Auth\RegisterController@mainRegister')->name('register.main.registered');

Route::get('/auth/{service}', 'OAuthLoginController@getGoogleAuth');
Route::get('/auth/callback/google', 'OAuthLoginController@authGoogleCallback');