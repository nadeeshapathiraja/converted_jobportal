@extends('template.include.master')
@include('template.include.candidate_header')
@include('template.include.candidate_footer')
@section('main')
	
	@if(Session::get('mismatch') === 'true')
	<section>
		<div class="block no-padding" tabindex="1">
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="simple-text">
							<h3>Current Password Mismatch</h3>
							<span>Current Password is wrong, Please provide correct password to change it.</span> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endif	
	@if(Session::get('status') === 'true')
	<section>
		<div class="block no-padding" tabindex="1">
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="simple-text">
							<h3>Password Changed Successfully</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endif	
	<section>
		<div class="block no-padding">
			<div class="container">
				 <div class="row no-gape">	
				 	<aside class="col-lg-3 column border-right">
				 		<div class="widget">
				 			<div class="tree_widget-sec">
				 				<ul>
				 					<li class="inner-child">
				 						<a href="#" title=""><i class="la la-file-text"></i>Settings</a>
				 						<ul>
				 							<li><a href="{{route('candidatesettings')}}" title="">Bank Details</a></li>
				 							<li><a class="theme-color" href="{{route('candidate_change_password')}}" title="">Change Password</a></li>
				 						</ul>
				 					</li>				 					
				 				</ul>
				 			</div>
				 		</div>					 		
				 	</aside>		 	
				 	<div class="col-lg-9 column">
				 		<div class="padding-left">
					 		<div class="manage-jobs-sec">
					 			<h3>Change Password</h3>
						 		<div class="change-password">
						 			<form method="post" action="{{route('candidatesave')}}" accept-charset="utf-8">
						 				<div class="row">
						 					<div class="col-lg-6">
						 						<input type="hidden" name="formtype" value="password">				 						
						 						<span class="pf-title">Current Password</span>
						 						<div class="pf-field">
													<input id="old_password" name="old_password" type="password" placeholder="Current Password" required>
						 						</div>
						 						<span class="pf-title">New Password</span>
						 						<div class="pf-field">
													<input id="password" name="password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Password must contain at least 6 characters, including UPPER/lowercase and numbers' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;" placeholder="New Password" required>
						 						</div>
						 						<span class="pf-title">Confirm Password</span>
						 						<div class="pf-field">
						 							<input id="password_two" name="password_two" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" placeholder="Verify Password" required>
						 						</div>
						 						<button type="submit">Update</button>
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
