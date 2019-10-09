<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Testing routes 
Route::get('/mail', 'MailController@mail');
Route::get('/testacti', function () {
	$options = array('first_name' => 'SPIDY',
					'last_name' => 'ROCKS',
					'role' => 'Employer',
					'action' => 'applying to your dream job',
					'email' => 'spidy@ninja.com',
					'activation_url' => route('accountverification',['key' => 'wdejhvabcncnkjnckjpeimdcnnbanjcbhbckmcmbc'])
					 );
	$options = array('to_name' => 'employer',
					'candidate_name' =>  'Candidate Name',										
					'email' => 'sun',	
					'html' => 	''
					 );
    return view('mail.resumeattached_template', $options);
});
Route::get('/testacti1', function () {
	$data = DB::table('employerjobposts')->where('jobpost_id',1)->first();            
    $subject = 'You may like this Posting on '.$data->job_title. ' at' ;    
    $mailDetails = route('viewpost',[1, $data->job_title, 'sasasasasasasa']);                    
		$referral_code = 'pecsundar@gmail.com';
        $url_referralcode = Crypt::encrypt($referral_code); 
	$options = array('my_name' => 'SPIDY',
					'my_message' => 'ROCKS',
					'referral_url' => $mailDetails,
					 );
    return view('mail.referraljob_template', $options);
});
Route::get('/candidate_new/', function () { return view('candidate.index'); });
//..............


Route::get('/pages-not-found','Controller@pagesNotFound')->name('error.pages-not-found');
Route::get('/forgot-password','Controller@forgotPassword')->name('forgot-password');
Route::post('/forgot-password','Controller@resetPasswordMail')->name('reset-password-mail');
Route::get('/password-reset', 'Controller@resetPassword')->name('reset-password');
Route::post('/create-reset-password', 'Controller@saveResetPassword')->name('save-reset-password');
//Common Routes
Route::get('/', 'Controller@index')->name('mainindex');
Route::get('/logout', 'Controller@logout')->name('logout');
Route::get('/account/verify/{key}', 'Controller@accountverification')->name('accountverification');
Route::get('/candidate/signup/{referralkey?}', 'CandidateController@register')->name('referralactivation');
Route::post('/ajaxcheckemail', 'Controller@checkemail');
Route::get('/autocomplete/{type?}/{val?}', 'CandidateController@autocomplete')->name('autocomplete');

//Candidate's route
//Route::get('/candidate/', function () { return view('candidate.index'); })->name('candidatelogin');
Route::get('/candidate/', function () { return view('template.candidate_index'); })->name('candidatelogin');
Route::post('/candidate/signup', 'CandidateController@signup');
Route::post('/candidate/login', 'CandidateController@login');
Route::group(['middleware' => ['auth']], function () { 
	Route::get('/internal/profile/{mode?}/{pdf?}', 'CandidateController@profile')->name('candidateviewprofile'); //Used in iFrame
	Route::get('/candidate/profile/{mode?}', 'CandidateController@renderprofile')->name('candidateprofile');
	Route::post('/candidate/ajaxsave', 'CandidateController@savecandidate')->name('candidatesave');
});
Route::get('/jobsearch/{mode?}', 'CandidateController@jobsearch')->name('jobsearch');
Route::get('/jobsearch', 'CandidateController@jobsearch')->name('jobsearch_paginate');
//agent,s route
Route::get('/agent/', 'AgentController@index')->name('agentlogin');
//Route::get('/agent/enquiry','AgentController@agentenquiry_form')->name('agentenquiry');
Route::post('/agent/enquiry','AgentController@saveenquiry')->name('postenquiry');
Route::get('/agent/home','AgentController@agenthome')->name('agenthome');

//Import Excel
Route::get( 'import/excel', ['as' => 'import.excel', 'uses' => 'ImportController@excel']);
Route::post( 'import/excel', ['as' => 'import.post', 'uses' => 'ImportController@postExcel']);

//Employer route
//Route::get('/employer/', function () { return view('employer.index'); })->name('employerlogin');
Route::get('/employer/', function () { return view('template.employer_index'); })->name('employerlogin');
Route::get('/employer/signup', 'EmployerController@render_signup')->name('employersignup');
Route::post('/employer/ajaxsignup','EmployerController@signup');
Route::post('/employer/ajaxlogin','EmployerController@login');
Route::get('/employer/main','EmployerController@employerhome')->name('employerhome');

Route::get('/post/{post_id}/{post_title}/{referralkey?}/{referral_email?}', 'EmployerController@viewpost')->name('viewpost');
Route::group(['middleware' => ['verifiedusers']], function () { 
	//Candidate	
	Route::get('/candidate/home', 'CandidateController@home')->name('candidatehome');
	Route::get('/candidate/interviews', 'CandidateController@showinterview')->name('showinterview');
	Route::get('/candidate/settings', 'CandidateController@settings')->name('candidatesettings');
	Route::get('/candidate/change-password', 'CandidateController@showChangePassword')->name('candidate_change_password');
	//..Referral
	Route::get('candidate/referseekers/{mode}/{id?}', 'CandidateController@referral')->name('referapplicant');
	Route::post('candidate/referseekers/{id?}', 'MailController@sendreferralmail')->name('sendinvite');	
	Route::get('agent/viewuploads/{id}/{docname?}', 'CandidateController@viewuploads')->name('viewuploads');	
    Route::post('agent/resendinvite', 'MailController@resendreferralmail')->name('resendinvite');	
	
	Route::post('/candidate/ajaxremove', 'CandidateController@removecandidatedata');
	Route::post('/candidate/jobshortlist/{id}/{action}/{parameter1?}', 'CandidateController@jobshortlist')->name('jobshortlist');


	//Employer
	Route::get('/employer/buycredits', 'EmployerController@buycredits')->name('buycredits');
	Route::post('/employer/confirmcredits/{credits}/{pack_name?}', 'EmployerController@confirmcredits')->name('confirmcredits');

	Route::get('/employer/editprofile/{id}', 'EmployerController@editprofile')->name('editprofile');
	Route::post('/employer/updateprofile', 'EmployerController@updateprofile')->name('updateprofile');
	Route::get('/employer/postcreate', 'EmployerController@postcreate');
	Route::get('/employer/post/{id}/edit', 'EmployerController@postedit')->name('editpost');
	Route::post('/employer/ajaxcreatepost', 'EmployerController@postsave');
	Route::post('/employer/ajaxconfirmpost/{id}', 'EmployerController@confirmpost');
	Route::get('/employer/deletepost/{id}', 'EmployerController@deletepost');
	
	Route::get('/employer/managejob/{mode}', 'EmployerController@managepost')->name('managepost');
	Route::get('/employer/managecandidate/{job_id}/{emp_status?}', 'EmployerController@managecandidate')->name('managecandidate');
	Route::get('/processcandidate/{id}/{emp_status}/{mode}', 'EmployerController@processCandidate')->name('processcandidate');
	Route::get('/employer/talentsearch', 'EmployerController@talentsearch')->name('talentsearch');

	Route::post('/employer/downloadresume', 'EmployerController@downloadresume')->name('downloadresume');

	Route::get('/epayment', 'PaymentController@index')->name('epayment');
	Route::get('/epayment', 'PaymentController@response')->name('paymentResponse');
	

});	


Route::group(['prefix' => '/api/v1'], function () {
    Route::post('/login', 'MobileAppController@authenticate');
    Route::post('/register', 'MobileAppController@register');
    Route::post('/logout', 'MobileAppController@signout');
    Route::post('/save', 'CandidateController@savecandidate');
});