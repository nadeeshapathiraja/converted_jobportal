@extends('template.include.master')
@include('template.include.candidate_header')
@include('template.include.candidate_footer')
@section('main')
			
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
				 							<li><a class="theme-color" href="{{route('candidatesettings')}}" title="">Bank Details</a></li>
				 							<li><a href="{{route('candidate_change_password')}}" title="">Change Password</a></li>
				 						</ul>
				 					</li>				 					
				 				</ul>
				 			</div>
				 		</div>					 		
				 	</aside>			 	
				 	<div class="col-lg-9 column">
				 		<div class="padding-left">
					 		<div class="manage-jobs-sec">
					 			<h3>Bank Details</h3>
						 		<div class="change-password">
						 			<form method="post" action="{{route('candidatesave')}}" accept-charset="utf-8">
						 				<div class="row">
						 					<div class="col-lg-6">						 						
						 						{!!Form::hidden('formtype', 'bank_details')!!}		
												{!!Form::hidden('candidate_profile_id', Session::get('user.candidateprofileid'))!!}
						 						<span class="pf-title">Account Name</span>
						 						<div class="pf-field">
													<input id="acc_name" name="acc_name" type="text" placeholder="Account Name" value="{{$userprofile->acc_name}}" required>
						 						</div>
						 						<span class="pf-title">Account Number</span>
						 						<div class="pf-field">
													<input id="acc_no" name="acc_no" type="text" placeholder="Account Number" value="{{$userprofile->acc_no}}" required>
						 						</div>
						 						<span class="pf-title">Confirm Password</span>
						 						<div class="pf-field">
						 							{!! Form::select('bank', $bank, $userprofile->bank, ['id'=>'bank', 'class' => 'chosen', 'required']) !!}    
						 						</div>
						 						<button type="submit">Save</button>
						 					</div>
						 					<div class="col-lg-6">
						 						<i class="la la-credit-card big-icon"></i>
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
