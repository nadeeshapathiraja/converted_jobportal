@extends('template.include.master')
@include('template.include.candidate_header')
@include('template.include.candidate_footer')
@section('main')
@if($profileIncomplete == '0')        
<div class="emailverify_msg bottom-line" id="email_status">
    <h4 class="notify-header" id="email_status_type"> Incomplete Profile </h4>
    <span id="validate_email"> Please complete your profile to get job recommendation. <a href="{{route('candidateviewprofile', ['edit'])}}"> Click Here </a> </span>                
</div>
@endif
	<section>
		<div class="block no-padding">
			<div class="container">
				 <div class="row no-gape">
				 	@include('template.candidate._aside')
				 	<div class="col-lg-9 column">
				 		<div class="padding-left">
					 		<div class="manage-jobs-sec">
					 			<h3>Candidates Dashboard</h3>
						 		<div class="cat-sec">
									<div class="row no-gape">
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="p-category view-resume-list">
												<a href="#" title="">
													<i class="la la-briefcase"></i>
													<span>Jobs Shared with me</span>
													<p>{{count($shared_job)}} Jobs</p>
												</a>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="p-category">
												<a href="#" title="">
													<i class="la la-eye"></i>
													<span>Refered Count</span>
													<p>{{$refered_count}} Referrals</p>
												</a>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="p-category">
												<a href="#" title="">
													<i class="la la-file-text "></i>
													<span>Refered Download</span>
													<p>{{$refered_download_count}} Downloads</p>
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="cat-sec">
									<div class="row no-gape">
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="p-category follow-companies-popup">
												<a href="#" title="">
													<i class="la la-check"></i>
													<span>Appropriate For Me</span>
													<p>({{count($post_details)}} Jobs)</p>
												</a>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="p-category">
												<a href="#" title="">
													<i class="la la-user"></i>
													<span>Jobs Refered</span>
													<p>{{$job_refered_count}} Jobs</p>
												</a>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="p-category">
												<a href="#" title="">
													<i class="la la-file"></i>
													<span>Refered Jobs download</span>
													<p>{{$job_refered_download_count}} downloads</p>
												</a>
											</div>
										</div>
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
	
@section('popups')

<div class="view-resumesec">
	<div class="view-resumes">
		<span class="close-resume-popup"><i class="la la-close"></i></span>
		<h3>Jobs refered to me</h3>
		@foreach($shared_job as $jobs)
		<div class="job-listing wtabs">
			<div class="job-title-sec">
				<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
				<h3><a href="#" title="">{{$jobs->job_title}}</a></h3>
				<span>{{$jobs->company_name}}</span>
				<div class="job-lctn"><i class="la la-map-marker"></i>{{$jobs->job_city}},{{$jobs->job_country}}</div>
			</div>
			<span class="date-resume">{{$jobs->posted_at}}</span>
			<span class="date-resume" style="margin-top:5px;">{{$jobs->refered_by}}</span>
		</div><!-- Job -->
		@endforeach		
	</div>
</div>

<div class="follow-companiesec">
	<div class="follow-companies">
		<span class="close-follow-company"><i class="la la-close"></i></span>
		<h3>JobKonner's Recommendation</h3>
		@foreach($post_details as $jobs)
		<div class="job-listing wtabs">
			<div class="job-title-sec">
				<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
				<h3><a href="#" title="">{{$jobs->job_title}}</a></h3>
				<span>{{$jobs->company_name}}</span>
				<div class="job-lctn"><i class="la la-map-marker"></i>{{$jobs->job_city}},{{$jobs->job_country}}</div>
			</div>
			<span class="date-resume">{{$jobs->posted_at}}</span>			
		</div><!-- Job -->
		@endforeach
		<ul id="scrollbar" style="display:none;">
			<li>
				<div class="job-listing wtabs">
					<div class="job-title-sec">
						<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
						<h3><a href="#" title="">Web Designer / Developer</a></h3>
						<div class="job-lctn">Sacramento, California</div>
					</div>
					<a href="#" title="" class="go-unfollow">Unfollow</a>
				</div><!-- Job -->	
			</li>
			<li>
				<div class="job-listing wtabs">
					<div class="job-title-sec">
						<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
						<h3><a href="#" title="">Tix Dog</a></h3>
						<div class="job-lctn">Sacramento, California</div>
					</div>
					<a href="#" title="" class="go-unfollow">Unfollow</a>
				</div><!-- Job -->	
			</li>
			<li>
				<div class="job-listing wtabs">
					<div class="job-title-sec">
						<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
						<h3><a href="#" title="">StarHealth</a></h3>
						<div class="job-lctn">Sacramento, California</div>
					</div>
					<a href="#" title="" class="go-unfollow">Unfollow</a>
				</div><!-- Job -->	
			</li>
			<li>
				<div class="job-listing wtabs">
					<div class="job-title-sec">
						<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
						<h3><a href="#" title="">Altes Bank</a></h3>
						<div class="job-lctn">Sacramento, California</div>
					</div>
					<a href="#" title="" class="go-unfollow">Unfollow</a>
				</div><!-- Job -->	
			</li>
			
		</ul>		
	</div>
</div>

@stop	

