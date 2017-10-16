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
Route::get('/explore', 'PageController@explore_group');
Route::get('/login', 'PageController@login');
Route::get('/register', 'PageController@register');
Route::post('/register/submit', 'PageController@submit_registration');
Route::post('/login/submit', 'PageController@submit_login');
Route::get('/activate/{token}/{time}', 'PageController@activate_reg');
Route::post('/contact-us-form', 'PageController@contact_us_submit');
Route::get('/test-email', 'PageController@test_email');

Route::group(['middleware' => ['crypto']], function() {
	Route::get('/dashboard','DashboardController@index');
	Route::get('/dashboard/coinList','DashboardController@coinList');

	Route::get('/edit_profile', 'PageController@edit_profile_view');
	Route::post('/profile_edit', 'PageController@profile_edit');
	Route::get('/change_pass', 'PageController@change_pass');
	Route::post('/update_password', 'PageController@update_password');
	Route::get('/view-settings', 'PageController@view_settings');
	Route::post('/edit_settings', 'PageController@edit_settings');

	Route::get('/testimonial', 'TestimonialController@index');
	Route::get('/testimonial/add', 'TestimonialController@testimonial_add');
	Route::post('/insert_testimonial', 'TestimonialController@insert_testimonial');
	Route::get('/testimonial/edit/{id}', 'TestimonialController@testimonial_edit');
	Route::post('/update_testimonial', 'TestimonialController@update_testimonial');
	Route::get('/testimonial/delete/{id}', 'TestimonialController@delete_testimonial');

	Route::get('/pricing', 'PricingController@index');
	Route::get('/pricing/add', 'PricingController@pricing_add');
	Route::post('/insert_pricing', 'PricingController@insert_pricing');
	Route::get('/pricing/edit/{id}', 'PricingController@pricing_edit');
	Route::post('/update_pricing', 'PricingController@update_pricing');
	Route::get('/pricing/delete/{id}', 'PricingController@delete_pricing');

	Route::get('/users', 'UserController@index');
	Route::get('/users/deact_user/{id}', 'UserController@deact_user');
	Route::get('/users/activate_user/{id}', 'UserController@activate_user');
	Route::get('/users/grant_access/{id}', 'UserController@grant_access');
	Route::get('/users/revoke_access/{id}', 'UserController@revoke_access');

	Route::get('/group', 'GroupController@add_group_by_user');
	Route::get('/group/add', 'GroupController@create_group');
	Route::post('/add-create-groups', 'GroupController@add_create_groups');
	Route::get('/group/edit/{group_id}', 'GroupController@add_group_edit');
	Route::post('/edit-create-groups/{group_id}', 'GroupController@edit_create_groups');
	Route::get('/add_group_delete/{group_id}', 'GroupController@add_group_delete');
	Route::get('/group/join-groups-list', 'GroupController@join_group_list');
	Route::post('/join_group_request_sent', 'GroupController@join_group_request_sent');
	Route::get('/group/pending-request/{group_id}', 'GroupController@group_pending_request');
	Route::get('/group/pending_request_accept/{group_id}', 'GroupController@pending_request_accept');
	Route::get('/group/pending_request_decline/{group_id}', 'GroupController@pending_request_decline');
	Route::get('/group/dashboard/{group_id}', 'GroupController@group_dashboard');
	Route::post('/group/quick_post_submit/{group_id}', 'GroupController@quick_post_submit');
	Route::post('/group/pinned-post', 'GroupController@pinned_post');
	Route::get('/group/group_transaction/{group_id}', 'GroupController@group_wise_transaction');
	Route::post('/group/unpinned-post', 'GroupController@unpinned_post');
	Route::post('/group/delete-post', 'GroupController@delete_post');
	Route::get('/group/dashboard/{group_id}/{post_id}','GroupController@edit_post');

	Route::get('/my-post', 'MyPostController@index');

	Route::post('/group/feedback_submit', 'GroupController@feedback_submit');


	//coin property update
	Route::get('/coin/property-update', 'PageController@coin_property_update');
	//end

	Route::get('/transaction', 'TransactionController@index');
	Route::get('/group/transaction/add/{group_id}', 'TransactionController@add_transaction');
	Route::get('/get_price/{coin_name}', 'TransactionController@get_price');
	Route::post('/insert_transaction', 'TransactionController@insert_transaction');
	Route::get('/group/group_transaction/edit/{group_id}/{tran_id}', 'TransactionController@edit_transaction');
	Route::post('/update_transaction', 'TransactionController@update_transaction');
	Route::get('/transaction/delete/{id}', 'TransactionController@delete_transaction');
	
	Route::get('/work', 'WorkController@index');
	Route::get('/work/add', 'WorkController@work_add');
	Route::post('/insert_work', 'WorkController@insert_work');
	Route::get('/work/edit/{id}', 'WorkController@work_edit');
	Route::post('/update_work', 'WorkController@update_work');
	Route::get('/work/delete/{id}', 'WorkController@delete_work');
	
	Route::resource('teams', 'TeamController', ['only' => [
    	'index', 'create', 'store','edit'
	]]);
	
	Route::get('/teams/delete/{id}','TeamController@destroy');
	Route::post('/teams/{id}','TeamController@update');

	Route::get('/chat', 'ChatController@index');
	Route::post('/chat/message', 'ChatController@postMessage');
	Route::post('/chat/user-typing','ChatController@user_typing');
	Route::get('/chat/load-message', 'ChatController@loadMessage');

	Route::get('/logout', 'PageController@logout');
});

