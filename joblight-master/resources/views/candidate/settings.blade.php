@extends('include.global_template')
@include('include.candidate.mainheader')
@section('main')
<div id="feature-wrapper">
    <div class="container">
        <div class="row 200%">
            <div class="12u 12u$(medium) important(medium)">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Settings</a></li>                    
                </ul>   
            </div>
            <div class="10u 12u(medium)" style="padding-top:10px;"> 		
				<div class="box">            																														
					<h3>Bank details to Payout</h3>					
					<form method="post" action="{{route('candidatesave')}}" accept-charset="utf-8" align="right" autocomplete='off'>										
						{{ csrf_field() }}			
						{!!Form::hidden('formtype', 'bank_details')!!}		
						{!!Form::hidden('candidate_profile_id', Session::get('user.candidateprofileid'))!!}
							<div class="row">							
								<div class="12u 12u(medium)" align="right">								
									<input id="acc_name" name="acc_name" type="text" placeholder="Account Name" maxlength="40" autofocus required value="{{$userprofile->acc_name}}">
								</div>																													
							</div>
							<div class="row">							
								<div class="12u 12u(medium)" align="right">								
									<input id="acc_no" name="acc_no" type="text" placeholder="Account Number" maxlength="40" autofocus required value="{{$userprofile->acc_no}}">
								</div>																													
							</div>
							<div class="row">							
								<div class="12u 12u(medium)" align="right">																	
									{!! Form::select('bank', $bank, $userprofile->bank, ['id'=>'bank', 'class' => 'form-control', 'required']) !!}    	
								</div>																													
							</div>																							
							<div class="row">																							
								<div class="12u 12u(medium)" align="right">
									<input type="submit" id="submit_enquiry" value="Submit">													
								</div>												
							</div>																									
					</form>																					
				</div>
			</div>		
    </div>
</div>

@stop
@section('scripts')

@stop