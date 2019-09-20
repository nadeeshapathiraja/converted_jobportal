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
		<div class="block no-padding">
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="simple-text">
							<h3>Do you want to make some quick money without having any investment?</h3>
							<span>You will get up to 30% of the revenue, is that sound awesome huh?</span> 
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
							<h2>JobKonner's Revenue Sharing Model</h2>
							<span>You will get up to 30% of the revenue  (RM 6 per CV) without having any investment, just spend some of your time. Apart from Monetary gain, you also help  your friends to find their dream job.</span>
							</li> 
							<div class="browse-all-cat signup-popup"><a href="#" title="">SIGN UP NOW</a>
						</div>
						</div><!-- Heading -->
						<div class="plans-sec">
							<div class="row">
								<div class="col-lg-4">
									<div class="pricetable">
										<div class="pricetable-head">
											<h3>Member Reward</h3>
											<h2>10%</h2>
											<span>Next 12 Months</span>
										</div><!-- Price Table -->
										<ul>
											<li>As a JobKonner member, you can refer others to be a member and you will get 10% of the revenue generated from any employers download his/her CV.
											
										</ul>
										
									</div>
								</div>
								<div class="col-lg-4">
									<div class="pricetable active">
										<div class="pricetable-head">
											<h3>Job Forward Reward</h3>
											<h2>10%</h2>
											<span>One Time</span>
										</div><!-- Price Table -->
										<ul>
											<li>When JobKonner alert you on an advertisement that matches your skill, and if you are not interested at that time. then you may introduce your friends that have this skillset. if he/she apply and put you as the refer, then you will get 10% of the revenue if the advertiser downloads his/her CV. If he/she  is also your refer when create his/her CV, then you will get 20% of the revenue generated from this CV.</li>
											
										</ul>
										
									</div>
								</div>
								<div class="col-lg-4">
									<div class="pricetable">
										<div class="pricetable-head">
											<h3>Advertising Reward</h3>
											<h2>10%</h2>
											<span>Next 12 Month</span>
										</div><!-- Price Table -->
										<ul>
											<li>If you encourage an employer to advertise in this job portal and he put you as a refer, then you will get 10% agency commission from the amount this employer spend on this portal for next 12 months.</li>
											
										</ul>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="scroll-here">
		<div class="block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="heading">
							<h2>Popular Categories</h2>
							<span>37 jobs live - 0 added today.</span>
						</div><!-- Heading -->
						<div class="cat-sec">
							<div class="row no-gape">
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="p-category">
										<a href="#" title="">
											<i class="la la-bullhorn"></i>
											<span>Design, Art & Multimedia</span>
											<p>(22 open positions)</p>
										</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="p-category">
										<a href="#" title="">
											<i class="la la-graduation-cap"></i>
											<span>Education Training</span>
											<p>(6 open positions)</p>
										</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="p-category">
										<a href="#" title="">
											<i class="la la-line-chart "></i>
											<span>Accounting / Finance</span>
											<p>(3 open positions)</p>
										</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="p-category">
										<a href="#" title="">
											<i class="la la-users"></i>
											<span>Human Resource</span>
											<p>(3 open positions)</p>
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="cat-sec">
							<div class="row no-gape">
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="p-category">
										<a href="#" title="">
											<i class="la la-phone"></i>
											<span>Telecommunications</span>
											<p>(22 open positions)</p>
										</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="p-category">
										<a href="#" title="">
											<i class="la la-cutlery"></i>
											<span>Restaurant / Food Service</span>
											<p>(6 open positions)</p>
										</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="p-category">
										<a href="#" title="">
											<i class="la la-building"></i>
											<span>Construction / Facilities</span>
											<p>(3 open positions)</p>
										</a>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-6">
									<div class="p-category">
										<a href="#" title="">
											<i class="la la-user-md"></i>
											<span>Health</span>
											<p>(3 open positions)</p>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="browse-all-cat">
							<a href="#" title="">Browse All Categories</a>
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
							<h2>Featured Jobs</h2>
							<span>Leading Employers already using job and talent.</span>
						</div><!-- Heading -->
						<div class="job-listings-sec">
							<div class="job-listing">
								<div class="job-title-sec">
									<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
									<h3><a href="#" title="">Web Designer / Developer</a></h3>
									<span>Massimo Artemisis</span>
								</div>
								<span class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</span>
								<span class="fav-job"><i class="la la-heart-o"></i></span>
								<span class="job-is ft">FULL TIME</span>
							</div><!-- Job -->
							<div class="job-listing">
								<div class="job-title-sec">
									<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
									<h3><a href="#" title="">Marketing Director</a></h3>
									<span>Tix Dog</span>
								</div>
								<span class="job-lctn"><i class="la la-map-marker"></i>Rennes, France</span>
								<span class="fav-job"><i class="la la-heart-o"></i></span>
								<span class="job-is pt">PART TIME</span>
							</div><!-- Job -->
							<div class="job-listing">
								<div class="job-title-sec">
									<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
									<h3><a href="#" title="">C Developer (Senior) C .Net</a></h3>
									<span>StarHealth</span>
								</div>
								<span class="job-lctn"><i class="la la-map-marker"></i>London, United Kingdom</span>
								<span class="fav-job"><i class="la la-heart-o"></i></span>
								<span class="job-is ft">FULL TIME</span>
							</div><!-- Job -->
							<div class="job-listing">
								<div class="job-title-sec">
									<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
									<h3><a href="#" title="">Application Developer For Android</a></h3>
									<span>Altes Bank</span>
								</div>
								<span class="job-lctn"><i class="la la-map-marker"></i>Istanbul, Turkey</span>
								<span class="fav-job"><i class="la la-heart-o"></i></span>
								<span class="job-is fl">FREELANCE</span>
							</div><!-- Job -->
							<div class="job-listing">
								<div class="job-title-sec">
									<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
									<h3><a href="#" title="">Regional Sales Manager South east Asia</a></h3>
									<span>Vincent</span>
								</div>
								<span class="job-lctn"><i class="la la-map-marker"></i>Ajax, Ontario</span>
								<span class="fav-job"><i class="la la-heart-o"></i></span>
								<span class="job-is tp">TEMPORARY</span>
							</div><!-- Job -->
							<div class="job-listing">
								<div class="job-title-sec">
									<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
									<h3><a href="#" title="">Social Media and Public Relation Executive </a></h3>
									<span>MediaLab</span>
								</div>
								<span class="job-lctn"><i class="la la-map-marker"></i>Ankara / Turkey</span>
								<span class="fav-job"><i class="la la-heart-o"></i></span>
								<span class="job-is ft">FULL TIME</span>
							</div><!-- Job -->
						</div>
					</div>
					<div class="col-lg-12">
						<div class="browse-all-cat">
							<a href="#" title="">Load more listings</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="block">
			<div data-velocity="-.1" style="background: url(http://placehold.it/1920x655) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="heading">
							<h2>Quick Career Tips</h2>
							<span>Found by employers communicate directly with hiring managers and recruiters.</span>
						</div><!-- Heading -->
						<div class="blog-sec">
							<div class="row">
								<div class="col-lg-4">
									<div class="my-blog">
										<div class="blog-thumb">
											<a href="#" title=""><img src="http://placehold.it/360x200" alt="" /></a>
											<div class="blog-metas">
												<a href="#" title="">March 29, 2017</a>
												<a href="#" title="">0 Comments</a>
											</div>
										</div>
										<div class="blog-details">
											<h3><a href="#" title="">Attract More Attention Sales And Profits</a></h3>
											<p>A job is a regular activity performed in exchange becoming an employee, volunteering, </p>
											<a href="#" title="">Read More <i class="la la-long-arrow-right"></i></a>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="my-blog">
										<div class="blog-thumb">
											<a href="#" title=""><img src="http://placehold.it/360x200" alt="" /></a>
											<div class="blog-metas">
												<a href="#" title="">March 29, 2017</a>
												<a href="#" title="">0 Comments</a>
											</div>
										</div>
										<div class="blog-details">
											<h3><a href="#" title="">11 Tips to Help You Get New Clients</a></h3>
											<p>A job is a regular activity performed in exchange becoming an employee, volunteering, </p>
											<a href="#" title="">Read More <i class="la la-long-arrow-right"></i></a>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="my-blog">
										<div class="blog-thumb">
											<a href="#" title=""><img src="http://placehold.it/360x200" alt="" /></a>
											<div class="blog-metas">
												<a href="#" title="">March 29, 2017</a>
												<a href="#" title="">0 Comments</a>
											</div>
										</div>
										<div class="blog-details">
											<h3><a href="#" title="">An Overworked Newspaper Editor</a></h3>
											<p>A job is a regular activity performed in exchange becoming an employee, volunteering, </p>
											<a href="#" title="">Read More <i class="la la-long-arrow-right"></i></a>
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
@section('scripts')
<script type="text/javascript">
$(window).on('beforeunload', function() {
    $(window).scrollTop(0);
});
</script>
@stop