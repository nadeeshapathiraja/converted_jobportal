@extends('include.employer.maintemplate')
@include('include.employer.mainheader')
@include('include.employer.topactionbar')

@section('main')		
	<div id="features-wrapper">
		<div class="container">
			<div class="box">
                <div class="row">
                    <div class="3u 12u(medium)" style="padding-top:10px;">  
                        No of Job Posted 
                        <div>{{$no_posted}}</div>
                    </div>       
                    <div class="3u 12u(medium)" style="padding-top:10px;">   
                        No of responses
                        <div>Max - {{$max_response}}</div>
                        <div>Min - {{$min_response}}</div>
                        <div>Average - {{$avg_response}}</div>
                    </div>       
                    <div class="3u 12u(medium)" style="padding-top:10px;">   
                        No of downloads
                        <div>{{$no_downloaded}}</div>
                    </div>
                    <div class="3u 12u(medium)" style="padding-top:10px;">   
                        Average Spend on Advertisement
                        <div>{{$avg_spend_adv}}</div>
                    </div>     
                </div>                       
            </div> 
		</div>
	</div>

@stop
