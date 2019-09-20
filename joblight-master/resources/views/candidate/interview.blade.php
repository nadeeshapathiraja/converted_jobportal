@extends('include.global_template')
@include('include.candidate.mainheader')
@section('main')
<div id="feature-wrapper">
  <div class="container">
    <div class="row 200%"> 
      <div class="12u 12u$(medium) important(medium)">
          <ul class="breadcrumb">
              <li><a href="#">Home</a></li>   
              <li><a href="#">Interview Invites</a></li>                                      
          </ul>   
      </div>                                 
			<div class="10u 12u(medium)" style="padding-top:10px;"> 		
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
                    <div class="resultdetail_left">
                        @if(isset($detail->interview_status) && $detail->interview_status != '')
                          <span class="interviewinvitestatus">Status: {{$detail->interview_status}}</span>
                        @else
                            <a href="{{ route('processcandidate',['id'=>$detail->jobpost_id, 'emp_status'=>'accept', 'mode' => 'interview']) }}" class="button alt icon fa-thumbs-o-up btn-primary btn-sm">Accept</a>
                            <a href="{{ route('processcandidate',['id'=>$detail->jobpost_id, 'emp_status'=>'reject', 'mode' => 'interview']) }}" class="button alt icon fa-thumbs-o-down btn-primary btn-sm">Reject</a>
                        @endif  
                    </div>
                    <div class="resultdetail_right">
                                               
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
@stop
@section('scripts')
<script>
  
</script>
@stop