@extends('template.include.master')
@include('template.include.index_header')
@include('template.include.index_footer')
@section('main')	
	@if(Session::get('verifystatus'))
	<section id="verifystatus">
		<div class="block double-gap-top double-gap-bottom">
			<div data-velocity="-.1" style="background: url(http://placehold.it/1920x1000) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color green"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="simple-text-block">
							<h3>Great, Thanks for verifying your email!</h3>
							<span>Your account has been activated with JobKonner! Login to manage profiles and find your Dream Job</span>
							<a href="#" title="" class="rounded signin-popup">Login Now</a>							
						</div>
					</div>
				</div>
			</div>	
		</div>
	</section>
	@endif
	<section>
		<div class="block remove-bottom">
			<div data-velocity="-.2" style="background: url(images/resource/parallax5.jpg) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="heading">
							<h2>Buy Our Plans And Packeges</h2>
							<span>One of our jobs has some kind of flexibility option - such as telecommuting, a part-time schedule or a flexible or flextime schedule.</span>
						</div><!-- Heading -->
						<div class="plans-sec">
							<div class="row">
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="pricetable style2">
										<div class="pricetable-head">
											<h3>Basic Jobs</h3>
											<h2><i>$</i>10</h2>
											<span>15 Days</span>
										</div><!-- Price Table -->
										<ul>
											<li>1 job posting</li>
											<li>0 featured job</li>
											<li>Job displayed for 20 days</li>
											<li>Premium Support 24/7</li>
										</ul>
										<a href="#" title="">BUY NOW</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="pricetable active style2">
										<div class="pricetable-head">
											<h3>Standard Jobs</h3>
											<h2><i>$</i>45</h2>
											<span>20 Days</span>
										</div><!-- Price Table -->
										<ul>
											<li>11 job posting</li>
											<li>12 featured job</li>
											<li>Job displayed for 30 days</li>
											<li>Premium Support 24/7</li>
										</ul>
										<a href="#" title="">BUY NOW</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="pricetable style2">
										<div class="pricetable-head">
											<h3>Golden Jobs</h3>
											<h2><i>$</i>80</h2>
											<span>2 Month</span>
										</div><!-- Price Table -->
										<ul>
											<li>44 job posting</li>
											<li>56 featured job</li>
											<li>Job displayed for 80 days</li>
											<li>Premium Support 24/7</li>
										</ul>
										<a href="#" title="">BUY NOW</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
									<div class="pricetable style2">
										<div class="pricetable-head">
											<h3>Platinum Jobs</h3>
											<h2><i>$</i>150</h2>
											<span>5 Month</span>
										</div><!-- Price Table -->
										<ul>
											<li>87 job posting</li>
											<li>100 featured job</li>
											<li>Job displayed for 120 days</li>
											<li>Premium Support 24/7</li>
										</ul>
										<a href="#" title="">BUY NOW</a>
									</div>
								</div>
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
							<h2>How It Works</h2>
							<span>Each month, more than 7 million Jobhunt turn to website in their search for work, making over <br />160,000 applications every day.
							</span>
						</div><!-- Heading -->
						<div class="how-to-sec style2 lines">
							<div class="how-to">
								<span class="how-icon"><i class="la la-user"></i></span>
								<h3>Register an account</h3>
								<p>Post a job to tell us about your project. We'll quickly match you with the right freelancers.</p>
							</div>
							<div class="how-to">
								<span class="how-icon"><i class="la la-file-archive-o"></i></span>
								<h3>Specify & search your job</h3>
								<p>Browse profiles, reviews, and proposals then interview top candidates. </p>
							</div>
							<div class="how-to">
								<span class="how-icon"><i class="la la-list"></i></span>
								<h3>Apply for job</h3>
								<p>Use the Upwork platform to chat, share files, and collaborate from your desktop or on the go.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="block gray">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="heading">
							<h2>JobKonner Site Stats</h2>
							<span>Here we list our site stats and how many people we’ve helped find a job and companies have found <br />recruits. It's a pretty awesome stats area!</span>
						</div><!-- Heading -->
						<div class="stats-sec style2">
							<div class="row">
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
									<div class="stats">
										<span>18</span>
										<h5>Jobs Posted</h5>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
									<div class="stats">
										<span>38</span>
										<h5>Jobs Filled</h5>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
									<div class="stats">
										<span>67</span>
										<h5>Companies</h5>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
									<div class="stats">
										<span>92</span>
										<h5>Members</h5>
									</div>
								</div>
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
					<div class="col-lg-8 column">
						<div class="heading left">
							<h2>Frequently Asked Questions?</h2>
						</div><!-- Heading -->
						<div id="toggle-widget" class="experties">
							<h2>How We Share Information?</h2>
							<div class="content">
								<p>Book your car, all you need is a credit or debit card. When you pick the car up, you’ll need Different car hire companies have different requirements, so please make sure you check the car’s terms and conditions as well.</p>
							</div>
							<h2>In Which We Explain How And With Whom We Share Your Information?</h2>
							<div class="content">
								<p>Book your car, all you need is a credit or debit card. When you pick the car up, you’ll need Different car hire companies have different requirements, so please make sure you check the car’s terms and conditions as well.</p>
							</div>
							<h2>Special Provisions Applicable To Employer?</h2>
							<div class="content">
								<p>Book your car, all you need is a credit or debit card. When you pick the car up, you’ll need Different car hire companies have different requirements, so please make sure you check the car’s terms and conditions as well.</p>
							</div>
							<h2>How Do I Find Contact Information For Harvard Students, Faculty?</h2>
							<div class="content">
								<p>Book your car, all you need is a credit or debit card. When you pick the car up, you’ll need Different car hire companies have different requirements, so please make sure you check the car’s terms and conditions as well.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 column">
						<div class="reviews-sec" id="reviews">
							<div class="col-lg-6">
								<div class="reviews style2">
									<img src="http://placehold.it/101x101" alt="" />
									<h3>Augusta Silva <span>Web designer</span></h3>
									<p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service level that they offer!</p>
								</div><!-- Reviews -->
							</div>
							<div class="col-lg-6">
								<div class="reviews style2">
									<img src="http://placehold.it/101x101" alt="" />
									<h3>Ali Tufan <span>Web designer</span></h3>
									<p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service level that they offer!</p>
								</div><!-- Reviews -->
							</div>
							<div class="col-lg-6">
								<div class="reviews style2">
									<img src="http://placehold.it/101x101" alt="" />
									<h3>Augusta Silva <span>Web designer</span></h3>
									<p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service level that they offer!</p>
								</div><!-- Reviews -->
							</div>
							<div class="col-lg-6">
								<div class="reviews style2">
									<img src="http://placehold.it/101x101" alt="" />
									<h3>Ali Tufan <span>Web designer</span></h3>
									<p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service level that they offer!</p>
								</div><!-- Reviews -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="block no-padding">
			<div data-velocity="-.1" style="background: url(http://placehold.it/1920x1000) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color green2"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container">
				<div class="row">
					<div class="col-lg-8 column">
						<div class="detailbar">
							<h3>Are You Hiring?</h3>
							<p>Find everything you need to post a job and receive the best candidates by visiting our Empl oyer website. We offer small business and enterprise options.</p>
						</div>
					</div>
					<div class="col-lg-4 column">
						<div class="detalbr-mkp">
							<img src="{{ URL::asset('new/images/temp/mockup4.png')}}" alt="" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="block no-padding">
			<div data-velocity="-.2" style="background: url({{ URL::asset('new/images/temp/parallax7.jpg')}}) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="download-sec">
							<div class="download-text">
								<h3>Download & Enjoy</h3>
								<p>Search, find and apply for jobs directly on your mobile device or desktop Manage all of the jobs you have applied to from a convenience secure dashboard.</p>
								<ul>
									<li>
										<a href="#" title="">
											<i class="la la-apple"></i>
											<span>App Store</span>
											<p>Available now on the</p>
										</a>
									</li>
									<li>
										<a href="#" title="">
											<i class="la la-android"></i>
											<span>Google Play</span>
											<p>Get in on</p>
										</a>
									</li>
								</ul>
							</div>
							<div class="download-img">
								<img src="{{ URL::asset('new/images/temp/mockup3.png')}}" alt="" />
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
$(window).on('beforeunload', function() {
    $(window).scrollTop(0);
});
</script>
@stop