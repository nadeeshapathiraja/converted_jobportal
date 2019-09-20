<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Mail, Session, Crypt, DB, PDF;
use App\Http\Controllers\CandidateController;

class MailController extends Controller
{
    /**
     * Send plain text email
     */
    public function mail(CandidateController $cand)
    {
        $data = array('name'=>"Our Code World");
        // Path or name to the blade template to be rendered
        $template_path = 'mail.email_template';

        //Session::set('user.candidateprofileid', 1);
        //$html = $cand->profile(null,'pdf');        
        //$pdf = PDF::loadHTML($html);

        Mail::send(['text'=> $template_path ], $data, function($message) {
            // Set the receiver and subject of the mail.
            $message->to('pecsundar@gmail.com', 'Receiver Name')->subject('Laravel First Mail');
            // Set the sender
            $message->from('bruce@konnersoft.com','Our Code World');

            //$message->attachData($pdf->output(), "invoice.pdf");
        });

        return "Basic email sent, check your inbox.";
    }

    public static function sendactivationmail($mailDetails){

        //$data = array('name'=>"joBKonner");
        $to_email = $mailDetails['email'];
        $to_name = $mailDetails['first_name'].' '.$mailDetails['last_name'];

        // Path or name to the blade template to be rendered
        $template_path = 'mail.activationmail_template';
        try {
            Mail::send(['html'=> $template_path ], $mailDetails, function($message) use ($to_email, $to_name){

            // Set the receiver and subject of the mail.
            $message->to($to_email, $to_name)->subject('Activate your'.env('APP_NAME').' Account');
            // Set the sender
            $message->from('bruce@konnersoft.com', env('APP_NAME'));
            });
        } catch (Exception $e) {
            
        }
    
        return "Basic email sent, check your inbox.";
    }

    public static function sendPasswordResetMail($mailDetails){

        //$data = array('name'=>"joBKonner");
        $to_email = $mailDetails['email'];
        $to_name = $mailDetails['email'];

        // Path or name to the blade template to be rendered
        $template_path = 'mail.password_reset_template';
        try {
            Mail::send(['html'=> $template_path ], $mailDetails, function($message) use ($to_email, $to_name){

            // Set the receiver and subject of the mail.
            $message->to($to_email, $to_name)->subject('Did you Forgot your '.env('APP_NAME').' Account Password ');
            // Set the sender
            $message->from('bruce@konnersoft.com', env('APP_NAME'));
            });
        } catch (Exception $e) {
            
        }
    
        return "Basic email sent, check your inbox.";
    }

    public static function sendreferralmail($mailDetails = array()){
        
        if(isset($_POST['candidate_email']))   
            $to_emails = explode(';', trim($_POST['candidate_email']));        
        elseif($_POST['tags'])
            $to_emails = $_POST['tags'];
        $my_name = Session::get('user.firstname');
        $my_email = Session::get('user.email');        
        $referral_code = $my_email;
        $url_referralcode = Crypt::encrypt($my_email); 
        $login_type = Session::get('user.login_type');

        //save in ref table as invited        
        $ref_array = array(
            'referral_type' => $_POST['mode'],
            'candidate_profile_id' => Session::get('user.candidateprofileid'),
            'candidate_email' => $my_email,            
            'referral_status' => 'invited',
            'personal_msg' => $_POST['message'],
            'created_at' => date("Y-m-d H:i:s"),
            'jobpost_id' => $_POST['jobpost_id']
        );

        if($login_type == 'agent'){
            $agent_ref = array(
                'document_name' => $_POST['importExcel'] ? $_POST['importExcel']: 'ManualEntry_'.time(),
                'agent_email' => $my_email,
                'account_id' => Session::get('user.accountid'),
                'created_at' => date("Y-m-d H:i:s"),
            );
            $agent_referral_id = DB::table('agent_referrals')->insertGetId($agent_ref); 
            $ref_array['agent_referral_id'] = $agent_referral_id;
        }

        foreach ($to_emails as $key => $value) {
            //validate the email, check if toemail is not a registered member
            
            if($_POST['mode'] == 'job'){
                $ref_array['referral_email'] = $value;            
                DB::table('referrals')->insert($ref_array); 
            }else{
                $valid_email = DB::table('accounts')->where(['email' => $value])->first();    
                if(!$valid_email){        
                    $ref_array['referral_email'] = $value;            
                    DB::table('referrals')->insert($ref_array); 
                }
            }
        }            
        //..
        
        // Path or name to the blade template to be rendered
        $mailDetails = array(
                    'my_name' => $my_name,    
                    'my_message' => $_POST['message'],                                  
                     );

        $jobpost_title = '';
        if($_POST['mode'] == 'job'){
            $template_path = 'mail.referraljob_template';            
            $data = DB::table('employerjobposts')->where('jobpost_id',$_POST['jobpost_id'])->first();
            $jobpost_title = $data->job_title;     
            $subject = 'You may like this Posting on '.$data->job_title. ' at' ;    
            $mailDetails['referral_url'] = route('viewpost',[$_POST['jobpost_id'], $data->job_title, $url_referralcode]);                    

        }else{
            $template_path = 'mail.referralmail_template';
            $subject = 'Invite to discover via';                
            $mailDetails['referralcode'] = $referral_code;
            $mailDetails['referral_url'] = route('referralactivation',['key' => $url_referralcode]);            
        }                    
        try {
            Mail::send(['html'=> $template_path ], $mailDetails, function($message) use ($to_emails, $my_email, $my_name, $subject){

            // Set the receiver and subject of the mail.
            $message->to($to_emails)->subject($subject.' '.env('APP_NAME'));
            // Set the sender
            $message->from(env('MAIL_USERNAME'), $my_name);
            //dd($message);
            });
        } catch (Exception $e) {
            
        }  
        $return_route_name = $login_type.'home';
        if($_POST['mode'] == 'job'){
            return redirect()->route('viewpost', ['id'=>$_POST['jobpost_id'], 'post_title' => $jobpost_title]);    
        }
        return redirect()->route($return_route_name);      
    }
    public function resendreferralmail(){
        //dd($_POST);
        $referrals_data = DB::table('referrals')->whereIn('referral_id', $_POST['referral'])->get();  
        $to_emails = [];      
        //Update referral table's resent count ans send email to it. 
        foreach ($referrals_data as $key => $value) {
            if($value->referral_status == 'invited'){
                $to_emails[] = $value->referral_email;
                DB::table('referrals')->where('referral_id', $value->referral_id)->increment('resent_count');
            }
        }

            $template_path = 'mail.referralmail_template';
            $subject = 'Invite to discover via';
            $my_name = Session::get('user.firstname');
            $my_email = Session::get('user.email');        
            $referral_code = $my_email;
            $url_referralcode = Crypt::encrypt($my_email); 
            $mailDetails = array(
                    'my_name' => $my_name,    
                    'my_message' => 'Hi',                                  
                     );                
            $mailDetails['referralcode'] = $referral_code;
            $mailDetails['referral_url'] = route('referralactivation',['key' => $url_referralcode]);            
        try {
            Mail::send(['html'=> $template_path ], $mailDetails, function($message) use ($to_emails, $my_email, $my_name, $subject){

            // Set the receiver and subject of the mail.
            $message->to($to_emails)->subject($subject.' '.env('APP_NAME'));
            // Set the sender
            $message->from(env('MAIL_USERNAME'), $my_name);
            //dd($message);
            });
        } catch (Exception $e) {
            
        }
        return redirect()->route('referapplicant',['mode' => 'applicant']);
    }

    public static function sendResumeAttachment($mailDetails){
        //$data = array('name'=>"joBKonner");
        $to_email = $mailDetails['email'];
        $to_name = $mailDetails['to_name'];

        // Path or name to the blade template to be rendered
        $template_path = 'mail.resumeattached_template';
        $pdf = PDF::loadHTML($mailDetails['html']);
        try {
            Mail::send(['html'=> $template_path ], $mailDetails, function($message) use ($to_email, $to_name, $pdf){

            // Set the receiver and subject of the mail.
            $message->to($to_email, $to_name)->subject('Applicant Resume from '.env('APP_NAME'));
            // Set the sender
            $message->from('bruce@konnersoft.com', env('APP_NAME'));
            //attach resume
            $message->attachData($pdf->output(), "resume.pdf");
            });
        } catch (Exception $e) {
            
        }
    
        return "Basic email sent, check your inbox.";
    }
}

