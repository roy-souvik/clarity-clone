<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::group(array('prefix' => 'api/v1'), function() {
    // Route::resource('users', 'UserController');
    Route::get('/test/{userid}', 'API\DashboardController@testAPICall');
});

Route::get('/questions', ['as' => 'questions', 'uses' => 'QuestionsController@showAllQuestions']);
Route::get('/question/{question_id}/{slug?}', ['as' => 'show_question_details', 'uses' => 'QuestionsController@showQuestionDetails'])->where(['question_id' => '[0-9]+']);

Route::group(['middleware' => ['web']], function () {

	Route::auth();

	// Authentication Routes...
	// $this->get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin' ]);

	$this->post('login', ['as' => 'login', 'uses' => 'Auth\AuthController@login' ]);


	$this->get('/login', function () {
		return view('welcome', ['popup' => '#loginModalDiv-popup-link']);
	});

	$this->get('/register', function () {
		return view('welcome', ['popup' => '#signUpModalDiv-popup-link']);
	});

	// $this->get('logout', 'Auth\AuthController@logout');

	// Registration Routes...
	// $this->get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister' ]);

	$this->post('register', ['as' => 'register', 'uses' => 'Auth\AuthController@register' ]);

	// Password Reset Routes...
	// $this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
	// $this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
	// $this->post('password/reset', 'Auth\PasswordController@reset');

    Route::get('auth/facebook', 'SocialController@fbRedirectToProvider');
    Route::get('auth/facebook/callback', 'SocialController@fbHandleProviderCallback');

    Route::get('auth/linkedin', 'SocialController@liRedirectToProvider');
    Route::get('auth/linkedin/callback', 'SocialController@liHandleProviderCallback');
});



//==============================================================================
// These group of routes will be accessable after a successful login
//==============================================================================

Route::group(['middleware' => ['auth']], function () {

    /* PROFILE ROUTES GOES HERE */
    Route::patch('update_basic_info', ['as' => 'update_basic_info', 'uses' => 'ProfileController@updateBasicInfo' ]);

    Route::post('update_profile_img', ['as' => 'update_profile_img', 'uses' => 'ProfileController@updateProfileImg' ]);

    // APPLY TO BE AN EXPERT
	 Route::get('apply_to_be_an_expert', ['as' => 'apply_to_be_an_expert', 'uses' => 'ProfileController@applyToBeAnExpert' ]);

	/* PROFILE ROUTES END */

    // Question route
    Route::get('/questions/new', ['as' => 'show_new_question_form', 'uses' => 'QuestionsController@showNewQuestionForm']);
    Route::post('/questions/new', ['as' => 'add_new_question', 'uses' => 'QuestionsController@addNewQuestion']);

    // Expertise add route
    Route::get('/expert/step1', ['as' => 'expert-get-step1', 'uses' => 'ExpertStep1Controller@getStep1']);
    Route::post('/expert/step1', ['as' => 'expert-post-step1', 'uses' => 'ExpertStep1Controller@postStep1']);

    Route::get('/expert/step2', ['as' => 'expert-get-step2', 'uses' => 'ExpertStep2Controller@getStep2']);
    Route::post('/expert/step2', ['as' => 'expert-post-step2', 'uses' => 'ExpertStep2Controller@postStep2']);

    Route::get('/expert/step3', ['as' => 'expert-get-step3', 'uses' => 'ExpertStep3Controller@getStep3']);

    Route::get('/expertises/all', ['as' => 'all_expertises', 'uses' => 'ExpertStep3Controller@getStep3']);

    Route::get('/expertise/add', ['as' => 'show_new_expertise_form', 'uses' => 'ExpertiseController@showNewExpertiseForm']);
    Route::post('/expertise/add', ['as' => 'add_new_expertise', 'uses' => 'ExpertiseController@addNewExpertise']);
    Route::post('/expertise/ajax/get_child_categories', ['as' => 'expertise_ajax_get_child_categories', 'uses' => 'ExpertiseController@getChildCategories']);

    Route::get('authenticate/linkedin', 'LinkedinAuthController@liRedirectToProvider');
    Route::get('authenticate/linkedin/callback', 'LinkedinAuthController@liHandleProviderCallback');

    /* TAGS ROUTES GOES HERE */
    Route::resource('tags', 'TagsController', [
      'only' => ['store']
    ]);
    /* TAGS ROUTES ENDS */

 });

/**
* Route for confirming email
*/
 Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'Auth\AuthController@confirm'
]);


Route::group(['middleware' => ['auth', 'role:admin']], function () {
  /* ADMIN ROUTES GOES HERE */
  Route::get('admin', ['as' => 'admin_dashboard', 'uses' => 'AdminController@index' ]);
  Route::get('admin/apply_as_expert', ['as' => 'expert_apply', 'uses' => 'AdminController@expertApply' ]);
  Route::get('admin/review/experts', ['as' => 'reviewexperts', 'uses' => 'AdminController@expertApply' ]);
  Route::get('admin/review/users', ['as' => 'manageusers', 'uses' => 'AdminController@users' ]);
  Route::get('admin/review/usersdata', ['as' => 'manageusers.data', 'uses' => 'AdminController@userData' ]);

  Route::get('/categories', ['as'=>'categories', 'uses'=>'CategoryController@index']);
  Route::post('/category', 'CategoryController@store');
  /* ADMIN ROUTES END */
 });
