@extends('include.global_template')
@include('include.candidate.guest_header')
@include('include.candidate.guest_footer')

@section('main')			
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
										{!! Form::hidden('referralkey',$referralkey) !!}
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
												<div class="4u 12u(medium)" align="left">								
														<input id="referral_code" name="referral_code" type="text" placeholder="Referral Code" maxlength="40" value="{{$referral_code}}" {{($referral_code)? 'disabled' : '' }}>
												</div>											
												<div class="8u 12u(medium)" align="right">
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
									<a href="#" class="image featured"><img src="{{asset('img/signup-screen-thumbnail.png')}}" alt="" /></a>										
								</section>
							</div>							
						</div>
					</div>
				</div>			
@stop

@section('scripts')
<script type="text/javascript">
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
	