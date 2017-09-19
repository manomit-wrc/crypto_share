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
	Route::get('/change_pass', 'PageController@change_pass');
	Route::post('/update_password', 'PageController@update_password');
	Route::get('/view-settings', 'PageController@view_settings');
	Route::post('/edit_settings', 'PageController@edit_settings');
	Route::get('/addGroupByUser', 'PageController@add_group_by_user');
	Route::get('/logout', 'PageController@logout');
});

