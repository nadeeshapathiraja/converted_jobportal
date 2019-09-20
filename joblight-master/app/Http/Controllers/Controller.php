<?php
/**
 * @SWG\Swagger(
 *   basePath="/api/v1/",
 *   @SWG\Info(
 *     title="JobKonner API",
 *     version="1.0.0"
 *   ),
 *   @SWG\Tag(
 *     name="Candidate",
 *     description="Candidate Module"
 *   ),
 *   @SWG\Tag(
 *     name="Jobs",
 *     description="Jobs Module"
 *   ) 
 * )
 */

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CandidateController;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB, Session, Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	protected $pageSize = 20;
	
	public function __construct() {		
    	if(!Session::get('user.login_type'))
    		return view('employer.index');
	}

	public function index(){		
		if(Session::get('user.login_type') == 'employer')
			return redirect()->route('employerhome');
		elseif (Session::get('user.login_type') == 'candidate') {
			return redirect()->route('candidatehome');
		}else
			return view('template.index'); //redirect()->route('candidatelogin');
	}

	public function accountverification($encrypted_key) {

		try {
		    $decrypted_value = Crypt::decrypt($encrypted_key);
		    $result = DB::table('accounts')->where([
		    	'email' => $decrypted_value,
            	'encrypted_key' => $encrypted_key,
            	'account_status' => '0'
            	])->first();

			if($result) {
				DB::table('accounts')->where('account_id', $result->account_id)
	            	->update([
	            			'account_status' => '1',
			            	'verified_at' => date("Y-m-d H:i:s")
			            	]);	            	            
	            	Session::flush();
	            	if($result->account_type == 'employer'){
	            		session()->flash('verifystatus', 'Email Verified and Account Activated.  Please login using your credentials.');
	            		return redirect()->route('employerlogin');
	            	}
	            	else{
	            		 DB::table('referrals')->where([
	            		 				'referral_type' => 'applicant',
										'referral_email' => $decrypted_value, 
										'referral_status' => 'registered'])
						->update(['referral_status' => 'completed', 'updated_at' => date('Y-m-d')]);
	            		session()->flash('verifystatus', 'Email Verified and Account Activated.  Please login using your credentials.');
	            		return redirect()->route('candidatelogin');
	            	}
	            }else{
	            	//Show error screen stating that the link is expired or not found
	            	return redirect()->route('mainindex');
	            }
		} catch (DecryptException $e) {
		    //handle decrypt error// Redirect to link expired screen. 
		}
	}

	public function checkemail(){
		$result = DB::table('accounts')->where(['email' => $_POST['email']])->first();		
		if($result){
			return json_encode(['allow' => 'no', 'msg' => "You can't register with an email already in use. Please sign in or use a different email"]);
		}else {			
			return json_encode(['allow' => 'yes']);	
		}

	}

	public function logout(){	
		$login_type = Session::get('user.login_type');
		Session::flush();
		if($login_type == 'employer')
			return redirect()->route('employerlogin');
		else if($login_type == 'agent'){
			return redirect()->route('agentlogin');
		}else {
			return redirect()->route('candidatelogin');
		}
	}

	public function callAPI($mode, $data = null){
		switch ($mode) {
			case 'login':			
				$result = DB::table('accounts')
									->where(['email' => $_POST['login_id'], 
											'password' => $_POST['password'], 
											'account_type' => $_POST['account_type'] ] )
									->first();
				return $result;
				break;
			case 'signup_1':
				$result = DB::table('accounts')->insertGetId(
					    ['email' => $_POST['email'], 
					    'password' => $_POST['password'], 
					    'is_subscribed' => $data['is_subscribed'], 
					    'account_type' => $_POST['account_type'], 
					    'account_created_at' => date('Y-m-d H:i'),
					    'encrypted_key' => $data['encrypted_key']]
					);
				return $result;
				break;
			case 'signup_2':
				$result = DB::table('candidateprofiles')->insertGetId(
				   ['account_id' => $data['account_id'],
				   	'firstname' => $_POST['first_name'],
				   	'lastname' => $_POST['last_name'],
				    ]
				);	
				return $result;
				break;	
			default:
				# code...
				break;
		}		
	}
	//Use default_text as NONE to avoid predefine text
	public function genlookuplist($default_text = 'Please select', $lookup_type, $lookup_subtype = null, $seach_term = null){
		$default_selection = [''=> $default_text]; 	
		$search_array = ['lookup_type' => $lookup_type, 'active_ind' => '1'];
		$lookup_data = DB::table('lookups')
						->where(function ($query) use ($search_array, $seach_term) {
				                $query->where($search_array);	
				                if($seach_term){
				                      $query->where('lookup_name', 'LIKE' , '%'.$seach_term.'%');
				                  }
				            })						
						->lists('lookup_name', 'lookup_code'); 
		if($default_text == 'NONE') return $lookup_data;
		else return $default_selection + $lookup_data;

	}

	public function getlookupname($lookup_code, $lookup_type){
		$lookup_result = DB::table('lookups')->where(['lookup_type' => $lookup_type, 'lookup_code' => $lookup_code])->pluck('lookup_name');
		return $lookup_result;
	}

	public function getSystemSetting($code){
		$result = DB::table('system_settings')->where('code', $code)->pluck('value');
		return $result;
	}
	public function uploadtoAS3($key, $contentType, $sourceFile = NULL, $body = NULL){
		//$Img_key = 'IMG/F12.jpg';
		//$Img_Source_file = 'D:/BvS1.jpg';
		$Imgdata = array('Key' => strtok($key,'?'),	
						'ContentType' => $contentType,						
						);
		if($sourceFile) $Imgdata['SourceFile'] = $sourceFile;
		elseif($body) $Imgdata['Body'] = $body;
		else return false;
		$Imgobj = new Amazons3Controller();
		$ImgUri = $Imgobj->uploadObj($Imgdata);		
		//dd($ImgUri);
		if( !empty($ImgUri['ObjectURL']))
			 return true;
		else
			return false;	
	}

	public function removefromAS3($key){
		$Objdata = array(
			'Key' => strtok($key,'?'),					
		);
		$obj = new Amazons3Controller();
		$ret_result = $obj->deleteObj($Objdata);
	}

	public static function slugify($text){
		
		$result = array_reverse(array_map('strrev', explode('.', strrev($text),2)));        		
        $text = $result[0];
        $extension = (!empty($result[1])) ? '.'.$result[1] : '';
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT//IGNORE', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);

        if (empty($text)) {
            return '';
        }

        return $text.$extension;
    }
    public function pagesNotFound(){
    	return view('template.errors.404');
    }

    public function forgotPassword(){
    	return view('template.forgot_password');
    }

    public function resetPasswordMail(Request $request){
    	
    	//$request['email']
    	$this->validate($request, [
	        'email' => 'required|exists:accounts',	        
	    ]);

    	$account = Account::where('email', $request['email'])->first();
    	$email = Crypt::encrypt($account['email']);
      	$pass = Crypt::encrypt($account['password']);      	
      	
      	$options = array(
      				'email' => $request['email'],
					'activation_url' => route('reset-password',['key' => $email, 'reset' => $pass])
					 );
		MailController::sendPasswordResetMail($options);
		return redirect()->route('mainindex');  		    	
    }

    public function resetPassword(Request $request) {
    	$email = Crypt::decrypt($request['key']);
    	$password = Crypt::decrypt($request['reset']);
    	$account = Account::where('email', $email)->where('password', $password)->first();
    	if($account){
    		//reset password page    	
    		$account_type = $account->account_type;	
    		return view('template.reset_password', compact('email', 'account_type'));
    	}else{
    		//link expired page
    		session()->flash('linkexpired', 'true');
    		return redirect()->route('forgot-password');
    	}
    	dd($email);

    }

    public function saveResetPassword(Request $request) {
    	$account = Account::where('email', $request['login_id'])->first();
    	$account->password = $request['password'];
    	$account->save();
    	$obj = new CandidateController();    	
    	return $obj->login();
    }
}

