@extends('include.global_template')
@include('include.agent.guest_header')
@include('include.agent.guest_footer')

@section('main')			
				<div id="features-wrapper">
					<div class="container">
						<div class="row">
							<div class="8u 12u(medium)">
								<!-- Box -->
								<section class="box feature">
									<div id="signup" class="inner" style="cursor:auto;">																			
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
													<input type="submit" id="submit" value="Submit">													
												</div>												
											</div>											
											<div class="middleware_msg">{{Session::get('loginstatus')}}</div>										
									</form>		
									</div>								
								</section>
							</div>
							<div class="4u 12u(medium)">
								<!-- Box -->
								<section class="box feature">
									<a href="#" class="image featured"><img src="http://www.krishmettech.com/images/enquiry.png" alt="" /></a>										
								</section>
							</div>							
						</div>
					</div>
				</div>			
@stop

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBalFpLm5S9IyehiU8bjgqe_webG9VTnLQ&amp;libraries=places&amp;callback=geolocate_min" async="" defer=""></script>
@stop
	