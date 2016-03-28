<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/



Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::group(['middleware' => 'auth'],function () {
    	Route::resource('user','UserController');
    	Route::resource('child','ChildController');
    	Route::resource('user.child','UserChildController');
    	Route::resource('season','SeasonController');
    	Route::resource('program','ProgramController');
    	Route::resource('child.emergencycontact','ChildEmergencyContactController');
        Route::resource('child.allergy','ChildAllergyController');
        Route::resource('child.specialneed','ChildSpecialNeedController');
        Route::resource('child.painmanagement','ChildPainManagementController');
        Route::resource('child.programseason','ChildProgramSeasonController');
        Route::resource('programseason','ProgramSeasonController');
        Route::resource('transaction','TransactionController');
    	Route::get('/home', 'HomeController@index');
        Route::resource('admin','AdminController');
        Route::post('/verify/child/info', 'ChildController@verify');
        
        
        Route::get('admin/childInfo/{child}', 'AdminController@childInfo');
        Route::get('admin/programSeasonInfo/{ps}', 'AdminController@programSeasonInfo');
        Route::get('/register/{program_id}/{season_id}','ProgramSeasonController@register');
        Route::post('/funding','ChildProgramSeasonController@fundingFileUpload');
        Route::get('/balance/{cps_id}','TransactionController@balance');
        Route::post('/settle/{cps_id}','TransactionController@settle');

    });
    
});
