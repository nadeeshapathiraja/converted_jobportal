@extends('include.global_template')
@include('include.agent.guest_header')
@include('include.agent.guest_footer')

@section('main')
			<!-- Login for employer-->

			<form name="login" method="post" action="{{URL::to('/candidate/login')}}" accept-charset="utf-8" align="right">				
				{{ csrf_field() }}	
				<input type="hidden" name="account_type" value="agent">	             
				<div id="login-wrapper">
					<div class="box container">
					<div class="middleware_msg_success">{{Session::get('verifystatus')}}</div>
						<div class="row">
							<div class="2u 12u(medium)" align="right">
								<label>Agent Login:</label>
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
							<p>Earn by being an Agent. Work for us.</p>
						</div>
						<div class="5u 12u(medium)">
							<ul>								
								<li><a data-fancybox data-src="#modal" href="javascript:;" class="button big icon fa-arrow-circle-right">Contact Us</a></li>								
								<li><a href="#" class="button alt big icon fa-question-circle">Learn More</a></li>								
							</ul>							
						</div>
					</div>
				</div>
			</div>
			
		  <div style="display:none;" id="modal">		   				
				<div class="">
					<!-- Box -->
					<section class="box feature">																								
						<header>
							<h2>Submit an Enquiry and We will get in touch</h2>										
							<br>											
						</header>											
						<form method="post" action="{{route('postenquiry')}}" accept-charset="utf-8" align="right" autocomplete='off'>										
							{{ csrf_field() }}											
							<input type="hidden" name="type" value="agent">
								<div class="row">							
									<div class="12u 12u(medium)" align="right">								
										<input id="name" name="name" type="text" placeholder="Name" maxlength="40" autofocus required>
									</div>																													
								</div>
								<div class="row">												
									<div class="4u 12u(medium)">	
						            	<input class="form-control" id="geo_autocomplete" name="city" placeholder="City" type="text"></input>
						            </div>
						            <div class="4u 12u(medium)">	
						            	<input class="form-control" id="state" name="state" placeholder="State" type="text"></input>
						            </div>	
						            <div class="4u 12u(medium)">
						        		{!! Form::select('country', $country, null, ['id'=>'country', 'class' => 'form-control', 'required']) !!}    	
						            </div>
						        </div> 	
						        
								<div class="row">							
									<div class="6u 12u(medium)">								
										<input id="email" name="email" type="email" placeholder="Email" autocomplete="false" required>
									</div>																										
									<div class="6u 12u(medium)">								
										<input id="phone" name="phone" type="text" placeholder="Contact No" autocomplete="false" required>
									</div>	
								</div>											

								<div class="middleware_msg" id="email_errmsg"></div>  																					
								<div class="row">																							
									<div class="12u 12u(medium)" align="right">
										<input type="submit" id="submit_enquiry" value="Submit">													
									</div>												
								</div>											
								<div class="middleware_msg">{{Session::get('loginstatus')}}</div>										
						</form>														
					</section>
				</div>																
		  </div>
@stop

@section('scripts')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBalFpLm5S9IyehiU8bjgqe_webG9VTnLQ&amp;libraries=places&amp;callback=geolocate_min" async="" defer=""></script>

@stop
	