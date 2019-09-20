@extends('include.global_template')
@include('include.candidate.guest_header')
@include('include.candidate.guest_footer')

@section('main')
			<!-- Login for employer-->

			<form name="login" method="post" action="{{URL::to('/candidate/login')}}" accept-charset="utf-8" align="right">				
				{{ csrf_field() }}	
				<input type="hidden" name="account_type" value="candidate">	             
				<div id="login-wrapper">
					<div class="box container">
					<div class="middleware_msg_success">{{Session::get('verifystatus')}}</div>
						<div class="row">
							<div class="2u 12u(medium)" align="right">
								<label>Jobseeker Login:</label>
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
								<p>Your one stop portal to find your dream job</p>
							</div>
							<div class="5u 12u(medium)">
								<ul>
									@if(Session::get('user.referralkey'))
										<li><a href="{{ route('referralactivation',[Session::get('user.referralkey')]) }}" class="button big icon fa-arrow-circle-right">Register</a></li>
									@else
										<li><a href="#signup" class="button big icon fa-arrow-circle-right">Register</a></li>
									@endif																		
									<li><a href="#" class="button alt big icon fa-question-circle">Job Search</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

			<!-- Features -->
				<div id="features-wrapper">
					<div class="container">
						<div class="row">
							<div class="8u 12u(medium)">
								<!-- Box -->
								<section class="box feature">
									<div id="signup" class="inner" style="cursor:auto;">																			
									<header>
										<h2>Register with joBKonner</h2>
										<p align="right"><a href="{{route('employerlogin')}}">Are you an Employer?</a></p>	
										<br>											
									</header>											
									<form name="login" method="post" action="{{URL::to('/candidate/signup')}}" accept-charset="utf-8" align="right" autocomplete='off'>										
										{{ csrf_field() }}	
										<input type="hidden" name="account_type" value="candidate">	             										
											<div class="row">							
												<div class="6u 12u(medium)" align="right">								
													<input id="first_name" name="first_name" type="text" placeholder="First Name" maxlength="40" autofocus required>
												</div>	
												<div class="6u 12u(medium)">								
													<input id="last_name" name="last_name" type="text" placeholder="Last Name" required maxlength="40">
												</div>																		
											</div>

											<div class="row">							
												<div class="12u 12u(medium)">								
													<input id="email" name="email" type="email" placeholder="Email" autocomplete="false" required>
												</div>																										
											</div>
											<div class="middleware_msg" id="email_errmsg"></div>  
											<div class="row">												
												<div class="12u 12u(medium)">								
													<input id="password" name="password" type="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" 
													title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" required autocomplete="new-password" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');">
												</div>																		
											</div>
											<div class="6u 12u(medium)" align="left">								
													<input id="promotion" name="promotion" type="checkbox" checked=""><span>Receive promotions and highlights</span>
											</div>
											<div class="row">
												<div class="12u 12u(medium)" align="right">
													<input type="submit" id="submit" value="Register">													
												</div>												
											</div>
											<div class="6u 12u(medium)" align="left">								
													<label>Already have an account? <a href="#login-wrapper">Sign in</a> </label>
											</div>	
											<div class="middleware_msg">{{Session::get('loginstatus')}}</div>										
									</form>		
									</div>								
								</section>
							</div>
							<div class="4u 12u(medium)">
								<!-- Box -->
								<section class="box feature">
									<a href="#" class="image featured"><img src="img/signup-screen-thumbnail.png" alt="" /></a>										
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
													<div class="6u"><a href="#" class="image fit"><img src="img/pic04.jpg" alt="" /></a></div>
													<div class="6u"><a href="#" class="image fit"><img src="img/pic05.jpg" alt="" /></a></div>
													<div class="6u"><a href="#" class="image fit"><img src="img/pic06.jpg" alt="" /></a></div>
													<div class="6u"><a href="#" class="image fit"><img src="img/pic07.jpg" alt="" /></a></div>
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
											<h2>JobKonner Lets you see all the possibilities</h2>
											<p>This is <strong>joBKonner</strong>, a job portal for candidates to find your dream job and for employer to find their next hire to grow your business. This is a subsidery of <a href="http://www.konnersoft.com/" target="_blank"> Konnersoft </a>.
											jobkonner is released under the <a href="#">Common license</a> of Konnersoft, so feel free to use it for any personal or commercial use </p>
											<p>Phasellus quam turpis, feugiat sit amet ornare in, hendrerit in lectus. Praesent semper bibendum ipsum, et tristique augue fringilla eu. Vivamus id risus vel dolor auctor euismod quis eget mi. Etiam eu ante risus. Aliquam erat volutpat. Aliquam luctus mattis lectus sit amet phasellus quam turpis.</p>
											<a href="#" class="button icon fa-arrow-circle-right">Continue Reading</a>
										</section>										
									</div>

							</div>
						</div>
					</div>
				</div>
@stop

@section('scripts')
<script type="text/javascript">
sessionStorage.clear();
$(document).on('blur', '#email', function() {	
   $('#email_errmsg').html('');
   $('#email').removeClass('form_required');
   $('#save_btn').prop('disabled', false);
   var email = $(this).val(); 
   if(email)
      checkemail(email, 'employer');   
   //else
      //$('#email').addClass('form_required').focus();
});

</script>
@stop
	