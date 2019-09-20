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
		<div class="block no-padding  gray">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="inner2">
							<div class="inner-title2">
								<h3>Agent Login</h3>
								<span>Keep up to date with the latest news</span>
							</div>							
							<div class="page-breacrumbs">
								<ul class="breadcrumbs">
									<li><a href="#" title="">Home</a></li>
									<li><a href="#" title="">Agent</a></li>
									<li><a href="#" title="">Login</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="block remove-bottom">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="account-popup-area signin-popup-box static">
							<div class="account-popup">
								<span>Login using email and password</span>
								<form name="login" method="post" action="{{URL::to('/candidate/login')}}" accept-charset="utf-8">
									{{ csrf_field() }}	
									<input type="hidden" name="account_type" value="agent">	
									<div class="cfield">
										<input type="text" id="username" name="login_id" placeholder="Username" />
										<i class="la la-user"></i>
									</div>
									<div class="cfield">
										<input type="password" id="password" name="password" placeholder="********" />
										<i class="la la-key"></i>
									</div>
									<p class="remember-label">
										<input type="checkbox" name="cb" id="cb1"><label for="cb1">Remember me</label>
									</p>
									<a href="#" title="">Forgot Password?</a>
									<button type="submit">Login</button>
									<div class="middleware_msg">{{Session::get('loginstatus')}}</div>
								</form>
								<div class="extra-login">
									<span>Or</span>
									<div class="login-social">
										<a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i></a>
										<a class="tw-login" href="#" title=""><i class="fa fa-twitter"></i></a>
									</div>
								</div>
							</div>
						</div><!-- LOGIN POPUP -->
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
							<a href="#" title="" class="rounded agent-popup"><h3>Got a question on how to become a Agent?</h3></a>
							<span>We're here to help. Check out our FAQs, send us an email or call us at 1 (800) 555-5555</span>
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
	<div class="account-popup-area agent-popup-box">
		<div class="account-popup data-entry-popup">
			<span class="close-popup"><i class="btntabcancel la la-close"></i></span>
			<!-- Box -->																								
			<header>
				<h2>Submit an Enquiry and We will get in touch</h2>										
				<br>											
			</header>											
			<form method="post" action="{{route('postenquiry')}}" accept-charset="utf-8" align="right" autocomplete='off'>										
				{{ csrf_field() }}											
					<input type="hidden" name="type" value="agent">
					<div class="cfield">
						<input id="name" name="name" type="text" placeholder="Name" maxlength="40" autofocus required>
						<i class="la la-user"></i>
					</div>
					<div class="cfield">
						<input id="email" name="email" type="email" placeholder="Email" autocomplete="false" required>
						<i class="la la-key"></i>
					</div>
					<div class="cfield">
						<input id="phone" name="phone" type="text" placeholder="Contact No" autocomplete="false" required>
						<i class="la la-phone"></i>
					</div>

					<div class="cfield">																		
			            <input class="form-control" id="geo_autocomplete" name="city" placeholder="City" type="text">
			        </div>
			        <div class="cfield">																		
		            	<input class="form-control" id="state" name="state" placeholder="State" type="text">
		            </div>	
			        <div class="cfield">
		        		{!! Form::select('country', $country, null, ['id'=>'country', 'class' => 'chosen', 'required']) !!}    	
		            </div>

					<div class="middleware_msg" id="email_errmsg"></div>  														
					<button class="btntabsave btn btn-primary" >Submit</button>
					<div class="middleware_msg">{{Session::get('loginstatus')}}</div>										
			</form>																	
		</div>																
 	 </div>
@stop
@section('scripts')
<script type="text/javascript">
	$(window).on('beforeunload', function() {
		$(window).scrollTop(0);
	});
</script>
@stop