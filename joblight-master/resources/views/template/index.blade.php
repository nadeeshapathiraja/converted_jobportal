@extends('template.include.master')
@include('template.include.index_header')
@include('template.include.index_footer')
@section('main')

	<!-- <section>
		<div class="block no-padding">
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="main-featured-sec">
							<ul class="main-slider-sec text-arrows">
								<li class="slideHome"><img src="http://placehold.it/1600x800" alt="" /></li>
								<li class="slideHome"><img src="http://placehold.it/1600x800" alt="" /></li>
								<li class="slideHome"><img src="http://placehold.it/1600x800" alt="" /></li>
							</ul>
							<div class="job-search-sec">
								<div class="job-search">
									<h3>Your one stop portal to find your dream job</h3>
									<span>Find Jobs, Employment & Career Opportunities</span>
									<form>
										<div class="row">
											<div class="col-lg-7 col-md-5 col-sm-5 col-xs-12">
												<div class="job-field">
													<input type="text" placeholder="Job title, keywords or company name" />
													<i class="la la-keyboard-o"></i>
												</div>
											</div>
											<div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
												<div class="job-field">
													<select data-placeholder="City, province or region" class="chosen-city">
														<option>Istanbul</option>
														<option>New York</option>
														<option>London</option>
														<option>Russia</option>
													</select>
													<i class="la la-map-marker"></i>
												</div>
											</div>
											<div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
												<button type="submit"><i class="la la-search"></i></button>
											</div>
										</div>
									</form>
									
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->

	<section>
		<div class="block no-padding">
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-6">
						<div data-velocity="-.1" style="background: url({{ URL::asset('new/images/temp/parallax1.jpg')}}) repeat scroll 50% 200.28px transparent;" class="parallax scrolly-invisible layer blackish"></div><!-- PARALLAX BACKGROUND IMAGE -->
						<div class="who-am">
							<h3>I AM JOBSEEKER!</h3>
							<p>Are You Interested to Earn Extra Income?</p>
							<a href="{{route('candidatelogin')}}" title="">More Info</a>

						</div>
					</div>
					<div class="col-lg-6">
						<div data-velocity="-.1" style="background: url({{ URL::asset('new/images/temp/parallax2.jpg')}}) repeat scroll 50% 200.28px transparent;" class="parallax scrolly-invisible layer color green2"></div><!-- PARALLAX BACKGROUND IMAGE -->
						<div class="who-am flip">
							<h3>I AM RECRUITER!</h3>
							<p>There is no suitable candidate respond to your advertisement, we will credit *2 Token for your future usage as our apoly for not able to meet your requirement</p>
							<a href="{{route('employerlogin')}}" title="">More info</a>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</section>
	<section>
		<div class="block double-gap-top double-gap-bottom">
			<div data-velocity="-.1" style="background: url({{ URL::asset('new/images/temp/sn1.jpg')}}) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer blackish"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="simple-text-block">
							<h3>Have a lot of connections? why not be a JobKonner Agent!</h3>
							<span>Make bulk referals and earn more</span>
							<a href="{{route('agentlogin')}}" title="">Become an Agent</a>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</section>
	<section>
		<div class="block">
			<div data-velocity="-.1" style="background: url(http://placehold.it/1920x1000) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color light"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="heading light">
							<h2>Kind Words From Happy Candidates</h2>
							<span>What other people thought about the service provided by JobHunt</span>
						</div><!-- Heading -->
						<div class="reviews-sec" id="reviews-carousel">
							<div class="col-lg-6">
								<div class="reviews">
									<img src="http://placehold.it/101x101" alt="" />
									<h3>Augusta Silva <span>Web designer</span></h3>
									<p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service</p>
								</div><!-- Reviews -->
							</div>
							<div class="col-lg-6">
								<div class="reviews">
									<img src="http://placehold.it/101x101" alt="" />
									<h3>Ali Tufan <span>Web designer</span></h3>
									<p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service</p>
								</div><!-- Reviews -->
							</div>
							<div class="col-lg-6">
								<div class="reviews">
									<img src="http://placehold.it/101x101" alt="" />
									<h3>Augusta Silva <span>Web designer</span></h3>
									<p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service</p>
								</div><!-- Reviews -->
							</div>
							<div class="col-lg-6">
								<div class="reviews">
									<img src="http://placehold.it/101x101" alt="" />
									<h3>Ali Tufan <span>Web designer</span></h3>
									<p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service</p>
								</div><!-- Reviews -->
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</section>

	<section>
		<div class="block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="heading">
							<h2>Companies We've Helped</h2>
							<span>Some of the companies we've helped recruit excellent applicants over the years.</span>
						</div><!-- Heading -->
						<div class="comp-sec">
							<div class="company-img">
								<a href="#" title=""><img src="http://placehold.it/180x80" alt="" /></a>
							</div><!-- Client  -->
							<div class="company-img">
								<a href="#" title=""><img src="http://placehold.it/180x80" alt="" /></a>
							</div><!-- Client  -->
							<div class="company-img">
								<a href="#" title=""><img src="http://placehold.it/180x80" alt="" /></a>
							</div><!-- Client  -->
							<div class="company-img">
								<a href="#" title=""><img src="http://placehold.it/180x80" alt="" /></a>
							</div><!-- Client  -->
							<div class="company-img">
								<a href="#" title=""><img src="http://placehold.it/180x80" alt="" /></a>
							</div><!-- Client  -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="block no-padding">
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="simple-text">
							<h3>Got a question?</h3>
							<span>We're here to help. Check out our FAQs, send us an email or call us at 1 (800) 777-8888</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
@stop
@section('scripts')
<script type="text/javascript">
$(window).on('beforeunload', function() {
    $(window).scrollTop(0);
});
</script>
@stop
