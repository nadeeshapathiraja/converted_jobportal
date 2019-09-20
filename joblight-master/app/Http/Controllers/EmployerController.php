<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB, Session, Crypt, PDF;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\MailController;
class EmployerController extends Controller {

	
	public function setSession(){
		$employer_profile_id = Session::get('user.employer_profile_id');
		//$employer_profile_id = 1;
		$employerprofiles = DB::table('employerprofiles')->where('employer_profile_id', $employer_profile_id)->first();	
		
		$options = array(
			'employerprofiles' => $employerprofiles,
			'employerprofiles_json' => addslashes(json_encode($employerprofiles))	
		);
		return $options;
	}

	private function initSession($account_id, $account_status){
		$userprofile = DB::table('employerprofiles')->where('account_id', $account_id)->first();
		Session::set('user.accountid', $userprofile->account_id);
		Session::set('user.name', $userprofile->name);
		Session::set('user.contact_person', $userprofile->contact_person);
		Session::set('user.contact_email', $userprofile->contact_email);
		Session::set('user.contact_number', $userprofile->contact_number);
		Session::set('user.employer_profile_id', $userprofile->employer_profile_id);
		Session::set('user.email', $userprofile->contact_email);
		Session::set('user.login_type', 'employer');
		Session::set('user.active', $account_status);
	}

	public function login(){

		$users = parent::callAPI('login');						  		
		if($users){								 
			$this->initSession($users->account_id, $users->account_status);		 
			return redirect()->route('employerhome');
		}
		else{
			session()->flash('loginstatus', 'Login Failed!');
			return redirect()->route('employerlogin');
		}
	}

	public function render_signup(){
		$employer_type = parent::genlookuplist('Select employer type' , 'employer_type');				
		$employer_industry = parent::genlookuplist('Select an industry' , 'employer_industry');
        $country = parent::genlookuplist('Please select a country' , 'country');        
        $options = array(            
            'employer_type' => $employer_type,
            'employer_industry' => $employer_industry, 
            'country' => $country,
            'mode' => 'NEW',
            'employerprofiles_json' => ''
        );          
        //return view('employer.signup', $options);
        return view('template.employer.profile', $options);
	}
	public function editprofile($id){		
		$employerprofiles = DB::table('employerprofiles')->where('employer_profile_id', $id)->first();	
		$employer_type = parent::genlookuplist('Select employer type' , 'employer_type');				
		$employer_industry = parent::genlookuplist('Select an industry' , 'employer_industry');
        $country = parent::genlookuplist('Please select a country' , 'country');        
        $options = array(            
            'employer_type' => $employer_type,
            'employer_industry' => $employer_industry, 
            'country' => $country,
            'mode' => 'EDIT',
            'employerprofiles_json' => addslashes(json_encode($employerprofiles)),		
        );		
        $option_inc = $this->setSession();	
        $options = array_merge($options, $option_inc);
		//return view('employer.signup', $options);
		return view('template.employer.profile', $options);
	}
	public function updateprofile(){		
		$storagepath = "employer/".$_POST['employer_profile_id']."-profile-logo.jpg?versionId=null";
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
		DB::table('employerprofiles')->where('employer_profile_id', $_POST['employer_profile_id'])
				->update([
					'contact_person' => $_POST['contact_person'],
					'contact_position' => $_POST['contact_position'],				   	
				   	'contact_number' => $_POST['contact_number'],
				   	'name' => $_POST['name'],
					'recruitment_type' => $_POST['recruitment_type'],
				   	'industry' => $_POST['industry'],
				   	'address' => $_POST['address'],
					'city' => $_POST['city'],
					'zip' => $_POST['zip'],
				   	'state' => $_POST['state'],
				   	'country' => $_POST['country'],
					'crunchbase_url' => $_POST['crunchbase_url'],
				   	'description' => $_POST['description'],
				   	'logo_url' => $storagepath
					]);	
		$this->initSession(Session::get('user.accountid'), Session::get('user.active'));			
		return redirect()->route('employerhome');		
	}

	public function signup(){ 
		$verify_key = Crypt::encrypt($_POST['contact_email']);
		$account_id = DB::table('accounts')->insertGetId(
					    ['email' => $_POST['contact_email'], 'password' => $_POST['password'], 
					    'account_type' => $_POST['account_type'],
					    'account_created_at' => date('Y-m-d H:i'),
					    'encrypted_key' => $verify_key
					    ]
					);
		$profile_id = DB::table('employerprofiles')->insertGetId(
				   ['account_id' => $account_id,
				   	'main_account' => 'Y',
				   	'credits' => '0',
				   	'contact_person' => $_POST['contact_person'],
					'contact_position' => $_POST['contact_position'],
				   	'contact_email' => $_POST['contact_email'],
				   	'contact_number' => $_POST['contact_number'],
				   	'name' => $_POST['name'],
					'recruitment_type' => $_POST['recruitment_type'],
				   	'industry' => $_POST['industry'],
				   	'address' => $_POST['address'],
					'city' => $_POST['city'],
					'zip' => $_POST['zip'],
				   	'state' => $_POST['state'],
				   	'country' => $_POST['country'],
					'crunchbase_url' => $_POST['crunchbase_url'],
				   	'description' => $_POST['description']				   	
				   	]
				);	
		$storagepath = "employer/".$profile_id."-profile-logo.jpg?versionId=null";
		if($_POST['image_uploaded'] == 'YES'){
			if(isset($_FILES['product_image'])) { 
				parent::removefromAS3($storagepath);
				if(!parent::uploadtoAS3($storagepath, $_FILES['product_image']['type'], $_FILES['product_image']['tmp_name'])){
					$storagepath = "";
				}else{
					DB::table('employerprofiles')->where('employer_profile_id', $profile_id)
						->update([ 'logo_url' => $storagepath ]);	
				}   					    	
		    }
		}
		$options = array('first_name' => $_POST['contact_person'],
					'last_name' =>  '',
					'role' => 'Employer',
					'action' => 'posting your first job ad',
					'email' => $_POST['contact_email'],
					'activation_url' => route('accountverification',['key' => $verify_key])
					 );
		MailController::sendactivationmail($options); 
		$this->initSession($account_id, '0');	
		return redirect()->route('employerhome');
				
	}

	public function employerhome(){
		$options = $this->setSession();		
		$options['no_posted'] = DB::table('employerjobposts')->where('employer_profile_id', Session::get('user.employer_profile_id'))->count();
		$options['no_downloaded'] = DB::table('employer_resume_downloads')->where('employer_profile_id', Session::get('user.employer_profile_id'))->count();
		$jobpost_id = DB::table('employerjobposts')->where('employer_profile_id', Session::get('user.employer_profile_id'))->select('jobpost_id')->get();
		$jobpost_id_only = [];
		foreach ($jobpost_id as $key => $value) {
			$jobpost_id_only[] = 	$value->jobpost_id;	
		}	
		//dd($jobpost_id_only);
		$allcount = DB::table('candidate_applications')->whereIn('jobpost_id' , $jobpost_id_only)->groupBy('jobpost_id')->select(DB::raw('count(*) as response'))->get();
		$allcount_only = ['0'];
		foreach ($allcount as $key => $value) {
			$allcount_only[] = 	$value->response;	
		}	
		//dd($allcount_only);
		$options['max_response'] = max($allcount_only); 		
		$options['min_response'] = min($allcount_only);
		$options['avg_response'] = round(array_sum($allcount_only) / count($allcount_only));
		$options['avg_spend_adv'] = ($options['no_posted'] === 0)? 0 : round($options['no_downloaded'] / $options['no_posted']);
		//return view('employer.main',$options);		
		return view('template.employer.dashboard',$options);		
	}

	public function postcreate(){
		$options = $this->setSession();	
		$options['country'] = parent::genlookuplist('Please select a country', 'country');
		$options['job_category'] = parent::genlookuplist('Select job category', 'job_category');
		$options['job_level'] = parent::genlookuplist('Select position level', 'job_level');
		$options['job_type'] = parent::genlookuplist('Select job type', 'job_type');
		$options['currency'] = parent::genlookuplist('NONE', 'currency');

		$options['post_json'] = addslashes(json_encode([]));
		//return view('post.postcreate',$options);		
		return view('template.job.job-post-new',$options);	
	}	

	public function postedit($id){
		$options = $this->setSession();	
		$options['country'] = parent::genlookuplist('Please select a country', 'country');
		$options['job_category'] = parent::genlookuplist('Select job category', 'job_category');
		$options['job_level'] = parent::genlookuplist('Select position level', 'job_level');
		$options['job_type'] = parent::genlookuplist('Select job type', 'job_type');
		$options['currency'] = parent::genlookuplist('NONE', 'currency');
		$post_detail = DB::table('employerjobposts')->where('jobpost_id', $id)->first();	
		//dd($post_detail);
		//$options['postdata'] = addslashes([$post_detail]);
		$options['post_json'] = addslashes(json_encode([$post_detail]));
		//return view('post.postcreate',$options);
		return view('template.job.job-post-new',$options);	
	}

	public function postsave(){		
	//dd($_POST);
		$data_array = ['employer_profile_id' => Session::get('user.employer_profile_id'), 
					'company_name' => Session::get('user.name'), 
					'locality_city' => $_POST['job_city'], 
					'locality_country' => $_POST['job_country'], 
					'job_title' => $_POST['job_title'], 
					'job_city' => $_POST['job_city'], 
					'job_state' => $_POST['job_state'], 
					'job_country' => $_POST['job_country'], 
					'job_category' => $_POST['job_category'], 
					'job_level' => $_POST['job_level'], 
					'job_type' => $_POST['job_type'], 
					'salary_currency' => $_POST['salary_currency'], 
					'salary_max' => $_POST['salary_max'], 
					'salary_min' => $_POST['salary_min'], 
					'job_description' => $_POST['job_description'], 
					//'logo_url' => $_POST['logo_url'], 
					//'banner_url' => $_POST['banner_url'], 
					//'application_receive_mode' => $_POST['application_receive_mode'], 					
					'status' => 'Draft',					
					'created_at' => date("Y-m-d H:i:s"),
					'created_by' => Session::get('user.employer_profile_id'), 
					'updated_at' => date("Y-m-d H:i:s"),
					'updated_by' => Session::get('user.employer_profile_id')
				    ];
		/*if($_POST['application_receive_mode'] == 'email'){
			$data_array['company_email'] = $_POST['company_email'];
			$data_array['notification_type'] = $_POST['notification_type'];			
		}		
		elseif($_POST['application_receive_mode'] == 'url')
			$data_array['company_url'] = $_POST['company_url'];		
		*/
		/*if($_POST['company_list'] == 'Confidential'){
			$data_array['is_confidential'] = 'Y';
		}*/

		if($_POST['jobpost_id']){
			$post_id = $_POST['jobpost_id'];
			DB::table('employerjobposts')->where('jobpost_id', $_POST['jobpost_id'])->update($data_array);			
		}else{
			$post_id = DB::table('employerjobposts')->insertGetId($data_array);
		}

		if(isset($_POST['draftList']) && $_POST['draftList'] == 'YES')	
			return redirect()->route('managepost', 'draft');
		else
			return redirect()->route('viewpost', ['post_id' => $post_id, 'post_name' => $_POST['job_title']]);				
	}

	public function confirmpost($id){
		//dd($_POST);
		DB::table('employerjobposts')
            ->where('jobpost_id', $id)
            ->update(
            	['status' => 'Posted',
            	'updated_at' => date("Y-m-d H:i:s"),
            	'updated_by' => Session::get('user.employer_profile_id'),
            	'posted_at' => date("Y-m-d H:i:s"),
            	'posted_by' => Session::get('user.employer_profile_id')
            	]);
		return redirect()->route('viewpost', ['post_id' => $id, 'post_name' => 'posts']);	            
	}

	public function deletepost($id){
		DB::table('employerjobposts')
            ->where('jobpost_id', $id)
            ->update(
            	['status' => 'Terminated',
            	'updated_at' => date("Y-m-d H:i:s"),
            	'updated_by' => Session::get('user.employer_profile_id')            	
            	]);
		return redirect()->route('managepost', ['mode' => 'terminated']);	   
	}

	public function managepost(Request $request, $mode){
		$options = $this->setSession();	
		$result_size = ($request->has('size'))? $request['size']: $this->pageSize;
		$options['size'] = $result_size;
		$posts = DB::table('employerjobposts as jp')			
			->where(
			['jp.employer_profile_id' => Session::get('user.employer_profile_id'),
			'jp.status' => $mode]
			)
			->select('jp.*', 
				 DB::raw('(select count(distinct candidate_profile_id) from candidate_applications where employer_profile_id = jp.employer_profile_id and status="applied" and emp_status is null and jobpost_id = jp.jobpost_id) as candidate_applied')
				,DB::raw('(select count(distinct candidate_profile_id) from candidate_applications where employer_profile_id = jp.employer_profile_id and status="applied" and emp_status = "shortlist" and jobpost_id = jp.jobpost_id) as shortisted_candidate')
				,DB::raw('(select count(distinct candidate_profile_id) from candidate_applications where employer_profile_id = jp.employer_profile_id and status="applied" and emp_status = "interview_invite" and jobpost_id = jp.jobpost_id) as interview_candidate')				
				,DB::raw('(select count(distinct candidate_profile_id) from candidate_applications where employer_profile_id = jp.employer_profile_id and status="applied" and emp_status = "not_suitable" and jobpost_id = jp.jobpost_id) as notsuitable_candidate')				
			)
			->paginate($result_size);
		$options['post_details'] = $posts;
		$options['mode'] = strtoupper($mode);
		//return view('employer.managejob',$options);
		return view('template.employer.managejob',$options);	
	}

	public function processCandidate($id, $emp_status, $mode = 'employer'){	
		if($mode == 'employer'){
			$update_columns = ['emp_status' => $emp_status, 
					'emp_action_by' => Session::get('user.employer_profile_id'), 
					'emp_action_at' => date("Y-m-d H:i:s")];
		}else if($mode == 'interview'){
			$update_columns = ['interview_status' => $emp_status, 					
					'cand_action_at' => date("Y-m-d H:i:s")];
		}

		$posts = DB::table('candidate_applications')			
			->where('candidate_application_id', $id)
			->update($update_columns);		
        return 	redirect()->back();				
	}

	public function managecandidate(Request $request, $job_id, $emp_status = null){
		$options = $this->setSession();	
		$options = $this->setSession();	
		$result_size = ($request->has('size'))? $request['size']: $this->pageSize;
		$posts = DB::table('candidate_applications')
					->leftJoin('candidateprofiles', function ($join){
		            	$join->on('candidate_applications.candidate_profile_id', '=', 'candidateprofiles.candidate_profile_id');
		            })		            
		            ->where(
						['candidate_applications.employer_profile_id' => Session::get('user.employer_profile_id'),
						'candidate_applications.jobpost_id' => $job_id,
						'candidate_applications.emp_status' => $emp_status,
						'candidate_applications.status' => 'applied'
						])
		            ->select('candidate_applications.*', 'candidateprofiles.*')
		            ->paginate($result_size);
		
        $post_count = count($posts);
        for ($i=0; $i < $post_count ; $i++) { 
        	$edu = DB::table('candidateeducations')->where('candidate_profile_id',$posts[$i]->candidate_profile_id)->orderBy('enrolldate', 'desc')->take(2)->get();
        	$posts[$i]->education = $edu;
        	$work = DB::table('candidateworkexps')->where('candidate_profile_id',$posts[$i]->candidate_profile_id)->orderBy('start_date', 'desc')->get();        				 			
			$total_exp_months = 0;
			for ($j=0; $j < count($work); $j++) { 
				$total_months = 0; 
				$d_start    = date_create($work[$j]->start_date); 
        		if($work[$j]->still_working == 'N'){        							    
				    $d_end      = date_create($work[$j]->end_date);
        		}else if($work[$j]->still_working == 'Y'){        			
        			$d_end      =date_create(date("Y-m-d"));
        		}
        		$diff = $d_start->diff($d_end); 			    			    				   
			    $total_months += $diff->format('%m'); 
			    $total_exp_months += $diff->format('%m'); 
			    $total_year = $total_months/12;        	
				$year = floor($total_year);     // 1
				$month = fmod($total_year, 12);
			    $work[$j]->total_years = $year." years ".substr(round($month, 1), 2)." months";			    
			}
			$posts[$i]->work = $work; 
			if($total_exp_months > 0){
				$total_exp_year = $total_exp_months/12;        	
				$year = floor($total_exp_year);     
				$month = fmod($total_exp_year, 12);					
			    $total_exp_year_word = $year." years ".substr(round($month, 1), 2)." months";
			}else{
				$total_exp_year_word = 'Nil';
			}
			$posts[$i]->total_years = $total_exp_year_word;

			//check if this candidate resume is downloaded by this employer and is valid..
			$resume_downloaded_ind = DB::table('employer_resume_downloads')->where([
				'candidate_profile_id' => $posts[$i]->candidate_profile_id, 
				'employer_profile_id' => Session::get('user.employer_profile_id')
				//'expiry_date' >= date("Y-m-d") 
				])->count();			
			$posts[$i]->resume_downloaded = $resume_downloaded_ind;

			//Coreskills 
			$core_skills = explode('|', $posts[$i]->core_skills);	
			$core_skills_text = '';		
			foreach ($core_skills as $key=>$skill) {
				if($key > 0) $core_skills_text .= ', ';
				$core_skills_text .=  parent::getlookupname($skill,'core_skill');				
			}
			$posts[$i]->core_skills_text = $core_skills_text;			
        	        	       	        
        }        

		$options['candidate_details'] = $posts;
		$jobdetails = DB::table('employerjobposts')->where('jobpost_id', '=', $job_id)->first();
		$options['mode'] = $jobdetails->job_title;
		$options['job_id'] = $job_id;
		$options['emp_status'] = $emp_status;
		$where_condition = ['employer_profile_id' => Session::get('user.employer_profile_id'), 'status' => 'applied', 'jobpost_id' => $job_id];
		$options['candidate_applied'] = DB::table('candidate_applications')->where($where_condition)->whereNull('emp_status')->distinct()->count();		
		$options['shortisted_candidate'] = DB::table('candidate_applications')->where($where_condition)->where('emp_status', 'shortlist')->distinct()->count();		
		$options['interview_candidate'] = DB::table('candidate_applications')->where($where_condition)->where('emp_status', 'interview_invite')->distinct()->count();
		$options['notsuitable_candidate'] = DB::table('candidate_applications')->where($where_condition)->where('emp_status', 'not_suitable')->distinct()->count();		
		//dd($options);
		//return view('employer.managecandidate',$options);	
		return view('template.employer.managecandidate',$options);	
	}

	public function viewpost($id,$title = null, $referralkey = null, $referral_email = null){
		$options = $this->setSession();	

		$post_detail = DB::table('employerjobposts')->where('jobpost_id', $id)->first();	
		$post_detail->job_category = parent::getlookupname($post_detail->job_category, 'job_category');
		$post_detail->job_level = parent::getlookupname($post_detail->job_level, 'job_level');
		$post_detail->job_type = parent::getlookupname($post_detail->job_type, 'job_type');

		$options['postdetails'] = $post_detail;
		$markfavi = false;
		$applied = false;
		$candidate_application_id = '';		
		if(Session::get('user.login_type') == 'candidate'){
			$shortlistedposts = DB::table('candidate_savedapplications')
				->where(['candidate_profile_id' => Session::get('user.candidateprofileid'),
					'jobpost_id' => $id])->get();					
			if(count($shortlistedposts) > 0) $markfavi = true;

			$appliedposts = DB::table('candidate_applications')
				->where(['candidate_profile_id' => Session::get('user.candidateprofileid'),
					'jobpost_id' => $id])->first();								
			if($appliedposts) {
				$applied = $appliedposts->status;
				$candidate_application_id = $appliedposts->candidate_application_id;		
			}
			if($referral_email == 'MULTI'){
				$options['all_referral_email'] =  ['' => 'Please Choose a Referral']  + DB::table('referrals')->where(['jobpost_id' => $id, 'referral_email' => Session::get('user.email')])
					->lists('candidate_email', 'candidate_email'); 				 
			}
		$userprofile = DB::table('candidateprofiles')->where('candidate_profile_id', Session::get('user.candidateprofileid'))->first();
		$options['userprofile'] = $userprofile;
		}
		$options['markfavi'] = $markfavi;
		$options['applied'] = $applied;
		$options['candidate_application_id'] = $candidate_application_id;
		$options['referralkey'] = $referralkey;
		$options['referral_email'] = $referral_email;		
		if($referralkey && !Session::get('user.login_type')){			
			Session::set('user.redirecturl', route('viewpost',[$id, $title, $referralkey]) );
			Session::set('user.referralkey', $referralkey );
		}		
		//return view('post.viewpost', $options);
		return view('template.job.job-single', $options);
	}

	public function talentsearch(Request $request){			

		$options = $this->setSession();	
		$query_string = $request->input();	
		$posts = array();
		$final_result = array();
		if($query_string) {	
		$posts = DB::table('candidateprofiles')	
					->leftJoin('accounts', function ($join){
		            	$join->on('accounts.account_id', '=', 'candidateprofiles.account_id')
		            	->where('accounts.account_type','=','candidate');		            	
		            })	
		            ->leftJoin('candidateworkexps', function($join){
		            	$join->on('candidateworkexps.candidate_profile_id', '=', 'candidateprofiles.candidate_profile_id');
		            })
		            ->leftJoin('candidateeducations', function($join){
		            	$join->on('candidateeducations.candidate_profile_id', '=', 'candidateprofiles.candidate_profile_id');
		            })	            
		            ->where(function ($query) use($query_string) {
		                $query->where('accounts.account_status','=','1');
		                foreach ($query_string as $key => $value) {
							switch ($key) {
								case 'title':
									if($value) 
										$query->where('candidateworkexps.position', 'LIKE', '%'.$value.'%');		                
									break;
								case 'country':
									if($value) 
										$query->where(function ($q) use($value) {
											$q->orWhere('candidateprofiles.country_residingin', '=', $value)
											   ->orWhere('candidateprofiles.prefered_location', '=', $value)
											   ->orWhere('candidateprofiles.prefered_location2', '=', $value)
											   ->orWhere('candidateprofiles.prefered_location3', '=', $value)
											   ->orWhere('candidateprofiles.prefered_location', '=', '');
										});										                
									break;	
								case 'qualification':
									if($value) {
										
										$query->where('candidateeducations.degree', '=', $value);		                
									}
									break;	
									
								case 'expected_salary':
									if($value && $query_string['salary_currency']){
										$query->where('candidateprofiles.prefered_salary_currency', '=', $query_string['salary_currency'] );
										$query->where('candidateprofiles.prefered_salary', '<=', $value);
									}
									break;								
								case 'skills':
									$query->where(function ($skill_query) use($value) {
						                foreach ($value as $skill) {
											$skill_query->orWhere('candidateprofiles.core_skills', 'LIKE', '%'.(string)$skill.'%');
										}
						            });									
									break;
								default:
									# code...
									break;
							}			
						}
		            })			           				
		            ->select('candidateprofiles.*')->distinct()->get();
		}

        $post_count = count($posts);
        for ($i=0; $i < $post_count ; $i++) { 
        	$edu = DB::table('candidateeducations')->where('candidate_profile_id',$posts[$i]->candidate_profile_id)->orderBy('enrolldate', 'desc')->take(2)->get();
        	$posts[$i]->education = $edu;
        	$work = DB::table('candidateworkexps')->where('candidate_profile_id',$posts[$i]->candidate_profile_id)->orderBy('start_date', 'desc')->get();        				 			
			$total_exp_months = 0;
			$total_exp_year = 0;
			for ($j=0; $j < count($work); $j++) { 
				$total_months = 0; 
				$d_start    = date_create($work[$j]->start_date); 
        		if($work[$j]->still_working == 'N'){        							    
				    $d_end      = date_create($work[$j]->end_date);
        		}else if($work[$j]->still_working == 'Y'){        			
        			$d_end      =date_create(date("Y-m-d"));
        		}
        		$diff = $d_start->diff($d_end); 			    			    				   
			    $total_months += $diff->format('%m'); 
			    $total_exp_months += $diff->format('%m'); 
			    $total_year = $total_months/12;        	
				$year = floor($total_year);     // 1
				$month = fmod($total_year, 12);
			    //$work[$j]->total_years = $year." years ".substr(round($month, 1), 2)." months";	
			    $work[$j]->total_years = " > ". ceil($total_year) . " year ";			    
			}
			$posts[$i]->work = $work; 
			if($total_exp_months > 0){
				$total_exp_year = $total_exp_months/12;        	
				$year = floor($total_exp_year);     
				$month = fmod($total_exp_year, 12);					
			    $total_exp_year_word = $year." years ".substr(round($month, 1), 2)." months";
			    $total_exp_year_word = round($total_exp_year)." year ";
			}else{
				$total_exp_year_word = 'Nil';
			}
			$posts[$i]->total_years = $total_exp_year_word;
			//Coreskills 
			$core_skills = explode('|', $posts[$i]->core_skills);	
			$core_skills_text = '';		
			foreach ($core_skills as $key=>$skill) {
				if($key > 0) $core_skills_text .= ', ';
				$core_skills_text .=  parent::getlookupname($skill,'core_skill');				
			}
			$posts[$i]->core_skills_text = $core_skills_text;	

			//Check for resume downloads
			$resume_downloaded_ind = DB::table('employer_resume_downloads')->where([
				'candidate_profile_id' => $posts[$i]->candidate_profile_id, 
				'employer_profile_id' => Session::get('user.employer_profile_id')
				//'expiry_date' >= date("Y-m-d") 
				])->count();	
			$posts[$i]->resume_downloaded = $resume_downloaded_ind;
			
			//search match check
			$match_rating = 0;
			//dd($posts[$i]);
			if($request->has('salary_currency')){
				if($query_string['salary_currency'] == $posts[$i]->prefered_salary_currency && 
					$query_string['expected_salary'] <= $posts[$i]->prefered_salary) 
					$match_rating++;
			}
			
			/*if($query_string['country'] && 
				$query_string['country'] == $posts[$i]->prefered_location || 
				$query_string['country'] == $posts[$i]->prefered_location2 ||
				$query_string['country'] == $posts[$i]->prefered_location3) $match_rating++;	*/

			if($request->has('job_type')){
				if($query_string['job_type'] && 
					$query_string['job_type'] == $posts[$i]->prefered_type) $match_rating++;
			}
			
			if($request->has('skills')){			
				$core_skills = explode('|', $posts[$i]->core_skills);				
				foreach ($query_string['skills'] as $value) {
					if(in_array($value, $core_skills))
						$match_rating++;
				}
			}	
			$posts[$i]->match_rating = $match_rating;
			
			if($request->has('experience')){				
				switch ($query_string['experience']) {
					case '2':
						if($total_exp_year < 2){
							$posts[$i]->match_rating++;
							$final_result[] = $posts[$i];
						}
						break;
					case '5':
					    if($total_exp_year > 2 && $total_exp_year < 5) {
							$posts[$i]->match_rating++;
							$final_result[] = $posts[$i];
						}
					    break;
					case '10':
					    if($total_exp_year > 5) {
							$posts[$i]->match_rating++;
							$final_result[] = $posts[$i];
						}  
					    break;
					default:
						# code...
						break;
				}
			}else{
				$final_result[] = $posts[$i];
			}
        	        	       	        
        }   
        usort($final_result, function($a, $b) {        	
            return $b->match_rating <=> $a->match_rating;
        });
        //dd($final_result);     
		$options['candidate_details'] = $final_result;		
		$options['country'] = parent::genlookuplist('All', 'country');		
		$options['experience'] = [''=> 'All', '2' => '< 2 years', '5' => '2 to 5 years', '10' => 'more than 5 years'];	
		$options['job_level'] = parent::genlookuplist('All', 'job_level');
		$options['job_type'] = parent::genlookuplist('All', 'job_type');
		$options['currency'] = parent::genlookuplist('All', 'currency');
		$options['qualification'] = parent::genlookuplist('All', 'degree');
		if(count($query_string) == 0) {
			$query_string['experience'] = '';
			$query_string['expected_salary'] = '';
			$query_string['country'] = '';
			$query_string['job_type'] = '';
			$query_string['title'] = '';	
			$query_string['salary_currency'] = '';
			$query_string['skills'] = [];
		}
		$options['search'] = $query_string;
		if(isset($options['search']['skills']))
			$options['search']['skills'] = json_encode($options['search']['skills']);
		else
			$options['search']['skills'] = json_encode([]);
		//return view('employer.talentsearch',$options);	
		return view('template.employer.talentsearch',$options);	
	}

	public function downloadresume(CandidateController $cand){
		$expiry_term = 6; //sys_table
		$credit_for_downloads = 1; //sys_table
		$date = date("Y-m-d");
		$expiry_date = strtotime(date("Y-m-d", strtotime($date)) . " +".$expiry_term." month");
		$emailed_addresses = Session::get('user.contact_email');
		$data_array = [
			'employer_profile_id' => Session::get('user.employer_profile_id'), 
			'candidate_profile_id' => $_POST['candidate_profile_id'],
			'download_source' => $_POST['download_source'],
			'credits_used' => $credit_for_downloads,
			'emailed_addresses' => $emailed_addresses,
			'status' => 'downloaded',
			'expiry_date' => date("Y-m-d",$expiry_date),
			'created_at' => date("Y-m-d H:i:s"),
		];		
		
		if($_POST['download_source'] == 'job_applicant'){
			$data_array['job_post_id'] = $_POST['job_post_id'];
		}
		//check for credits
		$userprofile = DB::table('employerprofiles')->where('employer_profile_id', Session::get('user.employer_profile_id'))->first();
		if($userprofile->credits >= $credit_for_downloads){

			$post_id = DB::table('employer_resume_downloads')->insertGetId($data_array);
			if($post_id){
				//reduce credits	
				DB::table('employerprofiles')->where('employer_profile_id', Session::get('user.employer_profile_id'))->decrement('credits', $credit_for_downloads);
				//Insert to credit log

				//send email
				$candidate_userprofile = DB::table('candidateprofiles')->where('candidate_profile_id', $_POST['candidate_profile_id'])->first();
				Session::set('user.candidateprofileid', $_POST['candidate_profile_id']);			
	        	$html = $cand->profile(null,'pdf');  	        	
				$options = array('to_name' => $userprofile->contact_person,
						'candidate_name' =>  $candidate_userprofile->firstname.' '.$candidate_userprofile->lastname,										
						'email' => $userprofile->contact_email,	
						'html' => 	$html
						 );
				MailController::sendResumeAttachment($options);
				//check referal and update
				$account_info = DB::table('accounts')->where('account_id',$_POST['candidate_account_id'])->first();		
				$referral_info = DB::table('referrals')->where([
								'referral_type' => 'applicant', 
								'referral_email' => $account_info->email, 									
								'referral_status' => 'completed']
								//check for expiry date as well
								)->increment('resume_downloads', 1);  
				//Check for job referal and update		
				$referral_info = DB::table('referrals')->where([
								'referral_type' => 'job', 
								'referral_email' => $account_info->email, 									
								'referral_status' => 'applied']
								//check for expiry date as well
								)->increment('resume_downloads', 1);  		 
				return 'true';
			}
		}else{
			//redirect to purchase credit screen
		}
	}

	public function buycredits(Request $request){
		$result_size = ($request->has('size'))? $request['size']: $this->pageSize;
		$options = $this->setSession();		
		$options['trans_history'] = DB::table('credit_purchase_trx')->where('employer_profile_id', Session::get('user.employer_profile_id'))->paginate($result_size);		
		//dd($options['trans_history']);	
		//return view('employer.buycredits',$options);
		return view('template.employer.buycredits',$options);	

		//DB::table('employerprofiles')->where('employer_profile_id', Session::get('user.employer_profile_id'))->increment('credits', $credit_for_downloads);
	}

	public function confirmcredits($credits, $pack_name = null){
		$data_array = [
			'transaction_no' => 'TRX'.time(),
			'employer_profile_id' => Session::get('user.employer_profile_id'),
			'pack_name' => $pack_name,
			'credits' => $credits,
			'created_at' => date('Y-m-d H:i:s'),
			'status' => 'Confirmed'
		];
		$workexp_id = DB::table('credit_purchase_trx')->insertGetId($data_array);			
		DB::table('employerprofiles')->where('employer_profile_id', Session::get('user.employer_profile_id'))->increment('credits', $credits);
		return redirect()->route('employerhome');
	}

	public function epayment(){
		$options = $this->setSession();		


		$this->iPay88_signature("appleM00123A000000014500MYR");
		return view('employer.epayment',$options);
	}

	function iPay88_signature($source)
	{
		return hash('sha256', $source);
	}
}
