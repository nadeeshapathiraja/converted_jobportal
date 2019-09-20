<?php namespace App\Http\Controllers;
use App\Account;
use Illuminate\Http\Request;
use App\Http\Requests;
//use JWTAuth;
use Response;
use App\Repository\Transformers\UserTransformer;
use \Illuminate\Http\Response as Res;
use Validator;
use DB, Session, URL, Crypt, PDF, View, Excel;
use App\Http\Controllers\MailController;

//use Tymon\JWTAuth\Exceptions\JWTException;

class MobileAppController extends ApiController
{
    /**
     * @var \App\Repository\Transformers\UserTransformer
     * */
    protected $userTransformer;

    public function __construct(userTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }
    
    /**
     * @SWG\POST(
     *   path="/login",
     *   tags={"Candidate"},
     *   summary="JobSeeker Login Api",
     *   operationId="authenticate",
     *   @SWG\Parameter(
     *     name="email",
     *     in="formData",
     *     description="Login email",
     *     required=true,
     *     type="string"    
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="User password",
     *     required=true,
     *     type="string"    
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    public function authenticate(Request $request)
    {
        $rules = array (
            'email' => 'required|email',
            'password' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails()){
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else{
            $user = Account::where('email', $request['email'])->first();
            if($user){
                $api_token = $user->api_token;
                if ($api_token == NULL){
                    return $this->_login($request['email'], $request['password']);
                }
                try{                    
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Already logged in',
                        'user' => $this->userTransformer->transform($user)
                    ]);
                }catch(Exception $e){
                    $user->api_token = NULL;
                    $user->save();
                    return $this->respondInternalError("Login Unsuccessful. An error occurred while performing an action!");
                }
            }
            else{
                return $this->respondWithError("Invalid Email or Password");
            }
        }
    }

    private function _login($email, $password)
    {        
        $user = Account::where(['email' => $email, 
                                'password' => $password, 
                                'account_type' => 'candidate'])
                ->first();
        if(!$user){
            return $this->respondWithError("User does not exist!");
        }
        $token = bcrypt(date('Y-m-d H:i'));       
        $user->api_token = $token;
        $user->save();
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'message' => 'Login successful!',
            'data' => $this->userTransformer->transform($user)
        ]);
    }
    
    /**
     * @SWG\POST(
     *   path="/register",
     *   tags={"Candidate"},
     *   summary="JobSeeker Register Api",
     *   operationId="register",
     *   @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Candidate's name",
     *     required=true,
     *     type="string",     
     *   ),
     *   @SWG\Parameter(
     *     name="email",
     *     in="formData",
     *     description="Candidate's email",
     *     required=true,
     *     type="string",     
     *   ),
     *   @SWG\Parameter(
     *     name="password",
     *     in="formData",
     *     description="User password",
     *     required=true,
     *     type="string"    
     *   ), 
     *   @SWG\Parameter(
     *     name="referralkey",
     *     in="formData",
     *     description="Referral Key",
     *     required=false,
     *     type="string"    
     *   ),    
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function register(Request $request)
    {
        $rules = array (
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:accounts',
            'password' => 'required|min:6',            
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails()){
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else{                        
            $decrypted_referralkey = '';
            if(isset($request['referralkey']) && !empty($request['referralkey'])){
                $decrypted_referralkey = Crypt::decrypt($request['referralkey']);

            }elseif(!empty($request['referral_code'])){
                $decrypted_referralkey = $request['referral_code'];
            }
            if($decrypted_referralkey != ''){
                $refered_data = DB::table('referrals')->where([
                                        'referral_type' => 'applicant', 
                                        'candidate_email' => $decrypted_referralkey, 
                                        'referral_email' => $request['email'], 
                                        'referral_status' => 'invited'])
                    ->update(['referral_status' => 'registered', 'updated_at' => date('Y-m-d')]);               
            }       
            //Register process
            $verify_key = Crypt::encrypt($request['email']);
            $is_subscribed = '0';
            if(!empty($request['promotion'])) $is_subscribed = 1;
            $data  = array('is_subscribed' => $is_subscribed, 'encrypted_key' => $verify_key); 
            
            $account_id = DB::table('accounts')->insertGetId(
                    ['email' => $request['email'], 
                    'password' => $request['password'], 
                    'is_subscribed' => $data['is_subscribed'], 
                    'account_type' => 'candidate', 
                    'account_created_at' => date('Y-m-d H:i'),
                    'encrypted_key' => $data['encrypted_key']]
                );            
                
            $profile_id = DB::table('candidateprofiles')->insertGetId(
               ['account_id' => $account_id,
                'firstname' => $request['name'],                
                ]
            );                                              
            $options = array('first_name' => $request['name'],
                        'last_name' =>  '',
                        'role' => 'JobSeeker',
                        'action' => 'applying to your dream job',
                        'email' => $request['email'],
                        'activation_url' => route('accountverification',['key' => $verify_key])
                         );
            MailController::sendactivationmail($options);
            return $this->_login($request['email'], $request['password']);
        }
    }    

     /**
     * @SWG\POST(
     *   path="/logout",
     *   tags={"Candidate"},
     *   summary="JobSeeker logout Api",
     *   operationId="signout",
     *   @SWG\Parameter(
     *     name="api_token",
     *     in="formData",
     *     description="api Token",
     *     required=true,
     *     type="string",     
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
    public function signout(Request $request)
    {
        $api_token = $request['api_token'];
        try{
            $user = Account::where('api_token', $api_token)->first();
            if($user){
                $user->api_token = NULL;
                $user->save();            
            }
            $this->setStatusCode(Res::HTTP_OK);
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Logout successful!',
            ]);

        }catch(Exception $e){
            return $this->respondInternalError("An error occurred while performing an action!");
        }
    }

    /**
     * @SWG\POST(
     *   path="/save",
     *   tags={"Candidate"},
     *   summary="JobSeeker Save profiles Api",
     *   operationId="savecandidate",
     *   @SWG\Parameter(
     *     name="formtype",
     *     in="formData",
     *     description="Profile Section to save",
     *     required=true,
     *     type="string",
     *     enum={"work", "school", "skill", "bank_details", "language", "contact", "preference"},     
     *   ),
     *   @SWG\Parameter(
     *     name="employername",
     *     in="formData",
     *     description="Employer Name",
     *     required=true,
     *     type="string",     
     *   ),
     *   @SWG\Parameter(
     *     name="industry",
     *     in="formData",
     *     description="Inductry",
     *     required=true,
     *     type="string",     
     *   ), 
     *   @SWG\Parameter(
     *     name="city",
     *     in="formData",
     *     description="city",
     *     required=true,
     *     type="string"    
     *   ),    
     *   @SWG\Parameter(
     *     name="country",
     *     in="formData",
     *     description="country",
     *     required=true,
     *     type="integer"    
     *   ),    
     *   @SWG\Parameter(
     *     name="state",
     *     in="formData",
     *     description="state",
     *     required=false,
     *     type="string"    
     *   ),    
     *   @SWG\Parameter(
     *     name="position",
     *     in="formData",
     *     description="position",
     *     required=false,
     *     type="string"
     *   ),     
     *   @SWG\Parameter(
     *     name="salary",
     *     in="formData",
     *     description="salary",
     *     required=false,
     *     type="integer"
     *   ),       
     *   @SWG\Parameter(
     *     name="start_date",
     *     in="formData",
     *     description="start_date",
     *     required=false,
     *     type="string"
     *   ),     
     *   @SWG\Parameter(
     *     name="still_working",
     *     in="formData",
     *     description="still_working",
     *     required=false,
     *     type="boolean"
     *   ),   
     *   @SWG\Parameter(
     *     name="end_date",
     *     in="formData",
     *     description="end_date",
     *     required=false,
     *     type="string"
     *   ),            
     *   @SWG\Parameter(
     *     name="candidate_workexp_id",
     *     in="formData",
     *     description="Work Exp id, used for Updating",
     *     required=false,
     *     type="string",     
     *   ),       
     *   @SWG\Parameter(
     *     name="candidate_profile_id",
     *     in="formData",
     *     description="candidate's Profile Id",
     *     required=true,
     *     type="string",     
     *   ),    
     *   @SWG\Parameter(
     *     name="skill_list",
     *     in="formData",
     *     description="Responsibilities",
     *     required=false,
     *     type="string",        
     *    
     *   ),              
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    /**
     * @SWG\POST(
     *   path="/recommended-jobs",
     *   tags={"Jobs"},
     *   summary="Recommended Jobs for home screen Api",
     *   operationId="signout",
     *   @SWG\Parameter(
     *     name="api_token",
     *     in="formData",
     *     description="api Token",
     *     required=true,
     *     type="string",     
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    /**
     * @SWG\POST(
     *   path="/Refered-jobs",
     *   tags={"Jobs"},
     *   summary="Refered Jobs for home screen Api",
     *   operationId="signout",
     *   @SWG\Parameter(
     *     name="api_token",
     *     in="formData",
     *     description="api Token",
     *     required=true,
     *     type="string",     
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */

    /**
     * @SWG\POST(
     *   path="/recent-jobs",
     *   tags={"Jobs"},
     *   summary="recent Jobs for home screen Api",
     *   operationId="signout",
     *   @SWG\Parameter(
     *     name="api_token",
     *     in="formData",
     *     description="api Token",
     *     required=true,
     *     type="string",     
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     *
     */
}