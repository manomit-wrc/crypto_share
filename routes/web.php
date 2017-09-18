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

Route::get('/', 'PageController@index');
Route::get('/login', 'PageController@login');
Route::get('/register', 'PageController@register');
Route::post('/register/submit', 'PageController@submit_registration');
Route::post('/login/submit', 'PageController@submit_login');

Route::group(['middleware' => ['crypto']], function() {
	Route::get('/dashboard','DashboardController@index');
	Route::get('/edit_profile', 'PageController@edit_profile_view');
	Route::post('/profile_edit', 'PageController@profile_edit');
	Route::get('/logout', 'PageController@logout');
});

