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
    //Homepage route
    Route::get('/', function () {
        return view('auth.login');
    })->middleware('guest');
    Route::auth();

    Route::group(['middleware' => 'auth'],function () {
    	//Home Controller Route
        Route::get('/home', 'HomeController@index');

        //Patient Portal Routes
        Route::resource('user','UserController',['except' => [
            'create', 'store', 'update', 'destroy','index','edit'
        ]]);
        Route::resource('child','ChildController');
        Route::resource('user.child','UserChildController',['except'=>[
            'destroy'
        ]]);
        Route::resource('child.contact','ChildContactController');
        Route::resource('child.allergy','ChildAllergyController');
        Route::resource('child.specialneed','ChildSpecialNeedController');
        Route::resource('child.painmanagement','ChildPainManagementController');
        Route::resource('user.musicassessment','UserChildMusicAssessmentController');
        Route::post('/user/{user_id}/musicassessment/further','UserChildMusicAssessmentController@further');
        Route::get('/allprograms', 'UserChildMusicAssessmentController@allprograms');
        Route::get('/allprograms/display/{category}','ProgramSeasonController@display');
        Route::get('/user/{user_id}/child/{child_id}/{action}','UserChildController@edits');



        //Admin Portal Routes
        Route::resource('admin','AdminController');


    	Route::get('/season/exporter/','SeasonController@exportData');
    	Route::post('/season/exporter/','SeasonController@exportSeasonData');
    	
    	Route::resource('season','SeasonController',['except'=>[
    	    'edit','destroy'
    	]]);
    	Route::resource('program','ProgramController');
    	
        Route::resource('child.programseason','ChildProgramSeasonController');
        Route::resource('programseason','ProgramSeasonController',['except'=>[
            'store'
        ]]);
        Route::resource('transaction','TransactionController');
    	
        
        Route::get('/verify/child/info', 'ChildController@verify');
        Route::get('/{user_id}/view/{child_id}', 'UserChildController@view');
        
        Route::post('/season/{id}/programseason','ProgramSeasonController@store');
        Route::get('admin/childInfo/{child}', 'AdminController@childInfo');
        Route::get('admin/programSeasonInfo/{ps}', 'AdminController@programSeasonInfo');
        Route::get('/register/{program_id}/{season_id}','ProgramSeasonController@register');
        Route::post('/funding','ChildProgramSeasonController@fundingFileUpload');
        Route::get('/balance/{cps_id}','TransactionController@balance');
        Route::post('/settle/{cps_id}','TransactionController@settle');
        Route::post('/transaction/exporter','TransactionController@exportTransaction');
        Route::get('/season/{id}/program/add','ProgramSeasonController@addProgramSeason');
        Route::get('program/updateView/{id}','ProgramController@updateView');
        Route::post('/transaction/child','ProgramSeasonController@children');
        Route::get('docs', function(){
                return View::make('docs.api.v1.index');
            });
        
        // added
        Route::get('allRegistrants', 'AdminController@viewAllRegistrants');
    });
    
});
