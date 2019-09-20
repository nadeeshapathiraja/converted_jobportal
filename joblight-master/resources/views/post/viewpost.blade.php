@extends(Session::get('user.login_type') == 'employer' ? 'include.employer.maintemplate' : 'include.global_template' )

@if(Session::get('user.login_type') == 'candidate')	
	@include('include.candidate.mainheader')
@elseif(Session::get('user.login_type') == 'employer')
	@include('include.employer.mainheader')
	@include('include.employer.topactionbar')
@else
	@include('include.candidate.guest_header')
@endif  

@section('main') 
<div id="feature-wrapper">
	<div class="container">
		<div class="row 200%">
			<div class="12u 12u$(medium) important(medium)">
					<ul class="breadcrumb">
						<li><a href="#">Jobs in {{$postdetails->job_country}}</a></li>
				        <li><a href="#">Jobs in {{$postdetails->job_city}}</a></li>				  
				        <li><a href="#">{{$postdetails->job_category}}</a></li>
				        <li><a href="#">{{$postdetails->job_title}}</a></li>					       
				    </ul>	
			</div>	    
			<div class="8u 12u$(medium) important(medium)">
				<div class="box feature">	
				<div class="row 200%">										
				<div class="12u 12u$(medium)" style="text-align:center;">	
				{!! Form::hidden('referralkey',$referralkey,['id'=>'referralkey']) !!}
				@if($referral_email && $referral_email != 'MULTI')
					{!! Form::hidden('referral_email',$referral_email,['id'=>'referral_email']) !!}
				@endif
				<input type="hidden" id ='employer_profile_id' value='{{$postdetails->employer_profile_id}}'/>									
					<article>
						<h3>{{$postdetails->job_title}}</h3>
						@if($postdetails->is_confidential =='N')
						<span class="label label-default">{{$postdetails->company_name}}</span> | <a>more jobs from {{$postdetails->company_name}}</a>
						@else
						<span class="label label-default">CONFIDENTIAL JOB POST</span>
						@endif
						<hr class="style_1">
						<div class="post_description">
						<?= $postdetails->job_description;?>	
						</div>
						<hr class="style_1">
						@if($postdetails->status == 'draft')
						<div class="post_buttons">
							<div class="post_draftedjob">
								This posting is not yet active
							</div>							
							<form method="POST" id="my_form" action="{{URL::to('/employer/ajaxconfirmpost/'.$postdetails->jobpost_id)}}" accept-charset="UTF-8">
								<a href="{{route('editpost',[$postdetails->jobpost_id])}}" class="button alt icon fa-pencil-square-o btn btn-medium"> Edit Job</a>&nbsp;								
								{{ csrf_field() }}
								<a href="javascript:{}" onclick="document.getElementById('my_form').submit(); return false;" class="button icon fa-paper-plane-o btn btn-medium"> Post Job</a>
								<!-- <input name="preview" type="submit" class="button icon fa-paper-plane-o btn btn-medium" value="Post Job"> -->
								<a href="{{URL::to('/employer/managejob/draft')}}" class="button alt icon fa-undo btn btn-medium">Post Later</a>&nbsp;								
							</form>							
						</div>	
						@endif
						<div> Share it  :
							<i class="fa fa-facebook-official" aria-hidden="true"></i>
							<i class="fa fa-twitter-square" aria-hidden="true"></i>
							<i class="fa fa-linkedin-square" aria-hidden="true"></i>
							<i class="fa fa-google-plus-square" aria-hidden="true"></i>
						</div>			
					</article>	
				</div>
				</div>					
				</div>
			</div>
			<div class="4u 12u$(medium)">				
				@if($postdetails->status == 'posted' && Session::get('user.login_type') == 'candidate')
				<div class="box feature">
					<div class="12u 12u$(medium)" style="text-align:center;">
						@if($referral_email == 'MULTI')
							<b>{!! Form::label('referral_email_lbl','Use Referral: ') !!}</b>
							{!! Form::select('referral_email',$all_referral_email,'',['id'=>'referral_email']) !!}
						@endif
					</div>						
					<div class="row 200%">															
						<div class="12u 12u$(medium)" style="text-align:center;">	
							@if($applied == 'applied')
								<a href="javascript:shortlist({{$postdetails->jobpost_id}}, 'withdraw')" class="button icon">Withdraw application</a>
							@elseif($applied == 'withdrawn')
								<a href="javascript:shortlist({{$postdetails->jobpost_id}}, 'apply')" class="button icon">Reapply for this job</a>
							@else
								<a href="javascript:shortlist({{$postdetails->jobpost_id}}, 'apply')" class="button icon">Apply for this job</a>
							@endif
							<div class="post_buttons">
								<a href="javascript:shortlist({{$postdetails->jobpost_id}}, '')" id="markfavi" class="button alt icon {{$markfavi ? 'fa-heart' : 'fa-heart-o'}} btn btn-sm"> Save Job</a>
								<a href="{{ route('referapplicant',['job', $postdetails->jobpost_id]) }}" class="button alt icon fa-envelope-o btn btn-sm">Send Job</a>
							</div>
						</div>																	
					</div>						
				</div>
				@elseif(Session::get('user.active') == null)
				<div class="box feature">			
					<div class="row 200%">										
						<div class="12u 12u$(medium)" style="text-align:center;">	
							<a href="{{route('candidatelogin')}}" class="button icon">Login or Register to Apply for this job</a>
							<div class="post_buttons">								
								<a href="{{ route('referapplicant',['job', $postdetails->jobpost_id]) }}" class="button alt icon fa-envelope-o btn btn-sm">Send Job</a>								
							</div>
						</div>																	
					</div>						
				</div>
				@endif			
				<div class="box">	
					<div class="row 200%">										
						<div class="12u 12u$(medium)">			
							<section>
								<h3>{{date_format(date_create($postdetails->posted_at),"F j, Y")}} </h3>
								<p>
									<div class="post_side_info">{{$postdetails->job_state}}</div>
									<div>{{$postdetails->job_city}}</div>						
									<div class="post_side_info">{{$postdetails->job_type}}</div>
									<div>{{$postdetails->job_level}}</div>					
									<div class="post_side_info">{{$postdetails->job_category}}</div>
								</p>	
							</section>		
						</div>
					</div>			
				</div>
			</div>

		</div>
	</div>
</div>
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
    	if($('#markfavi').hasClass( "fa-heart-o" )){
	        url = url + 'save';
	    }else if($('#markfavi').hasClass( "fa-heart" )){        
	        url = url + 'delete';
	    }
    }
    $.ajax({url: url, type: 'POST',
	            data: {employer_profile_id:employer_profile_id, candidate_application_id:candidate_application_id, referralkey:referralkey, referral_email:referral_email },
	            dataType: 'json', success: function(result){
    	if(redirect) window.open(result.url, '_self');
    	else
        	$('#markfavi').toggleClass('fa-heart-o fa-heart');    
    }});    
}
</script>
@stop