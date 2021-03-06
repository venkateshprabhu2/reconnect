<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'HomeController@showLogin' , 'as' => 'home.login'));
Route::get('login', array('uses' => 'HomeController@showLogin' , 'as' => 'home.art.login'));
Route::post('login', array('uses' => 'HomeController@attemptLogin', 'as' => 'users.login'));
Route::get('logout', array('uses' => 'HomeController@logout', 'as' => 'users.logout'));
Route::post('newuser', array('uses' => 'UsersController@store', 'as' => 'users.store'));
Route::get('users/verify/{token}', array('uses' => 'UsersController@verify', 'as' => 'users.verify'));
Route::get('password/reset/{token}', array('uses' => 'UsersController@getForgottenUser', 'as' => 'users.password.new'));
Route::post('password/new/{id}', array('uses' => 'UsersController@setNewPassword', 'as' => 'users.password.set'));
Route::post('sendlink', array('uses' => 'UsersController@sendVerificationLink', 'as' => 'users.sendlink'));
Route::post('resetpassword', array('uses' => 'UsersController@resetPassword', 'as' => 'users.password.reset'));


Route::group(array('before' => 'auth'), function(){
	Route::resource('posts', 'PostsController');
	Route::resource('comments','CommentsController');
	Route::resource('discussions','DiscussionsController');
	Route::resource('replies', 'RepliesController');
	Route::resource('message', 'MessagesController');

	Route::get('events/join/{id}', array('uses' =>'EventsController@join', 'as' => 'events.join'));
	Route::resource('events','EventsController');

	Route::post('updateProfilePicture/{id}', array('uses' => 'UsersController@updatePicture', 'as' => 'user.updatePicture'));
	Route::get('users/location/{id}', array('uses' => 'UsersController@locationUser', 'as' => 'users.location'));
	Route::get('users/batch/{id}', array('uses' => 'UsersController@batchUser', 'as' => 'users.batch'));
	Route::get('users/branch/{id}', array('uses' => 'UsersController@branchUser', 'as' => 'users.branch'));
	Route::get('users/profession/{id}', array('uses' => 'UsersController@professionUser', 'as' => 'users.profession'));
	Route::get('users/domain/{id}', array('uses' => 'UsersController@domainUser', 'as' => 'users.domain'));
	Route::post('users/adddata/{id}', array('uses' => 'UsersController@addProfileData', 'as' => 'users.add.data'));
	Route::post('users/addcontactdata/{id}', array('uses' => 'UsersController@addContactForData', 'as' => 'users.edit.contactdata'));
	Route::get('users/deletedata/{entry}', array('uses' => 'UsersController@deleteProfileData', 'as' => 'users.delete.data'));
	Route::resource('users','UsersController', array('except' => array('store', 'create')));

	Route::get('jobs/apply/{id}', array('uses' => 'JobsController@apply', 'as' => 'jobs.apply'));
	Route::get('jobs/company/{id}', array('uses' => 'JobsController@companyJob', 'as' => 'company.jobs'));
	Route::get('jobs/location/{id}', array('uses' => 'JobsController@locationJob', 'as' => 'location.jobs'));
	Route::resource('jobs', 'JobsController');
	
	Route::get('feedback', array('uses' => 'HomeController@showFeedback', 'as' => 'feedback'));
	Route::get('home', array('uses' => 'HomeController@showHome', 'as' => 'home'));
	Route::get('search', array('uses' => 'HomeController@showSearch', 'as' => 'search'));
	Route::get('discussion', array('uses' => 'HomeController@showDiscussion', 'as' => 'discussion'));
	Route::get('settings', array('uses' => 'HomeController@showSettings', 'as' => 'settings'));
	

});
