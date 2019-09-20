@extends('template.include.master')
@include('template.include.employer_header')
@include('template.include.employer_footer')
@section('main')
	
	<section>
		<div class="block no-padding">
			<div class="container">
				 <div class="row no-gape">				 	
				 	<div class="col-lg-12 column">
				 		<div class="padding-left">
					 		<div class="manage-jobs-sec">
					 			<h3>{{$mode}}</h3>
					 			<div class="extra-job-info">
						 			<span id="new" class="mp-col"><a @if($candidate_applied > 0) href="{{route('managecandidate', [$job_id])}} @endif"><i class="la la-clock-o"></i><strong>{{$candidate_applied}}</strong> New</a></span>
						 			<span id="shortlist" class="mp-col"><a @if($shortisted_candidate > 0) href="{{route('managecandidate', [$job_id, 'shortlist'])}} @endif"><i class="la la-file-text"></i><strong>{{$shortisted_candidate}}</strong> Shortlisted</a></span>
						 			<span id="interview_invite" class="mp-col"><a @if($interview_candidate > 0) href="{{route('managecandidate', [$job_id,'interview_invite'])}} @endif"><i class="la la-users"></i><strong>{{$interview_candidate}}</strong> Interview</a></span>
						 			<span id="not_suitable" class="mp-col"><a @if($notsuitable_candidate > 0) href="{{route('managecandidate', [$job_id, 'not_suitable'])}} @endif"><i class="la la-pencil"></i><strong>{{$notsuitable_candidate}}</strong> Irrelevant</a></span>
						 		</div>
					 			<div class="emply-list-sec">
						 			@foreach ($candidate_details as $detail)
						 			<div class="emply-list">
						 				<div class="emply-list-info mini-profile">
							                @if(isset($detail->work))
							                <h6><b>Work History</b></h6>
							                 @foreach ($detail->work as $work)                  
							                    <h5>{{$work->position}} <i>({{$work->total_years}})</i> </h5>
							                  @endforeach
							                @endif                 							              
							                
							              	@if(isset($detail->education))
							              	<h6><b>Education Qualifications</b></h6>
							                	@foreach ($detail->education as $edu)
							                  		<span>{{$edu->degree}}, {{$edu->school_name}}</span>
							                	@endforeach
							                @endif						 				
						 				</div>
						 				<div class="emply-list-info">
						 					@if($detail->resume_downloaded > 0)
							                  <div class="emply-pstn">Resume Downloaded</div>
							                @else							                  
							                <div class="emply-pstn">
							                	<a href="" onclick="downloadresume('{{route('downloadresume')}}' , '{{$detail->candidate_profile_id}}', '{{$detail->account_id}}', null, this);return false;">
							                 		Download Resume
							             		</a>
							             	</div>
							                @endif	
							                
						 					<h3><a href="#" title=""><b>Total Work Experience:</b> {{$detail->total_years}}</a></h3>
						 					<span>{{$detail->core_skills_text}}</span>
						 					<h6><i class="la la-dollar"></i> <b>Expected Salary :</b> {{$detail->prefered_salary_currency}} {{$detail->prefered_salary}}</h6>
						 					<p>{{ substr($detail->about_myself, 0, 200)}} <span class="more_text">{{ substr($detail->about_myself, 200)}}</span>
						 					<a class="theme-color" id="toggleButton" onclick="toggleText(this);" href="javascript:void(0);"><i>See More</i></a>						 						
						 				</div>
						 			</div><!-- Employe List -->		
						 			@endforeach		 			
						 		</div>					 									 	
					 		</div>
					 	</div>				 		
					 	<div style="float:right;">{!! $candidate_details->render() !!}</div>
					</div>
				 </div>
			</div>
		</div>
	</section>	
	
@stop	
@section('scripts')
<script>    
  $('.xtra-job-info').find('span').removeClass( "selected-tab" );
  var curr_status = '<?php echo $emp_status ? $emp_status : "new";?>';
  $('#'+curr_status).addClass('selected-tab');
</script>
@stop
