@extends('template.include.master')
@include('template.include.employer_header')
@include('template.include.employer_footer')
@section('main')
	
	<section>
		<div class="block no-padding">
			<div class="container">
				 <div class="row no-gape">				 	
				 	@include('template.employer._aside')
				 	<div class="col-lg-9 column">
				 		<div class="padding-left">
					 		<div class="manage-jobs-sec">
					 			<h3>{{$mode}} ({{count($post_details)}})</h3>
					 			<div class="emply-list-sec">
						 			@foreach ($post_details as $detail)
						 			<div class="emply-list">
						 				<div class="upload-portfolio">
							 				<div class="emply-list-thumb">
							 					<a href="#" title=""><img onerror="this.src='{{URL::asset('new/images/profile_preview.png')}}';" src='<?php echo env("AS3_URL").env("AS3_bucket")."/".$employerprofiles->logo_url; ?>' alt="" /></a>
							 				</div>
							 				<div class="emply-list-info">
							 					<div class="emply-pstn"><a href="{{route('editpost',[$detail->jobpost_id])}}"><i class="la la-pencil"></i> Edit</a></div>
							 					<h3><a href="{{URL::to('/post/'.$detail->jobpost_id.'/'.$detail->job_title)}}">{{$detail->job_title}}</a></h3>
							 					@if($mode == 'POSTED')
							 						<span>Published on {{date_format(date_create($detail->posted_at),"F j, Y")}} </span>
							 					@else
							 						<span>Updated on {{date_format(date_create($detail->updated_at),"F j, Y")}} </span>
							 					@endif
							 					<h6><i class="la la-map-marker"></i> {{$detail->job_city}}, {{$detail->job_state}}</h6>
							 				</div>
						 				</div>	
						 				@if($mode == 'POSTED')					 				
							 				<div class="extra-job-info">
									 			<span class="mp-col"><a @if($detail->candidate_applied > 0) href="{{route('managecandidate', [$detail->jobpost_id])}} @endif "><i class="la la-clock-o"></i><strong>{{$detail->candidate_applied}}</strong> New</a></span>
									 			<span class="mp-col"><a @if($detail->shortisted_candidate > 0) href="{{route('managecandidate', [$detail->jobpost_id, 'shortlist'])}} @endif "><i class="la la-file-text"></i><strong>{{$detail->shortisted_candidate}}</strong> Shortlisted</a></span>
									 			<span class="mp-col"><a @if($detail->interview_candidate > 0) href="{{route('managecandidate', [$detail->jobpost_id,'interview_invite'])}} @endif "><i class="la la-users"></i><strong>{{$detail->interview_candidate}}</strong> Interview</a></span>
									 			<span class="mp-col"><a @if($detail->notsuitable_candidate > 0) href="{{route('managecandidate', [$detail->jobpost_id, 'not_suitable'])}} @endif "><i class="la la-pencil"></i><strong>{{$detail->notsuitable_candidate}}</strong> Irrelevant</a></span>
									 		</div>
								 		@endif
						 			</div><!-- Employe List -->
						 			@endforeach
						 		</div>					 			
					 		</div>
					 	</div>
					 	<div style="float:right;">{!! $post_details->render() !!}</div>
					</div>
				 </div>
			</div>
		</div>
	</section>	
	
@stop	

