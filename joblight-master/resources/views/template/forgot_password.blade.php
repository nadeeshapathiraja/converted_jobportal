@extends('template.include.master')
@include('template.include.index_header')
@include('template.include.index_footer')
@section('main')	
	@if(Session::get('linkexpired') === 'true')
	<section>
		<div class="block no-padding" tabindex="1">
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="simple-text">
							<h3>The Password Reset Link has expired</h3>
							<span>Please login to confirm else generate another reset link below</span> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endif	
	<section>
		<div class="block gray">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="subscription-sec">
							<div class="row">
								<div class="col-lg-6">
									<h3>Forgot Password?</h3>
									<span>Enter your email address and we'll send you a link to reset your password.</span>
								</div>
								<div class="col-lg-6">
									<form method="post" action="{{route('reset-password-mail')}}" accept-charset="utf-8">
										<input type="text" name="email" placeholder="Enter Registered Email Address" />
										<button type="submit"><i class="la la-paper-plane"></i></button>										
									</form>
									{!! $errors->first('email', '<span class="theme-color">:message</span>') !!}   
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
@stop
