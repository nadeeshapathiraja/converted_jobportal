@extends('include.global_template')
@include('include.employer.guest_header')

@section('main')
			<!-- Login for employer-->

			<form name="login" method="post" action="{{URL::to('/employer/ajaxlogin')}}" accept-charset="utf-8" align="right">				
				
				<input type="hidden" name="account_type" value="employer">	             
				<div id="login-wrapper">
					<div class="box container">
					<div class="middleware_msg_success">{{Session::get('verifystatus')}}</div>
						<div class="row">
							<div class="2u 12u(medium)" align="right">
								<label>Employer Login:</label>
							</div>
							<div class="3u 12u(medium)" align="right">
								<input id="username" name="login_id" type="email" placeholder="Username" autofocus required>   
							</div>	
							<div class="3u 12u(medium)">
								<input id="password" name="password" type="password" placeholder="Password" required>
							</div>						
							<div class="4u 12u(medium)" align="left">
								<input type="submit" id="submit" value="Log in">
								<a href="">Forgot your password?</a>
							</div>
						</div>
						<div class="middleware_msg">{{Session::get('loginstatus')}}</div>
					</div>
				</div>
			</form>	

			<!-- Banner -->
				<div id="banner-wrapper">
					<div id="banner" class="box container">
						<div class="row">
							<div class="7u 12u(medium)">
								<h2>Welcome to joBKonner</h2>
								<p>Your one stop portal to find the next hire to grow your business</p>
							</div>
							<div class="5u 12u(medium)">
								<ul>
									<li><a href="{{URL::to('/employer/signup')}}" class="button big icon fa-arrow-circle-right">Start Hiring</a></li>
									<li><a href="#" class="button alt big icon fa-question-circle">More info</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

			<!-- Features -->
				<div id="features-wrapper">
					<div class="container">
						<div class="row">
							<div class="4u 12u(medium)">

								<!-- Box -->
									<section class="box feature">
										<a href="#" class="image featured"><img src="images/pic01.jpg" alt="" /></a>
										<div class="inner">
											<header>
												<h2>Put something here</h2>
												<p>Maybe here as well I think</p>
											</header>
											<p>Phasellus quam turpis, feugiat sit amet in, hendrerit in lectus. Praesent sed semper amet bibendum tristique fringilla.</p>
										</div>
									</section>

							</div>
							<div class="4u 12u(medium)">

								<!-- Box -->
									<section class="box feature">
										<a href="#" class="image featured"><img src="images/pic02.jpg" alt="" /></a>
										<div class="inner">
											<header>
												<h2>An interesting title</h2>
												<p>This is also an interesting subtitle</p>
											</header>
											<p>Phasellus quam turpis, feugiat sit amet in, hendrerit in lectus. Praesent sed semper amet bibendum tristique fringilla.</p>
										</div>
									</section>

							</div>
							<div class="4u 12u(medium)">

								<!-- Box -->
									<section class="box feature">
										<a href="#" class="image featured"><img src="images/pic03.jpg" alt="" /></a>
										<div class="inner">
											<header>
												<h2>Oh, and finally ...</h2>
												<p>Here's another intriguing subtitle</p>
											</header>
											<p>Phasellus quam turpis, feugiat sit amet in, hendrerit in lectus. Praesent sed semper amet bibendum tristique fringilla.</p>
										</div>
									</section>

							</div>
						</div>
					</div>
				</div>

			<!-- Main -->
				<div id="main-wrapper">
					<div class="container">
						<div class="row 200%">
							<div class="4u 12u(medium)">

								<!-- Sidebar -->
									<div id="sidebar">
										<section class="widget thumbnails">
											<h3>Interesting stuff</h3>
											<div class="grid">
												<div class="row 50%">
													<div class="6u"><a href="#" class="image fit"><img src="images/pic04.jpg" alt="" /></a></div>
													<div class="6u"><a href="#" class="image fit"><img src="images/pic05.jpg" alt="" /></a></div>
													<div class="6u"><a href="#" class="image fit"><img src="images/pic06.jpg" alt="" /></a></div>
													<div class="6u"><a href="#" class="image fit"><img src="images/pic07.jpg" alt="" /></a></div>
												</div>
											</div>
											<a href="#" class="button icon fa-file-text-o">More</a>
										</section>
									</div>

							</div>
							<div class="8u 12u(medium) important(medium)">

								<!-- Content -->
									<div id="content">
										<section class="last">
											<h2>So what's this all about?</h2>
											<p>This is <strong>Verti</strong>, a free and fully responsive HTML5 site template by <a href="http://html5up.net">HTML5 UP</a>.
											Verti is released under the <a href="http://html5up.net/license">Creative Commons Attribution license</a>, so feel free to use it for any personal or commercial project you might have going on (just don't forget to credit us for the design!)</p>
											<p>Phasellus quam turpis, feugiat sit amet ornare in, hendrerit in lectus. Praesent semper bibendum ipsum, et tristique augue fringilla eu. Vivamus id risus vel dolor auctor euismod quis eget mi. Etiam eu ante risus. Aliquam erat volutpat. Aliquam luctus mattis lectus sit amet phasellus quam turpis.</p>
											<a href="#" class="button icon fa-arrow-circle-right">Continue Reading</a>
										</section>
									</div>

							</div>
						</div>
					</div>
				</div>
@stop

@section('footer')
						<div class="row">
							<div class="3u 6u(medium) 12u$(small)">

								<!-- Links -->
									<section class="widget links">
										<h3>About joBKonner</h3>
										<ul class="style2">
											<li><a href="#">The Company</a></li>
											<li><a href="#">In the News</a></li>
											<li><a href="#">Work with Us</a></li>
											<li><a href="#">Contact Us</a></li>
											<li><a href="#">Site Map</a></li>
										</ul>
									</section>

							</div>
							<div class="3u 6u$(medium) 12u$(small)">

								<!-- Links -->
									<section class="widget links">
										<h3>JobSeekers</h3>
										<ul class="style2">
											<li><a href="#">Company Profiles</a></li>
											<li><a href="#">Terms of Use</a></li>
											<li><a href="#">Privacy Policy</a></li>
											<li><a href="#">Safe Job Search Guide</a></li>
											<li><a href="#">Help</a></li>
										</ul>
									</section>

							</div>
							<div class="3u 6u(medium) 12u$(small)">

								<!-- Links -->
									<section class="widget links">
										<h3>Employers</h3>
										<ul class="style2">
											<li><a href="#">Post a Job Ad</a></li>
											<li><a href="#">Post Classified Ad</a></li>
											<li><a href="#">Search for Resumes</a></li>
											<li><a href="#">Terms of Use</a></li>
											<li><a href="#">Why choose joBKonner</a></li>
										</ul>
									</section>

							</div>
							<div class="3u 6u$(medium) 12u$(small)">

								<!-- Contact -->
									<section class="widget contact last">
										<h3>Contact Us</h3>
										<ul>
											<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
											<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
											<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
											<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
											<li><a href="#" class="icon fa-pinterest"><span class="label">Pinterest</span></a></li>
										</ul>
										<p>1234 Fictional Road<br />
										Racoon City, MD 00000<br />
										(800) 111-0000</p>
									</section>

							</div>
						</div>
						<div class="row">
							<div class="12u">
								<div id="copyright">
									<ul class="menu">
										<li>&copy; Sun. All rights reserved</li><li>2017 Malaysia</li>
									</ul>
								</div>
							</div>
						</div>
@stop
	