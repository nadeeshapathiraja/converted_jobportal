@extends('template.include.master')
@include('template.include.index_header')
@include('template.include.index_footer')
@section('main')	
	
	
	<section>
		<div class="block no-padding">
			<div class="container">
				 <div class="row no-gape">				 	
				 	<div class="col-lg-9 column">
				 		<div class="padding-left">
					 		<div class="manage-jobs-sec">
					 			<h3>Reset Password</h3>
						 		<div class="change-password">
						 			<form method="post" action="{{route('save-reset-password')}}" accept-charset="utf-8">
						 				<div class="row">
						 					<div class="col-lg-6">
						 						<span class="pf-title">Email address</span>
						 						<h4>{{$email}}</h4>		
						 						<input type="hidden" name="login_id" value="{{$email}}">
						 						<input type="hidden" name="account_type" value="{{$account_type}}">
						 						<span class="pf-title">New Password</span>
						 						<div class="pf-field">
													<input id="password" name="password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Password must contain at least 6 characters, including UPPER/lowercase and numbers' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;" placeholder="Password" required>
						 						</div>
						 						<span class="pf-title">Confirm Password</span>
						 						<div class="pf-field">
						 							<input id="password_two" name="password_two" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" placeholder="Verify Password" required>
						 						</div>
						 						<button type="submit">Reset</button>
						 					</div>
						 					<div class="col-lg-6">
						 						<i class="la la-key big-icon"></i>
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
	</section>
@stop
