<?php

namespace App\Http\Controllers;
use App\Account;
use App\candidate_applications;
use Illuminate\Http\Request;
use DB, Session, URL, Crypt, PDF, View, Excel;
use App\Http\Controllers\MailController;


class CandidateController extends Controller {


	public function create()
	{
		return view('front.candidate');
	}

	private function initSession($account){

		$userprofile = DB::table('candidateprofiles')->where('account_id', $account->account_id)->first();
		Session::set('user.firstname', $userprofile->firstname);
		Session::set('user.accountid', $account->account_id);
		Session::set('user.email', $account->email);
		Session::set('user.candidateprofileid', $userprofile->candidate_profile_id);
		//Setting the candidates preferences
		Session::set('user.prefered.job_category', $userprofile->prefered_category);
		Session::set('user.prefered.job_level', $userprofile->prefered_level);
		Session::set('user.prefered.job_type', $userprofile->prefered_type);
		Session::set('user.prefered.salary_currency', $userprofile->prefered_salary_currency);
		Session::set('user.prefered.salary', $userprofile->prefered_salary);
		Session::set('user.prefered.job_country', $userprofile->prefered_location);

		Session::set('user.login_type', 'candidate');
		Session::set('user.active', $account->account_status);
	}

	public function login(){

		$users = parent::callAPI('login');

		if($users){

			if($_POST['account_type'] == 'agent'){
				Session::set('user.firstname', 'AGENT');
				Session::set('user.accountid', $users->account_id);
				Session::set('user.email', $users->email);
				Session::set('user.active', $users->account_status);
				Session::set('user.login_type', 'agent');
				return redirect()->route('agenthome'); //$this->referral('applicant');
			}
			$this->initSession($users);
			if(Session::get('user.redirecturl')){
				$redirecturl = Session::get('user.redirecturl');
				Session::forget('user.redirecturl');
				Session::forget('user.referralkey');
				return redirect()->to($redirecturl);
			}
			if($users->account_status){
		 		return redirect()->route('candidatehome');
			}else{
		 		return redirect()->route('candidateviewprofile',['edit']);
		 	}
		}
		else{
			session()->flash('loginstatus', 'Login Failed!');
			if($_POST['account_type'] == 'agent')
				return redirect()->route('agentlogin');
			else
				return redirect()->route('candidatelogin');
		}
	}
	public function register($referralkey = null){
		//decode the referal and save status in DB
		$options = array('referralkey' => $referralkey);
		if($referralkey){
			$decrypted_value = Crypt::decrypt($referralkey);
			$options['referral_code'] = $decrypted_value;
		}else{
			$options['referral_code'] = '';
		}

		return view('candidate.register', $options);
	}

	public function referral(Request $request, $mode, $id = null){

		/*$reader = Excel::load('file.xlsx', function($reader) {
			$reader->each(function($sheet) {
			    // Loop through all rows
			    $sheet->each(function($row) {
			    	//echo $row;
			    });

			});
		});*/


		//dd($reader->toArray());
		if($mode == 'job'){
			$refered_data = array();
			$title = 'Refer Job Post to your Friends';
			$sub_title = 'of your friends';
			$caption = 'Send Job';
		}elseif($mode == 'applicant'){
			$result_size = ($request->has('size'))? $request['size']: $this->pageSize;
			$title = 'Refer Applicants to JobKonner';
			$sub_title = 'of applicants you want to invite to JobKonner';
			$caption = 'Send Invite';
			$refered_data = DB::table('referrals')->where([
									'referral_type' => 'applicant',
									'candidate_email' =>  Session::get('user.email')
									])->paginate($result_size);
			if(Session::get('user.login_type') == 'agent'){
				$agent_referal = DB::table('agent_referrals')
					->select(DB::raw('count(*) as applicant_count, agent_referrals.agent_referral_id, agent_referrals.document_name, agent_referrals.created_at'))
					->leftJoin('referrals', function ($join){
		            	$join->on('referrals.agent_referral_id', '=', 'agent_referrals.agent_referral_id');
		            })
					->where([
					'account_id' => Session::get('user.accountid')
					])
					->orderBy('agent_referrals.created_at')
					->groupBy('referrals.agent_referral_id')
					->paginate($result_size);
				//dd($agent_referal);
				$options['agent_referal'] = $agent_referal;
			}
		}
		$options['refered_data'] = $refered_data;
		$options['title'] = $title;
		$options['sub_title'] = $sub_title;
		$options['caption'] = $caption;
		$options['id'] = $id;
		$options['mode'] = $mode;

		$candidate_profile_id = Session::get('user.candidateprofileid');
		$options['userprofile'] = DB::table('candidateprofiles')->where('candidate_profile_id', $candidate_profile_id)->first();
		$options['workexp'] = DB::table('candidateworkexps')->where('candidate_profile_id', $candidate_profile_id)->orderBy('start_date', 'desc')->get();
		//return view('candidate.referral', $options);
		return view('template.candidate.referral', $options);
	}

	public function viewuploads($id, $docname = null){
		$refered_data = DB::table('referrals')->where([
									'referral_type' => 'applicant',
									'agent_referral_id' =>  $id
									])->get();
		$options['refered_data'] = $refered_data;
		$options['title'] = $docname;
		//dd($refered_data);
		return view('agent.viewuploads', $options);
	}

	public function settings(){

		$options['bank'] = ['' => 'Please Select Bank', 'MBB' => 'MayBank', 'HLB' => 'HongLeong Bank'];
		$options['userprofile'] = DB::table('candidateprofiles')->where('candidate_profile_id', Session::get('user.candidateprofileid'))->first();

		//return view('candidate.settings', $options);
		return view('template.candidate.settings', $options);
	}

	public function signup(Request $request){
		//if referral exists do this
		$query = $request->input();
		$decrypted_referralkey = '';
		if(isset($query['referralkey']) && !empty($query['referralkey'])){
			$decrypted_referralkey = Crypt::decrypt($query['referralkey']);

		}elseif(!empty($_POST['referral_code'])){
			$decrypted_referralkey = $_POST['referral_code'];
		}
		if($decrypted_referralkey != ''){
			$refered_data = DB::table('referrals')->where([
									'referral_type' => 'applicant',
									'candidate_email' => $decrypted_referralkey,
									'referral_email' => $_POST['email'],
									'referral_status' => 'invited'])
				->update(['referral_status' => 'registered', 'updated_at' => date('Y-m-d')]);
		}
		//Register process
		$verify_key = Crypt::encrypt($_POST['email']);
		$is_subscribed = '0';
		if(!empty($_POST['promotion'])) $is_subscribed = 1;
		$data  = array('is_subscribed' => $is_subscribed, 'encrypted_key' => $verify_key);
		$account_id = parent::callAPI('signup_1', $data);
		$profile_id = parent::callAPI('signup_2', array('account_id' => $account_id ));

		Session::set('user.candidateprofileid', $_POST['first_name']);

		$options = array('first_name' => $_POST['first_name'],
					'last_name' =>  $_POST['last_name'],
					'role' => 'JobSeeker',
					'action' => 'applying to your dream job',
					'email' => $_POST['email'],
					'activation_url' => route('accountverification',['key' => $verify_key])
					 );
		MailController::sendactivationmail($options);
		$this->initSession((object)array('account_id' =>  $account_id, 'email' => $_POST['email'], 'account_status' => '0'));
		return redirect()->route('candidateviewprofile',['edit']);
	}

	public function renderprofile($mode='view'){
		$options = array('mode' => $mode);
		return view('candidate.editprofile', $options);
	}

	public function home(){
		$candidate_profile_id = Session::get('user.candidateprofileid');
		$userprofile = DB::table('candidateprofiles')->where('candidate_profile_id', $candidate_profile_id)->first();

		$jobpost_condition_array = ['employerjobposts.status' => 'Posted'];
		$recommended_condition = array();
		$userpreference = Session::get('user.prefered');
		foreach ($userpreference as $key => $value) {
			if($value && $key!= 'salary') $recommended_condition['employerjobposts.'.$key] = $value;
		}
		$jobpost_condition_array = array_merge($jobpost_condition_array, $recommended_condition);
		//dd($jobpost_condition_array);
		$pref_salary = Session::get('user.prefered.salary');
		$posts = array();
		if(count($recommended_condition) > 0 || $pref_salary > 0){
		$posts = DB::table('employerjobposts')
            ->leftJoin('candidate_savedapplications', function ($join){
            	$join->on('candidate_savedapplications.jobpost_id', '=', 'employerjobposts.jobpost_id')
            	->where('candidate_savedapplications.candidate_profile_id', '=' , Session::get('user.candidateprofileid'));
            })
            ->where(function ($query) use ($jobpost_condition_array, $pref_salary) {
		                $query->where($jobpost_condition_array);
		                if($pref_salary > 0){
		                      $query->where('employerjobposts.salary_max', '>=' , $pref_salary);
		                  }
		            })
            ->select('employerjobposts.*',
            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_country and lookup_type = 'country') as job_country"),
            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_category and lookup_type = 'job_category') as job_category"),
            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_level and lookup_type = 'job_level') as job_level"),
            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_type and lookup_type = 'job_type') as job_type"),
            	'candidate_savedapplications.candidate_saved_application_id')
            ->take(5)->get();
        }


        $interview = DB::table('candidate_applications')
        			->leftJoin('employerjobposts', function ($join){
        				$join->on('employerjobposts.jobpost_id', '=','candidate_applications.jobpost_id');
        			})
		            ->where(
						['candidate_applications.candidate_profile_id' => Session::get('user.candidateprofileid'),
						'candidate_applications.emp_status' => 'interview_invite'])
		            ->select('candidate_applications.*', 'employerjobposts.*')
		            ->take(5)->get();

		$applied_jobs = DB::table('candidate_applications')
		            ->where(
						['candidate_profile_id' => Session::get('user.candidateprofileid'),
						'status' => 'applied'])
		            ->lists('jobpost_id');
		$shared_job = DB::table('referrals')
			->leftJoin('employerjobposts','referrals.jobpost_id', '=', 'employerjobposts.jobpost_id')
	        ->leftJoin('candidate_savedapplications', function ($join){
	        	$join->on('candidate_savedapplications.jobpost_id', '=', 'employerjobposts.jobpost_id')
	        	->where('candidate_savedapplications.candidate_profile_id', '=' , Session::get('user.candidateprofileid'));
	        })
	        ->where([
					'referral_type' => 'job',
					'referral_email' => Session::get('user.email'),
					'referral_status' => 'invited'])
			->whereNotIn('referrals.jobpost_id', $applied_jobs)
	        ->select('employerjobposts.*', 'referrals.candidate_email as refered_by',
	        	DB::raw("GROUP_CONCAT(candidate_email) ReferedByGroup"),
	        	DB::raw("count(*) as total_count"),
	        	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_country and lookup_type = 'country') as job_country"),
	        	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_category and lookup_type = 'job_category') as job_category"),
	        	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_level and lookup_type = 'job_level') as job_level"),
	        	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_type and lookup_type = 'job_type') as job_type"),
	        	'candidate_savedapplications.candidate_saved_application_id')
	        ->groupBy('referrals.jobpost_id')
	        ->take(5)->get();
		//dd($shared_job);
	    $referal_fee = parent::getSystemSetting('friend_referral_fee');
	    $job_fee = parent::getSystemSetting('job_referral_fee');
		$refered_count = DB::table('referrals')->where([
									'referral_type' => 'applicant',
									'candidate_profile_id' => Session::get('user.candidateprofileid'),
									'referral_status' => 'completed'])->count() * $referal_fee;
		$refered_download_count = DB::table('referrals')->where([
									'referral_type' => 'applicant',
									'candidate_profile_id' => Session::get('user.candidateprofileid'),
									'referral_status' => 'completed'])->sum('resume_downloads') * $referal_fee;

		$job_refered_count = DB::table('referrals')->where([
									'referral_type' => 'job',
									'candidate_profile_id' => Session::get('user.candidateprofileid'),
									'referral_status' => 'applied'])->count() * $job_fee;

		$job_refered_download_count = DB::table('referrals')->where([
									'referral_type' => 'job',
									'candidate_profile_id' => Session::get('user.candidateprofileid'),
									'referral_status' => 'applied'])->sum('resume_downloads') * $job_fee;
		$workexp = DB::table('candidateworkexps')->where('candidate_profile_id', $candidate_profile_id)->orderBy('start_date', 'desc')->get();
		$education = DB::table('candidateeducations')->where('candidate_profile_id', $candidate_profile_id)->orderBy('enrolldate', 'desc')->get();
		if(!$userprofile->core_skills || count($education) == 0){
			$profileIncomplete = '0';
		}else{
			$profileIncomplete = '1';
		}
		$options = array(
			'userprofile' => $userprofile,
			'workexp' => $workexp,
			'post_details' => $posts,
			'interview_details' => $interview,
			'shared_job' => $shared_job,
			'refered_count' => $refered_count,
			'job_refered_count' => $job_refered_count,
			'refered_download_count' => $refered_download_count,
			'job_refered_download_count' => $job_refered_download_count,
			'profileIncomplete' => $profileIncomplete
			);
		//return view('candidate.home', $options);
		return view('template.candidate.dashboard', $options);
	}

	public function profile($mode=null, $pdf = null){

		$candidate_profile_id = Session::get('user.candidateprofileid');
		$userprofile = DB::table('candidateprofiles')->where('candidate_profile_id', $candidate_profile_id)->first();
		$workexp = DB::table('candidateworkexps')->where('candidate_profile_id', $candidate_profile_id)->orderBy('start_date', 'desc')->get();

		foreach ($workexp as $key => $value) {
			$workskill = DB::table('additionalskills')->where('candidate_profile_id', $candidate_profile_id)
															->where('parent_table', 'candidateworkexps')
															->where('parent_id', $value->candidate_workexp_id)->get();
			$workexp[$key]->additionalskills = $workskill;
		}

		//dd($workexp);
		$education = DB::table('candidateeducations')->where('candidate_profile_id', $candidate_profile_id)->orderBy('enrolldate', 'desc')->get();

		foreach ($education as $key => $value) {
			$eduskill = DB::table('additionalskills')->where('candidate_profile_id', $candidate_profile_id)
															->where('parent_table', 'candidateeducations')
															->where('parent_id', $value->candidate_educ_id)->get();
			$education[$key]->additionalskills = $eduskill;
		}
		$additionalskill = DB::table('additionalskills')->where('candidate_profile_id', $candidate_profile_id)
														->whereNull('parent_table')->get();

        $languageskill = DB::table('candidate_languages')->where('candidate_profile_id', $candidate_profile_id)->get();
        $account = DB::table('accounts')->where('account_id',$userprofile->account_id)->first();
		//$userprofile = array();
		$options = array(
			'email' => $account->email,
			'userprofile' => $userprofile,
			'userprofile_json' => addslashes(json_encode($userprofile)),
			'workexp' => $workexp,
			'workexp_json' => addslashes(json_encode($workexp)),
			'education' => $education,
			'education_json' => addslashes(json_encode($education)),
			'additionalskill' => $additionalskill,
			'languageskill'	=> $languageskill,
			'language_json' => addslashes(json_encode($languageskill)),
		);
		$options['country'] = parent::genlookuplist('Please select a country', 'country');
		$options['job_category'] = parent::genlookuplist('Select job category', 'job_category');
		$options['job_level'] = parent::genlookuplist('Select position level', 'job_level');
		$options['job_type'] = parent::genlookuplist('Select job type', 'job_type');
		$options['currency'] = parent::genlookuplist('Please Select', 'currency');

		$options['study_field'] = parent::genlookuplist(trans('front/candidate.ph_field_of_field'), 'study_field');
		$options['degree'] = parent::genlookuplist(trans('front/candidate.ph_degree'), 'degree');
		$options['race'] = parent::genlookuplist('Please Select', 'race');
		$options['industry'] = parent::genlookuplist('Please Select Job Industry', 'industry');

		$options['language'] = parent::genlookuplist('Please Select Language', 'language');
		$options['lang_skill_level'] = parent::genlookuplist('Please Select Skill Level', 'lang_skill_level');


		if($options['userprofile']->core_skills){
			$core_skills = explode('|', $options['userprofile']->core_skills);
			$options['core_skills'] = json_encode($core_skills);

			$core_skills_text = '';
			foreach ($core_skills as $key=>$skill) {
				if($key > 0) $core_skills_text .= ', ';
				$core_skills_text .=  parent::getlookupname($skill,'core_skill');
			}
			$options['core_skills_list'] = $core_skills_text;
		}else{
			$options['core_skills'] = json_encode([]);
			$options['core_skills_list'] = '';
		}


		if($mode == 'edit'){
			//return view('front.viewcandidate',$options);
			return view('template.candidate.edit_profile',$options);
		}else {
			if($pdf) {

				$view = View::make('front.resumetemplate', $options);
		        $html = $view->render();
		        return $html;
				//return PDF::loadView('front.viewprofile',$options)->save(storage_path().'/my_stored_file.pdf');
			}
			//return view('front.viewprofile',$options);
			return view('template.candidate.my_resume',$options);
		}
	}

	public function autocomplete(Request $request, $type, $val = null){
		$query_string = $request->input();
		$search_array = ['lookup_type' => $type, 'active_ind' => '1'];
		$lookup_data = DB::table('lookups')
						->where(function ($query) use ($search_array, $query_string, $val) {
				                $query->where($search_array);
				                if(isset($query_string['keyword'])) {
				                      $query->where('lookup_name', 'LIKE' , '%'.$query_string['keyword'].'%');
				                  }
				                  if($val){
				                  	$query->where('lookup_code', '=' , $val);
				                  }
				            })
						->select('lookup_code as id', 'lookup_name as text')->get();
		return array('incomplete_results' => false ,'items' => $lookup_data, 'total_count' => '3' );
		//return parent::genlookuplist('NONE', $type, null ,$query_string['term']);
	}

	public function showinterview(){
		$interview = DB::table('candidate_applications')
        			->leftJoin('employerjobposts', function ($join){
        				$join->on('employerjobposts.jobpost_id', '=','candidate_applications.jobpost_id');
        			})
		            ->where(
						['candidate_applications.candidate_profile_id' => Session::get('user.candidateprofileid'),
						'candidate_applications.emp_status' => 'interview_invite'])
		            ->select('candidate_applications.*', 'employerjobposts.*')
		            ->get();
		//dd($interview);
		$options = array(
			'interview_details' => $interview,
			);
		return view('candidate.interview', $options);
	}

	public function showChangePassword(){
		$candidate_profile_id = Session::get('user.candidateprofileid');
		$userprofile = DB::table('candidateprofiles')->where('candidate_profile_id', $candidate_profile_id)->first();
		$options = array(
			'userprofile' => $userprofile);
		return view('template.candidate.change_password', $options);
	}

	public function removecandidatedata(){
		//dd($_POST);
		switch ($_POST['module']) {
			case 'SCHOOL':
				DB::table('candidateeducations')->where('candidate_educ_id', '=', $_POST['id'])->delete();
				DB::table('additionalskills')->where('parent_id', '=', $_POST['id'])->where('parent_table', '=', 'CandidateEducations')->delete();
				return ['status'=> 'success'];
				break;
			case 'WORK':
				DB::table('candidateworkexps')->where('candidate_workexp_id', '=', $_POST['id'])->delete();
				DB::table('additionalskills')->where('parent_id', '=', $_POST['id'])->where('parent_table', '=', 'CandidateWorkexps')->delete();
				return ['status'=> 'success'];
				break;
			case 'LANGUAGE':
				DB::table('candidate_languages')->where('candidate_lang_id', '=', $_POST['id'])->delete();
				break;
			default:
				# code...
				break;
		}
	}

	public function savecandidate(Request $request){

		if(!empty($_POST['skill_deletelist'])){
			$skilllist = json_decode($_POST['skill_deletelist']);
			foreach ($skilllist as $key => $value) {
				DB::table('additionalskills')->where('skill_id', '=', $value)->delete();
			}
		}
		switch ($_POST['formtype']) {
			case 'work':
				$data_array = [
						'employername' => $_POST['employername'],
					   	'industry' => $_POST['industry'],
					   	'city' => $_POST['city'],
					   	'country' => $_POST['country'],
					   	'state' => $_POST['state'],
					   	'position' => $_POST['position'],
					   	'salary' => $_POST['salary'],
					   	'start_date' => date("Y-m-d", strtotime($_POST['start_date'])),
						];
				if(array_key_exists('still_working', $_POST))
					$data_array['still_working'] = $_POST['still_working'];
				if($_POST['still_working'] == 'N')
					$data_array['end_date'] = date("Y-m-d", strtotime($_POST['end_date']));

				if($_POST['candidate_workexp_id']){
					DB::table('candidateworkexps')->where('candidate_workexp_id', $_POST['candidate_workexp_id'])->update($data_array);
					$workexp_id = $_POST['candidate_workexp_id'];
				}else{
					$data_array['candidate_profile_id'] = $_POST['candidate_profile_id'];
					$workexp_id = DB::table('candidateworkexps')->insertGetId($data_array);
				}

				if(!empty($_POST['skill_list'])){
					$skilllist = json_decode($_POST['skill_list']);
					foreach ($skilllist as $key => $value) {
						$temp_array = array();
						$temp_array['content'] = $value->content;
						$temp_array['candidate_profile_id'] = $_POST['candidate_profile_id'];
						$temp_array['parent_id'] = $workexp_id;
						$temp_array['parent_table'] = 'candidateworkexps';
						if(array_key_exists('skill_id', $value) && !empty($value->skill_id)){
							DB::table('additionalskills')->where('skill_id', $value->skill_id)->update($temp_array);
						}else{
							DB::table('additionalskills')->insert($temp_array);
						}
					}
				}
				break;
			case 'school':
				$data_array = [
				    'degree' => $_POST['degree'],
				   	'school_type' => $_POST['school_type'],
				   	'school_name' => $_POST['school_name'],
				   	'city' => $_POST['city'],
				   	'country' => $_POST['country'],
				   	'state' => $_POST['state'],
				   	'field_of_study' => $_POST['field_of_study'],
				   	'enrolldate' => date("Y-m-d", strtotime($_POST['enrolldate'])),
				   	'grad_date' => date("Y-m-d", strtotime($_POST['grad_date'])),
				   	'exp_graddate' => date("Y-m-d", strtotime($_POST['exp_graddate'])),
				   	'is_graduated' => $_POST['is_graduated'],
				   	'lastenrollyear' => date("Y-m-d", strtotime($_POST['lastenrollyear']))
				    ];

				    if( array_key_exists('still_studying', $_POST) )
				    	$data_array['still_studying']  = $_POST['still_studying'];

				    if(array_key_exists('future_study', $_POST))
						$data_array['future_study']  = 'Y';
					else
						$data_array['future_study']  = 'N';

				if($_POST['candidate_educ_id']){
					DB::table('candidateeducations')->where('candidate_educ_id', $_POST['candidate_educ_id'])->update($data_array);
					$school_id = $_POST['candidate_educ_id'];
				}else{
					$data_array['candidate_profile_id'] = $_POST['candidate_profile_id'];
					$school_id = DB::table('candidateeducations')->insertGetId($data_array);
				}

				if(!empty($_POST['skill_list'])){
					$skilllist = json_decode($_POST['skill_list']);
					foreach ($skilllist as $key => $value) {
						$temp_array = array();
						$temp_array['content'] = $value->content;
						$temp_array['candidate_profile_id'] = $_POST['candidate_profile_id'];
						$temp_array['parent_id'] = $school_id;
						$temp_array['parent_table'] = 'candidateeducations';
						if(array_key_exists('skill_id', $value) && !empty($value->skill_id)){
							DB::table('additionalskills')->where('skill_id', $value->skill_id)->update($temp_array);
						}else{
							DB::table('additionalskills')->insert($temp_array);
						}
					}
				}

				break;
			case 'skill':
				$core_skills = '';
				foreach ($_POST['core_skills'] as $key => $value) {
					if($core_skills != '') $core_skills .= '|';
					$core_skills .= $value;
				}
				DB::table('candidateprofiles')->where('candidate_profile_id', $_POST['candidate_profile_id'])
				->update([
					'core_skills' => $core_skills
					]);
				if(!empty($_POST['skill_list'])){
					$skilllist = json_decode($_POST['skill_list']);
					foreach ($skilllist as $key => $value) {
						$temp_array = array();
						$temp_array['content'] = $value->content;
						$temp_array['candidate_profile_id'] = $_POST['candidate_profile_id'];
						//$temp_array['parent_id'] = $school_id;
						//$temp_array['parent_table'] = 'CandidateEducations';
						if(array_key_exists('skill_id', $value) && !empty($value->skill_id)){
							DB::table('additionalskills')->where('skill_id', $value->skill_id)->update($temp_array);
						}else{
							DB::table('additionalskills')->insert($temp_array);
						}
					}
				}
				break;
			case 'bank_details':
				DB::table('candidateprofiles')->where('candidate_profile_id', $_POST['candidate_profile_id'])
				->update([
					'acc_no' => $_POST['acc_no'],
					'acc_name' => $_POST['acc_name'],
					'bank' => $_POST['bank'],
					]);
				return redirect()->route('candidatehome');
				break;
			case 'language':
				$data_array = [
				   	'language_code' => $_POST['language_code'],
				   	'spoken_level' => $_POST['spoken_level'],
				   	'written_level' => $_POST['written_level']
				    ];
				if($_POST['candidate_lang_id']){
					DB::table('candidate_languages')->where('candidate_lang_id', $_POST['candidate_lang_id'])->update($data_array);
				}else{
					$data_array['candidate_profile_id'] = $_POST['candidate_profile_id'];
					DB::table('candidate_languages')->insertGetId($data_array);
				}
				break;
			case 'contact':
				$storagepath = "candidate/".$_POST['candidate_profile_id']."-profile-picture.jpg?versionId=null";
				if($_POST['image_uploaded'] == 'YES'){
					if(isset($_FILES['product_image'])) {
						parent::removefromAS3($storagepath);
						if(!parent::uploadtoAS3($storagepath, $_FILES['product_image']['type'], $_FILES['product_image']['tmp_name'])){
							$storagepath = "";
						}
				    }
				}else{
					parent::removefromAS3($storagepath);
					$product_data['product_image'] = '';
					$storagepath = '';
				}
				DB::table('candidateprofiles')->where('candidate_profile_id', $_POST['candidate_profile_id'])
				->update([
					'firstname' => $_POST['firstname'],
					'lastname' => $_POST['lastname'],
					'mobile' => $_POST['mobile'],
					'address1' =>$_POST['address1'],
					'address2' =>$_POST['address2'],
					'city' =>$_POST['city'],
					'state' =>$_POST['state'],
					'country' =>$_POST['country'],
					'zipcode' =>$_POST['zipcode'],
					'gender' => $_POST['gender'],
					'date_of_birth' => date("Y-m-d", strtotime($_POST['date_of_birth'])),
					'race' => $_POST['race'],
					'profile_picture' => $storagepath
					]);
				break;
			case 'preference':
				//dd($_POST);
				DB::table('candidateprofiles')->where('candidate_profile_id', $_POST['candidate_profile_id'])
				->update([
					'prefered_industry' => $_POST['prefered_industry'],
					'prefered_category' => $_POST['prefered_category'],
					'prefered_level' => $_POST['prefered_level'],
					'prefered_type' => $_POST['prefered_type'],
					'prefered_salary_currency' => $_POST['prefered_salary_currency'],
					'prefered_salary' =>$_POST['prefered_salary'],
					'prefered_location' =>$_POST['prefered_location'],
					'prefered_location2' =>$_POST['prefered_location2'],
					'prefered_location3' =>$_POST['prefered_location3'],
					'about_myself' => $_POST['about_myself'],

					]);
				Session::set('user.prefered.job_category', $_POST['prefered_category']);
				Session::set('user.prefered.job_level', $_POST['prefered_level']);
				Session::set('user.prefered.job_type', $_POST['prefered_type']);
				Session::set('user.prefered.salary_currency', $_POST['prefered_salary_currency']);
				Session::set('user.prefered.salary', $_POST['prefered_salary']);
				Session::set('user.prefered.job_country', $_POST['prefered_location']);
				break;
			case 'password':
				//validate the password
				$account = Account::find(Session::get('user.accountid'));
				//dd($account);
				if($account->password == $_POST['old_password']){
					$account->password = $request['password'];
					$account->save();
					session()->flash('status', 'true');
					return redirect()->route('candidate_change_password');
    			}else{
    				session()->flash('mismatch', 'true');
    				return redirect()->route('candidate_change_password');
    			}
				break;
			default:
				# code...
				break;
		}
		return ($_POST);

	}

	public function jobsearch(Request $request,$mode=null){
		$jobpost_condition_array = ['employerjobposts.status' => 'Posted'];
		$search_array = ['employerjobposts.status' => 'Posted'];
		$col_name = 'employerjobposts.status'; $operator = '='; $col_value = 'Posted';
		$queryString = '';
		$options['selected_category'] = '';
		$options['selected_level'] = '';
		$options['selected_type'] = '';
		$options['selected_keyword'] = '';
		$options['selected_location'] = '';
		$options['selected_since'] = '';
		//dd($request->server('REDIRECT_QUERY_STRING'));
		$query_string = $request->input();
		//dd($request);
		foreach ($query_string as $key => $value) {
			switch ($key) {
				case 'category':
					if($value) $search_array['employerjobposts.job_category'] = $value;
					$options['selected_category'] = $value;
					break;
				case 'level':
					if($value) $search_array['employerjobposts.job_level'] = $value;
					$options['selected_level'] = $value;
					break;
				case 'type':
					if($value) $search_array['employerjobposts.job_type'] = $value;
					$options['selected_type'] = $value;
					break;
				case 'keyword':
					if($value) $search_array['employerjobposts.job_title'] = $value;
					$options['selected_keyword'] = $value;
					break;
				case 'location':
					if($value) $search_array['employerjobposts.job_city'] = $value;
					$options['selected_location'] = $value;
					break;
				case 'since':
					$options['selected_since'] = $value;
					$date=date_create();
					date_sub($date,date_interval_create_from_date_string($value." days"));
					$col_value = date_format($date,"Y-m-d");
					$col_name = 'employerjobposts.posted_at'; $operator = '>';
					break;
				default:
					# code...
					break;
			}
		}
		$result_size = ($request->has('size'))? $query_string['size']: $this->pageSize;
		$options['size'] = $result_size;
		$sort = ($request->has('sort'))? $query_string['sort']: 'posted_at';
		$options['sort'] = $sort;
		//dd($jobpost_condition_array);
		switch ($mode) {
			case 'shortlisted':
				$posts = DB::table('employerjobposts')
		            ->rightJoin('candidate_savedapplications', function ($join){
		            	$join->on('candidate_savedapplications.jobpost_id', '=', 'employerjobposts.jobpost_id')
		            	->where('candidate_savedapplications.candidate_profile_id', '=' , Session::get('user.candidateprofileid'));
		            })
		            ->where($jobpost_condition_array)
		            ->select('employerjobposts.*',
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_country and lookup_type = 'country') as job_country"),
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_category and lookup_type = 'job_category') as job_category"),
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_level and lookup_type = 'job_level') as job_level"),
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_type and lookup_type = 'job_type') as job_type"),
		            	'candidate_savedapplications.candidate_saved_application_id')
		            ->paginate($result_size);
		        $options['breadcrumb'] = 'Saved Jobs';
				break;
			case 'applied':
				$posts = DB::table('candidate_applications')
		            ->leftJoin('employerjobposts', function ($join){
		            	$join->on('candidate_applications.jobpost_id', '=', 'employerjobposts.jobpost_id')
		            	->where('candidate_applications.candidate_profile_id', '=' , Session::get('user.candidateprofileid'));
		            })
		            ->leftJoin('candidate_savedapplications', function ($join){
		            	$join->on('candidate_savedapplications.jobpost_id', '=', 'candidate_applications.jobpost_id')
		            	->where('candidate_savedapplications.candidate_profile_id', '=' , Session::get('user.candidateprofileid'));
		            })
		            ->where($jobpost_condition_array)
		            ->select('employerjobposts.*',
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_country and lookup_type = 'country') as job_country"),
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_category and lookup_type = 'job_category') as job_category"),
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_level and lookup_type = 'job_level') as job_level"),
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_type and lookup_type = 'job_type') as job_type"),
		            	'candidate_savedapplications.candidate_saved_application_id', 'candidate_applications.status as candidate_applications_status')
		            ->paginate($result_size);
		        $options['breadcrumb'] = 'Applied Jobs';
				break;
			case 'recommended':
				$userpreference = Session::get('user.prefered');
				$recommended_condition = array();
				foreach ($userpreference as $key => $value) {
					if($value && $key!= 'salary') $recommended_condition['employerjobposts.'.$key] = $value;
				}
				$jobpost_condition_array = array_merge($jobpost_condition_array, $recommended_condition);
				//dd($jobpost_condition_array);
				$pref_salary = Session::get('user.prefered.salary');
				$posts = array();
				if(count($recommended_condition) > 0 || $pref_salary > 0){
				$posts = DB::table('employerjobposts')
		            ->leftJoin('candidate_savedapplications', function ($join){
		            	$join->on('candidate_savedapplications.jobpost_id', '=', 'employerjobposts.jobpost_id')
		            	->where('candidate_savedapplications.candidate_profile_id', '=' , Session::get('user.candidateprofileid'));
		            })
		            ->where(function ($query) use ($jobpost_condition_array, $pref_salary) {
				                $query->where($jobpost_condition_array);
				                if($pref_salary > 0){
				                      $query->where('employerjobposts.salary_max', '>=' , $pref_salary);
				                  }
				            })
		            ->select('employerjobposts.*',
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_country and lookup_type = 'country') as job_country"),
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_category and lookup_type = 'job_category') as job_category"),
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_level and lookup_type = 'job_level') as job_level"),
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_type and lookup_type = 'job_type') as job_type"),
		            	'candidate_savedapplications.candidate_saved_application_id')
		            ->paginate($result_size);
		        }
		        $options['breadcrumb'] = 'Recommended Jobs';
				break;
			default:
				$posts = DB::table('employerjobposts')
		            ->leftJoin('candidate_savedapplications', function ($join){
		            	$join->on('candidate_savedapplications.jobpost_id', '=', 'employerjobposts.jobpost_id')
		            	->where('candidate_savedapplications.candidate_profile_id', '=' , Session::get('user.candidateprofileid'));
		            })
		            ->where($jobpost_condition_array)
		            //->where($search_array)
		            //->where($col_name, $operator , $col_value)

		            ->where(function ($query) use ($query_string){
		            	$query->where(['employerjobposts.status' => 'Posted']);
		            	foreach ($query_string as $key => $value) {
							switch ($key) {
								case 'category':
									if($value)
										$query->where('employerjobposts.job_category', '=', $value);
									break;
								case 'level':
									if($value)
										$query->where('employerjobposts.job_level', '=', $value);
										//$query->whereIn('employerjobposts.job_level', $value);
									break;
								case 'type':
									if($value)
										$query->where('employerjobposts.job_type', '=', $value);
									break;
								case 'keyword':
									if($value)
										$query->where('employerjobposts.job_title', 'LIKE', '%'.$value.'%');
									break;
								case 'location':
									if($value)
										$query->where('employerjobposts.job_city', 'LIKE', '%'.$value.'%');
									break;
								case 'since':
									$date=date_create();
									date_sub($date,date_interval_create_from_date_string($value." days"));
									$col_value = date_format($date,"Y-m-d");
									$col_name = 'employerjobposts.posted_at'; $operator = '>';
									$query->where('employerjobposts.posted_at', '>', $col_value);
									break;
								default:
									# code...
									break;
							}
						}
		            })
		            ->select('employerjobposts.*',
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_country and lookup_type = 'country') as job_country"),
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_category and lookup_type = 'job_category') as job_category"),
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_level and lookup_type = 'job_level') as job_level"),
		            	DB::raw("(select lookup_name from lookups where lookup_code = employerjobposts.job_type and lookup_type = 'job_type') as job_type"),
		            	'candidate_savedapplications.candidate_saved_application_id')
		            ->orderBy( 'employerjobposts.'.$sort, 'desc')
		            ->paginate($result_size);
		        $options['breadcrumb'] = 'Job Search';
				break;
		}
		$options['mode'] = $mode;
		$options['post_details'] = $posts;
		$options['job_type'] = parent::genlookuplist('NONE', 'job_type');
		$options['job_level'] = parent::genlookuplist('NONE', 'job_level');
		$options['job_category'] = parent::genlookuplist('NONE', 'job_category');
		$options['job_since'] = ['1' => 'Last 24 hours', '7' => 'Last 7 days', '15' => 'Last 15 days', '30' => 'Last 30 days'];
		//return view('post.jobsearch', $options);
		$candidate_profile_id = Session::get('user.candidateprofileid');
		$options['userprofile'] = DB::table('candidateprofiles')->where('candidate_profile_id', $candidate_profile_id)->first();
		$options['workexp'] = DB::table('candidateworkexps')->where('candidate_profile_id', $candidate_profile_id)->orderBy('start_date', 'desc')->get();
		//dd($options);
		//return view('post.jobsearch', $options);
		return view('template.candidate.joblist', $options);
	}


	public function jobshortlist($id, $action, $parmeter1=null){
		//dd($_POST);
		if(isset($_POST['employer_profile_id'])) $employer_profile_id = $_POST['employer_profile_id'];
		if(isset($_POST['candidate_application_id'])) $candidate_application_id = $_POST['candidate_application_id'];
		switch ($action) {
			case 'save':
				$post_id = DB::table('candidate_savedapplications')->insertGetId([
					'candidate_profile_id' => Session::get('user.candidateprofileid'),
					'jobpost_id' => $id,
					'created_at' => date("Y-m-d H:i:s")
				]);
				break;
			case 'delete':
				DB::table('candidate_savedapplications')->where([
				    'candidate_profile_id' => Session::get('user.candidateprofileid'),
				    'jobpost_id' => $id
				])->delete();
				break;
			case 'apply':
				if($candidate_application_id){
					DB::table('candidate_applications')
		            ->where('candidate_application_id', $candidate_application_id)
		            ->update(
		            	['status' => 'applied',
		            	'updated_at' => date("Y-m-d H:i:s")
		            	]);
				}else{
					$post_id = DB::table('candidate_applications')->insertGetId([
						'candidate_profile_id' => Session::get('user.candidateprofileid'),
						'employer_profile_id' => $employer_profile_id,
						'jobpost_id' => $id,
						'status' => 'applied',
						'created_at' => date("Y-m-d H:i:s")
					]);
					//process referral
					if((isset($_POST['referralkey']) && $_POST['referralkey'] != '')|| (isset($_POST['referral_email']) && $_POST['referral_email'] != '')){
						$referralkey = $_POST['referralkey'];
						$decrypted_referralkey = '';
						if(!empty($_POST['referral_email'])) {
							$decrypted_referralkey = $_POST['referral_email'];
						}else{
							$decrypted_referralkey = Crypt::decrypt($referralkey);
						}
						if($decrypted_referralkey != ''){
							$refered_data = DB::table('referrals')->where([
													'referral_type' => 'job',
													'jobpost_id' => $id,
													'candidate_email' => $decrypted_referralkey,
													'referral_email' => Session::get('user.email'),
													'referral_status' => 'invited'])
								->update(['referral_status' => 'applied', 'updated_at' => date('Y-m-d')]);
						}
					}
					//..
				}
				return ["url" =>  URL::to('/jobsearch/applied') ];
				break;
			case 'withdraw':
				DB::table('candidate_applications')
	            ->where('candidate_application_id', $candidate_application_id)
	            ->update(
	            	['status' => 'withdrawn',
	            	'updated_at' => date("Y-m-d H:i:s")
	            	]);
	            return ["url" =>  URL::to('/jobsearch/applied') ];
				break;
			default:
				# code...
				break;
		}
		return 'true';
	}
}
