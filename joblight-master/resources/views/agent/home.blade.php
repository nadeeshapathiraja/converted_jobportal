@extends('include.global_template')
@include('include.agent.mainheader')

@section('main')		
	<div id="features-wrapper">
		<div class="container">		            
            <div class="box">
                <div class="row">
                    <div class="4u 12u(medium)" style="padding-top:10px;">  
                        Invite sent : {{$invite_sent}}
                    </div>       
                    <div class="4u 12u(medium)" style="padding-top:10px;">   
                        Invite Accepted : {{$invite_accepted}}
                    </div>       
                    <div class="4u 12u(medium)" style="padding-top:10px;">   
                        Registered : {{$invite_registered}}
                    </div>     
                </div>                       
            </div>  
		</div>
	</div>

@stop
