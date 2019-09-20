@extends('include.global_template')
@include('include.candidate.mainheader')
@section('main')
<div id="feature-wrapper">
    <div class="container">
        <div class="row 200%">
            <div class="12u 12u$(medium) important(medium)">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>                                      
                </ul>   
            </div>                        
      			<div class="8u 12u(medium)" style="padding-top:10px;"> 		
      				<section class="box feature">	
      				<div id="signup" class="inner" style="cursor:auto;">				
      				<h2 style="margin: 0 0 2px 0;">
      					{{$userprofile->firstname}} {{$userprofile->lastname}} 
      				  <a href="{{route('candidateprofile', ['mode' =>'edit'])}}" class="resulttitle_a" target="_self">
      	                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
      	               </a>	               
      	           	</h2>				  
      				  
      				  <p><i class="fa fa-envelope-open" aria-hidden="true"></i> {{Session::get('user.email')}}&emsp;
      				  	<i class="fa fa-phone-square" aria-hidden="true"></i> {{$userprofile->mobile}} &emsp; 
      				  	<i class="fa fa-address-card" aria-hidden="true"></i> {{$userprofile->city}} {{$userprofile->state}} {{$userprofile->zipcode}} {{$userprofile->country}}</p>
      				  @if($userprofile->about_myself)
      				  <p>Summary about myself : <?= substr($userprofile->about_myself, 0, 200); ?> ...</p>
      				  @endif
      				</div>
      				</section>
      			</div>	

            <div class="4u 12u(medium)" style="padding-top:10px;">
              <section class="box feature"> 
                <div class="box">    
                  <h2 style="margin: 0 0 2px 0;">Referral Earnings </h2>
                  <h4>Applicants Referrals</h4>
                  <a href="{{ route('referapplicant',['applicant']) }}" style="float:right;" title="Start Refering"><i class="fa fa-share" aria-hidden="true"> Send Referral</i></a>
                  <p>
                    Total Applicants Refered: {{$refered_count}}                     
                  </p>
                  <p>
                    Total Refered Resume downloadeds: {{$refered_download_count}}                     
                  </p>
                  <h4>Job Referrals</h4>
                  <p>
                    Total Jobs Refered: {{$job_refered_count}}                     
                  </p>
                  <p>
                    Total Refered Resume downloadeds: {{$job_refered_download_count}}              
                  </p>
                </div>
              </section>
            </div>								
        </div>
    </div>

    <div class="container">
        <div class="row 200%">                                  
			<div class="8u 12u$(medium) important(medium)" style="padding-top:10px;">
                <div class="box">
                	<div><h3>Recommended Jobs</h3></div> 
                	@if(count($post_details) <= 0)
                    	<span>No Recommended Jobs found</span>                     
                    @endif
                    @foreach ($post_details as $detail)                    
                     <div class="search_box">
                        <div class="search_boxcontainer">                                                        
                            <span class="resultperiod">{{date_diff(new DateTime("now"), date_create($detail->posted_at))->format('%a')}}d ago</span>
                            <h1 class="resulttitle">
                                <a href="{{URL::to('/post/'.$detail->jobpost_id.'/'.$detail->job_title)}}" class="resulttitle_a" target="_self">
                                    {{$detail->job_title}}
                                </a>
                            </h1>
                            <p class="resultcompany"><span data-automation="jobAdvertiser">{{$detail->company_name}}</span></p>


                            <div class="resultdetail">
                               <div class="resultdetail_left_mini">
                                  <div class="resultdescription"> <?= substr($detail->job_description, 0, 200); ?>  ...</div>
                                  <div>
                                     <div class="resultattributes_div">
                                        <p class="resultsubentry">
                                           <span><a href="#" class="resultlinks" target="_self">{{$detail->job_category}}</a></span>                                           
                                        </p>
                                     </div>
                                     <div>
                                        <a href="javascript:shortlist({{$detail->jobpost_id}})" id="save_job_{{$detail->jobpost_id}}" class="resultlinks">
                                           <i id="markfavi_{{$detail->jobpost_id}}" class="fa {{!empty($detail->candidate_saved_application_id) ? 'fa-star' : 'fa-star-o'}}" aria-hidden="true"></i>
                                           <span class="resultsave">Save</span>
                                        </a>
                                        @if(isset($detail->candidate_applications_status))
                                        <span class="resultstatus">Status: {{$detail->candidate_applications_status}}</span>
                                        @endif
                                     </div>
                                  </div>
                               </div>
                               <div class="resultdetail_right_mini">
                                  <div class="resultlocation">                                     
                                    <div> 
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>                                      
                                        <a href="#" class="resultlinks" target="_self">{{$detail->job_city}}</a>
                                    </div>
                                    <div> 
                                        <i class="fa fa-usd" aria-hidden="true"></i>                                     
                                        <a href="#" class="resultlinks" target="_self">{{$detail->salary_currency}}&nbsp;{{$detail->salary_min}}&nbsp;-&nbsp;{{$detail->salary_max}}</a>
                                    </div>
                                    @if($detail->job_level)
                                    <div> 
                                        <i class="fa fa-black-tie" aria-hidden="true"></i>
                                        <a href="#" class="resultlinks" target="_self">{{$detail->job_level}}</a>
                                    </div>
                                    @endif
                                    @if($detail->job_type)
                                    <div> 
                                        <i class="fa fa-hourglass-half" aria-hidden="true"></i>
                                        <a href="#" class="resultlinks" target="_self">{{$detail->job_type}}</a>
                                    </div>
                                    @endif
                                    <p></p>
                                  </div>                                
                                  <div>
                                    <img class="company_logo noborder" data-automation="jobLogo" src="{{ URL::asset('img/jobkonner_logo.png') }}" alt="Company logo" aria-hidden="true">
                                  </div>
                               </div>
                            </div>
                        </div>                    
                     </div>
                     @endforeach 
                </div>
            </div>								
        </div>
    </div>

    <div class="container">
      <div class="row 200%">                                 
  			<div class="8u 12u(medium)" style="padding-top:10px;"> 		
  				<div class="box">
  				<div><h3>Interview Invites</h3></div> 
  				@if(count($interview_details) <= 0)
              <span>No Upcoming Interviews</span>
           @endif
  				@foreach ($interview_details as $detail)
             <div class="search_box">
                <div class="search_boxcontainer">                                                        
                    <span class="resultperiod">{{date_diff(new DateTime("now"), date_create($detail->emp_action_at))->format('%a')}}d ago</span>
                    <h1 class="resulttitle">
                        <a href="{{URL::to('/post/'.$detail->jobpost_id.'/'.$detail->job_title)}}" class="resulttitle_a" target="_self">
                            {{$detail->job_title}}
                        </a>
                    </h1>
                    <p class="resultcompany"><span data-automation="jobAdvertiser">{{$detail->company_name}}</span></p>
                    <div class="resultdetail">
                      <div class="resultdetail_left_mini">
                          @if(isset($detail->interview_status) && $detail->interview_status != '')
                            <span class="interviewinvitestatus">Status: {{$detail->interview_status}}</span>
                          @else
                              <a href="{{ route('processcandidate',['id'=>$detail->jobpost_id, 'emp_status'=>'accept', 'mode' => 'interview']) }}" class="button alt icon fa-thumbs-o-up btn-primary btn-sm">Accept</a>
                              <a href="{{ route('processcandidate',['id'=>$detail->jobpost_id, 'emp_status'=>'reject', 'mode' => 'interview']) }}" class="button alt icon fa-thumbs-o-down btn-primary btn-sm">Reject</a>
                          @endif  
                      </div>
                      <div class="resultdetail_right_mini">
                                                 
                      </div>
                      <div class="result-logo">
                          <img class="company_logo noborder" data-automation="jobLogo" src="{{ URL::asset('img/jobkonner_logo.png') }}" alt="Company logo" aria-hidden="true">
                      </div>
                    </div>                  
       	        </div>                    
             </div>
  				 @endforeach                      
  			   </div>									
        </div>
      </div>
    </div>

    
    <div class="container">
        <div class="row 200%">                                  
            <div class="8u 12u$(medium) important(medium)" style="padding-top:10px;">
                <div class="box">
                  <div><h3>Jobs Shared to you by Friends</h3></div> 
                  @if(count($shared_job) <= 0)
                      <span>Oops no Jobs Shared with you</span>                     
                    @endif
                    @foreach ($shared_job as $detail)                    
                     <div class="search_box">
                        <div class="search_boxcontainer">                                                        
                            <span class="resultperiod">{{date_diff(new DateTime("now"), date_create($detail->posted_at))->format('%a')}}d ago</span>
                            <h1 class="resulttitle">
                              @if($detail->total_count > 1 )
                                <a href="{{URL::to('/post/'.$detail->jobpost_id.'/'.$detail->job_title.'/null/MULTI')}}" class="resulttitle_a" target="_self">
                                    {{$detail->job_title}}
                                </a>
                              @else                              
                                <a href="{{URL::to('/post/'.$detail->jobpost_id.'/'.$detail->job_title.'/null/'.$detail->refered_by)}}" class="resulttitle_a" target="_self">
                                    {{$detail->job_title}}
                                </a>
                              @endif
                            </h1>
                            <p class="resultcompany"><span data-automation="jobAdvertiser">{{$detail->company_name}}</span></p>


                            <div class="resultdetail">
                               <div class="resultdetail_left_mini">
                                  <div class="resultdescription"> <?= substr($detail->job_description, 0, 200); ?>  ...</div>
                                  <div>
                                     <div class="resultattributes_div">
                                        <p class="resultsubentry">
                                           <span><a href="#" class="resultlinks" target="_self">{{$detail->job_category}}</a></span>                                           
                                        </p>
                                     </div>
                                     <div class="resultblock_jobshare">
                                      <div style="width:30%">
                                        <a href="javascript:shortlist({{$detail->jobpost_id}})" id="save_job_{{$detail->jobpost_id}}" class="resultlinks">
                                           <i id="markfavi_{{$detail->jobpost_id}}" class="fa {{!empty($detail->candidate_saved_application_id) ? 'fa-star' : 'fa-star-o'}}" aria-hidden="true"></i>
                                           <span class="resultsave">Save</span>
                                        </a>
                                      </div>  
                                      <div style="width:70%">
                                        @if(isset($detail->candidate_applications_status))
                                        <span class="resultstatus">Status: {{$detail->candidate_applications_status}}</span>
                                        @endif 
                                        @if($detail->total_count > 1 )
                                          @foreach ($refers = explode(",", $detail->ReferedByGroup) as $refer)                                            
                                            <span class="resultstatus_jobshare">Refered by: {{$refer}}</span>
                                          @endforeach                                                                              
                                        @else
                                          <span class="resultstatus">Refered by: {{$detail->refered_by}}</span>
                                        @endif  
                                      </div>                                                                                 
                                     </div>
                                  </div>
                               </div>
                               <div class="resultdetail_right_mini">
                                  <div class="resultlocation">                                     
                                    <div> 
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>                                      
                                        <a href="#" class="resultlinks" target="_self">{{$detail->job_city}}</a>
                                    </div>
                                    <div> 
                                        <i class="fa fa-usd" aria-hidden="true"></i>                                     
                                        <a href="#" class="resultlinks" target="_self">{{$detail->salary_currency}}&nbsp;{{$detail->salary_min}}&nbsp;-&nbsp;{{$detail->salary_max}}</a>
                                    </div>
                                    @if($detail->job_level)
                                    <div> 
                                        <i class="fa fa-black-tie" aria-hidden="true"></i>
                                        <a href="#" class="resultlinks" target="_self">{{$detail->job_level}}</a>
                                    </div>
                                    @endif
                                    @if($detail->job_type)
                                    <div> 
                                        <i class="fa fa-hourglass-half" aria-hidden="true"></i>
                                        <a href="#" class="resultlinks" target="_self">{{$detail->job_type}}</a>
                                    </div>
                                    @endif
                                    <p></p>
                                  </div>                                
                                  <div>
                                    <img class="company_logo noborder" data-automation="jobLogo" src="{{ URL::asset('img/jobkonner_logo.png') }}" alt="Company logo" aria-hidden="true">
                                  </div>
                               </div>
                            </div>
                        </div>                    
                     </div>
                     @endforeach 
                </div>
            </div>                
        </div>
    </div>
@stop
@section('scripts')
<script>
  
</script>
@stop