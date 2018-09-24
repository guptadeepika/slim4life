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

// Route::get('admin', function () {
//     return view('admin/login');
// });
// Route::name('admin')->group(function () {
//    // die('asdas');
// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), '/', array(
// 		'uses' => 'Admin\AdminController@login',
// 		'as' => 'login'
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), '/dashboard', array(
// 		'uses' => 'Admin\AdminController@dashboard',
// 		'as' => 'dashboard'
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'change-password', array(
// 		'uses' => 'Admin\AdminController@changePassword',
// 		'as' => 'change-password'
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'my-profile', array(
// 		'uses' => 'Admin\AdminController@myProfile',
// 		'as' => 'adminProfile'
// 	));

// 	//start gym
// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'create-gym', array(
// 		'uses' => 'Admin\GymController@create'
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'update-gym/{id}', array(
// 		'uses' => 'Admin\GymController@update'
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'edit-gym/{id}', array(
// 		'uses' => 'Admin\GymController@edit'
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'delete-gym/{id}', array(
// 		'uses' => 'Admin\GymController@destroy',
// 		'as' => 'deleteGym'
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'gym-list', array(
// 		'uses' => 'Admin\GymController@index',
// 		'as' => 'gymlist'
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'check-gym', array(
// 		'uses' => 'Admin\GymController@checkGym',
// 		'as' => 'checkgym'
// 	));
// 	//end gym

// 	//start activity
// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'activity-add', array(
// 		'uses' => 'Admin\ActivityController@create'
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'delete-activity/{id}', array(
// 		'uses' => 'Admin\ActivityController@delete'
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'update-activity/{id}', array(
// 		'uses' => 'Admin\ActivityController@update',
// 		'as' => 'updateGym'
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'edit-activity/{id}', array(
// 		'uses' => 'Admin\ActivityController@edit'
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'activity-list', array(
// 		'uses' => 'Admin\ActivityController@activitiesList'
// 	));
// 	//end activity

// 	//start feature
// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'feature-add', array(
// 		'uses' => 'Admin\FeatureController@create'
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'feature-list', array(
// 		'uses' => 'Admin\FeatureController@featuresList'
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'delete-feature/{id}', array(
// 		'uses' => 'Admin\FeatureController@delete'
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'update-feature/{id}', array(
// 		'uses' => 'Admin\FeatureController@update',
// 	));

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'edit-feature/{id}', array(
// 		'uses' => 'Admin\FeatureController@edit'
// 	));
// 	//end feature

// 	//start user
// 	Route::resource('user', 'Admin\UserController');

// 	Route::match(array('GET', 'POST', 'PUT', 'PATCH'), 'check-customer', array(
// 		'uses' => 'Admin\UserController@checkCustomer',
// 		'as' => 'checkcustomer'
// 	));
// 	//end user

// 	//start cms page
// 	Route::resource('cms-pages', 'Admin\CmsPagesController');
// 	//end cms page

// 	//start gym pass
// 	Route::resource('gym-passes', 'Admin\GymPassController');

// 	Route::match(array('GET', 'POST'), 'gym-passes', array(
// 		'uses' => 'Admin\GymPassController@index',
// 		'as' => 'gymPassList'
// 	));

// 	Route::match(array('GET', 'POST'), 'gym-passes/change-status/{status}/{id}', array(
// 		'uses' => 'Admin\GymPassController@changeStatus',
// 		'as' => 'changeGymPassStatus',
// 	    'modelName' => '\App\Model\GymPass'
// 	));
// 	//end gym pass
// 	Route::get('logout', 'Admin\AdminController@logout');
// 	    //
// });
//Route::get('/admin',array('as' => 'adddata','uses' => 'AdminController@loginAction'));
echo "asd";
Route::group(array('prefix' => 'admin'), function()
    {
	//	die('asdasd');
    Route::get('/','AdminController@loginAction')->name('admin');
});