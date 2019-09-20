<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB, Session;


class AgentController extends Controller {

	
	public function index(){
		$country = $country = parent::genlookuplist('Please select a country' , 'country');    
		//return view('agent.index', compact('country'));		
		return view('template.agent_index', compact('country'));		
	}
	/*
	public function agentenquiry_form(){
		$country = $country = parent::genlookuplist('Please select a country' , 'country');    
		return view('agent.enquiry', compact('country'));
	}*/

	public function saveenquiry(){
		//dd($_POST);
		unset($_POST['_token']);
		DB::table('enquiry')->insert($_POST);
		return redirect()->route('agentlogin');
	}

	public function agenthome(){			
		$id = Session::get('user.accountid');
		$options['invite_sent'] = DB::table('referrals')->join('agent_referrals', function ($join){
				        				$join->on('agent_referrals.agent_referral_id', '=','referrals.agent_referral_id');
				        			})->where([
				        			'agent_referrals.account_id' => $id,
									'referral_type' => 'applicant', 									
									'referral_status' => 'invited'
									])->count();
		$options['invite_accepted'] = DB::table('referrals')->join('agent_referrals', function ($join){
				        				$join->on('agent_referrals.agent_referral_id', '=','referrals.agent_referral_id');
				        			})->where([
				        			'agent_referrals.account_id' => $id,
									'referral_type' => 'applicant', 									
									'referral_status' => 'registered'
									])->count();									
		$options['invite_registered'] = DB::table('referrals')->join('agent_referrals', function ($join){
				        				$join->on('agent_referrals.agent_referral_id', '=','referrals.agent_referral_id');
				        			})->where([
				        			'agent_referrals.account_id' => $id,
									'referral_type' => 'applicant', 									
									'referral_status' => 'completed'
									])->count();

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
					->take(5)->get();
				//dd($agent_referal);
		$options['agent_referal'] = $agent_referal;
		//return view('agent.home', $options);	
		return view('template.agent.dashboard', $options);						
	}
}
