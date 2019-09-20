@extends('template.include.master' )

@if(Session::get('user.login_type') == 'candidate')	
	@include('template.include.candidate_header')
	@include('template.include.candidate_footer')
@elseif(Session::get('user.login_type') == 'employer')
	@include('template.include.employer_header')
	@include('template.include.employer_footer')	
@else
	@include('include.candidate.guest_header')
@endif  

@section('main')
<section>
	{!! Form::hidden('referralkey',$referralkey,['id'=>'referralkey']) !!}
	@if($referral_email && $referral_email != 'MULTI')
		{!! Form::hidden('referral_email',$referral_email,['id'=>'referral_email']) !!}
	@endif
	<div class="block">
		<div class="container">
			<div class="row">
			 	<div class="col-lg-12 column">
			 		<div class="job-title2"><h3>{{$postdetails->job_title}}</h3> <h3 class="notactive-post-title">@if($postdetails->status == 'draft')[ This posting is not yet active] @endif</h3></div>
			 		<div class="job-single-sec style3 tags-jobs">
			 			<div class="job-head-wide">			 				
			 				<div class="row">
			 					<div class="col-lg-8">
			 						<div class="job-single-head3">
						 				<div class="job-thumb"> <img onerror="this.src='{{URL::asset('new/images/profile_preview.png')}}';" src='<?php echo env("AS3_URL").env("AS3_bucket")."/".$postdetails->logo_url; ?>' alt='<?php echo env("AS3_URL").env("AS3_bucket")."/".$postdetails->logo_url; ?>' /><span>12 Open Position</span> </div>
						 				<div class="job-single-info3">
						 					@if($postdetails->is_confidential =='N')
											<h3>{{$postdetails->company_name}}</h3> 
											@else
											<h3>CONFIDENTIAL JOB POST</h3>
											@endif						 					
						 					<span><i class="la la-map-marker"></i>{{$postdetails->job_city}}, {{$postdetails->job_state}}</span><span class="job-is ft">{{$postdetails->job_type}}</span>
						 					<ul class="tags-jobs">
							 					<li><i class="la la-file-text"></i> Applications 1</li>
							 					<li><i class="la la-calendar-o"></i> Post Date: {{date_format(date_create($postdetails->posted_at),"F j, Y")}}</li>
							 					<li><i class="la la-eye"></i> Views 5683</li>
							 				</ul>
						 				</div>
						 			</div><!-- Job Head -->
			 					</div>
			 					<div class="col-lg-4">			 						
			 					@if($postdetails->status == 'posted' && Session::get('user.login_type') == 'candidate')
	 								@if($referral_email == 'MULTI')
										<b>{!! Form::label('referral_email_lbl','Use Referral: ') !!}</b>
										{!! Form::select('referral_email',$all_referral_email,'',['id'=>'referral_email']) !!}
									@endif
			 						<input type="hidden" id ='employer_profile_id' value='{{$postdetails->employer_profile_id}}'/>
							 		@if($applied == 'applied')
										<a href="javascript:shortlist({{$postdetails->jobpost_id}}, 'withdraw')" class="apply-thisjob"><i class="la la-paper-plane"></i>Withdraw application</a>
									@elseif($applied == 'withdrawn')
										<a href="javascript:shortlist({{$postdetails->jobpost_id}}, 'apply')" class="apply-thisjob"><i class="la la-paper-plane"></i>Reapply for this job</a>
										<div class="apply-alternative">							 			
								 			<a href="javascript:shortlist({{$postdetails->jobpost_id}}, '')"  class="" title=""><i id="markfavi"  class="la {{$markfavi ? 'la-heart' : 'la-heart-o'}}"></i> Shortlist</a>
								 		</div>
									@else										
										<a class="apply-thisjob" href="javascript:shortlist({{$postdetails->jobpost_id}}, 'apply')" title=""><i class="la la-paper-plane"></i>Apply for job</a>
										<div class="apply-alternative">							 			
								 			<a href="javascript:shortlist({{$postdetails->jobpost_id}}, '')"  class="" title=""><i id="markfavi"  class="la {{$markfavi ? 'la-heart' : 'la-heart-o'}}"></i> Shortlist</a>
								 		</div>
									@endif
							 																				
								@elseif($postdetails->status == 'draft')
									<a href="javascript:{}" onclick="document.getElementById('my_form').submit(); return false;" class="apply-thisjob"><i id="markfavi"  class="la la-paper-plane-o"></i>Post Job</a>			
									<form method="POST" id="my_form" action="{{URL::to('/employer/ajaxconfirmpost/'.$postdetails->jobpost_id)}}" accept-charset="UTF-8">
										<div class="apply-alternative">
								 			<a href="{{route('editpost',[$postdetails->jobpost_id])}}"  title=""><i id="markfavi"  class="la la-pencil-square-o"></i>Edit Job Post</a>				
								 			<a href="{{URL::to('/employer/managejob/draft')}}"  class="" title="" style="float:right;"><i id="markfavi"  class="la la-undo"></i>Post Job Later</a>
								 		</div>
										{{ csrf_field() }}										
									</form>															
								@elseif(Session::get('user.active') == null)
									<a class="apply-thisjob" href="{{route('candidatelogin')}}" title=""><i class="la la-paper-plane"></i>Login or Register to Apply for this job</a>
								@endif
			 					</div>
			 				</div>
			 			</div>
			 			<div class="job-wide-devider">
						 	<div class="row">
						 		<div class="col-lg-8 column">		
						 			<div class="job-details">
						 				<?= $postdetails->job_description;?>
						 			</div>
						 			<div class="share-bar">
						 				<span>Share</span><a href="#" title="" class="share-fb"><i class="fa fa-facebook"></i></a><a href="#" title="" class="share-twitter"><i class="fa fa-twitter"></i></a>
						 				<a href="{{ route('referapplicant',['job', $postdetails->jobpost_id]) }}" title="" class="share-google"><i class="fa fa-envelope"></i></a>						 		
						 			</div>
						 			<div class="extra-job-info">
							 			<span><i class="la la-clock-o"></i><strong>35</strong> Days</span>
							 			<span><i class="la la-file-text"></i><strong>300-500</strong> Application</span>
							 			<span><i class="la la-search-plus"></i><strong>35697</strong> Displayed</span>
							 		</div>
							 		<div class="recent-jobs">
						 				<h3>Recent Jobs</h3>
						 				
						 			</div>
						 		</div>
						 		<div class="col-lg-4 column">
						 			<div class="job-overview">
							 			<h3>Job Overview</h3>
							 			<ul>
							 				<li><i class="la la-money"></i><h3>Offerd Salary</h3><span>{{$postdetails->salary_currency}} {{$postdetails->salary_min}} - {{$postdetails->salary_max}}</span></li>
							 				<li><i class="la la-thumb-tack"></i><h3>Career Level</h3><span>{{$postdetails->job_level}}</span></li>
							 				<li><i class="la la-puzzle-piece"></i><h3>Industry</h3><span>{{$postdetails->job_category}}</span></li>
							 				<li><i class="la la-shield"></i><h3>Experience</h3><span>2 Years</span></li>
							 				<li><i class="la la-line-chart "></i><h3>Qualification</h3><span>Bachelor Degree</span></li>
							 			</ul>
							 		</div><!-- Job Overview -->
							 		<!-- <div class="quick-form-job">
							 			<h3>Contact</h3>
							 			<form>
							 				<input type="text" placeholder="Enter your Name *" />
							 				<input type="text" placeholder="Email Address*" />
							 				<input type="text" placeholder="Phone Number" />
							 				<textarea placeholder="Message should have more than 50 characters"></textarea>
							 				<button class="submit">Send Email</button>
							 				<span>You accepts our <a href="#" title="">Terms and Conditions</a></span>
							 			</form>
							 		</div> -->
						 		</div>
						 	</div>
						 </div>
				 	</div>
			 	</div>
			</div>
		</div>
	</div>
</section>
@stop

@section('scripts')
<script type="text/javascript">

function shortlist(id, mode){
    
    var employer_profile_id = $('#employer_profile_id').val();
    var candidate_application_id = '<?php echo $candidate_application_id; ?>';
    var referralkey = $('#referralkey').val();
    var referral_email = $('#referral_email').val();
    var redirect = false;
    var url = "<?php echo URL::to('/candidate/jobshortlist/');?>/" + id +'/' ;
    if(mode == 'apply'){
    	url = url + 'apply';
    	redirect = true;	    
    }else if(mode == 'withdraw'){
    	url = url + 'withdraw';
    	redirect = true;
	}else{
    	if($('#markfavi').hasClass( "la-heart-o" )){
	        url = url + 'save';
	    }else if($('#markfavi').hasClass( "la-heart" )){        
	        url = url + 'delete';
	    }
    }
    $.ajax({url: url, type: 'POST',
	            data: {employer_profile_id:employer_profile_id, candidate_application_id:candidate_application_id, referralkey:referralkey, referral_email:referral_email },
	            dataType: 'json', success: function(result){
    	if(redirect) window.open(result.url, '_self');
    	else
        	$('#markfavi').toggleClass('la-heart-o la-heart');    
    }});    
}
</script>
@stop
