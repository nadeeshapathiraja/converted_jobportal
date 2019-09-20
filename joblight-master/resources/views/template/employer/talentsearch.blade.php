@extends('template.include.master')
@include('template.include.employer_header')
@include('template.include.employer_footer')
@section('main')
	
	<section>
		<div class="block no-padding">
			<div class="container">
				 <div class="row no-gape">	
				 	@include('template.employer._talentsearch_aside')			 					 	
				 	<div class="col-lg-9 column">
				 		<div class="modrn-joblist">	 
				 		<form method="GET" action="{{ route('talentsearch') }}" accept-charset="UTF-8" id="seek" name="seek">
							<span for="core_skills" class="pf-title">Search using Core Skills</span>
							<div class="pf-field dropdown-field">
								{!! Form::select('skills[]', array(), null, ['id' => 'core_skills', 'class' => 'multiple-core-skill', 'multiple' => 'multiple', 'required']) !!}
							</div>	
							<button type="submit">Search</button>							 	
						</form>	
						 </div><!-- MOdern Job LIst -->
				 		<div class="padding-left">
					 		<div class="manage-jobs-sec">
					 			<h3>Talent Search</h3>
					 			<div class="emply-list-sec">
						 			@foreach ($candidate_details as $detail)
						 			<div class="emply-list">
						 				<div class="emply-list-info mini-profile">
							                @if(isset($detail->work))
							                <h6><b>Work History</b></h6>
							                 @foreach ($detail->work as $work)                  
							                    <h5>{{$work->position}} <i>({{$work->total_years}})</i> </h5>
							                  @endforeach
							                @endif                 							              
							                
							              	@if(isset($detail->education))
							              	<h6><b>Education Qualifications</b></h6>
							                	@foreach ($detail->education as $edu)
							                  		<span>{{$edu->degree}}, {{$edu->school_name}}</span>
							                	@endforeach
							                @endif						 				
						 				</div>
						 				<div class="emply-list-info">
						 					@if($detail->resume_downloaded > 0)
							                  <div class="emply-pstn">Resume Downloaded</div>
							                @else							                  
							                <div class="emply-pstn">
							                	<a href="" onclick="downloadresume('{{route('downloadresume')}}' , '{{$detail->candidate_profile_id}}', '{{$detail->account_id}}', null, this);return false;">
							                 		Download Resume
							             		</a>
							             	</div>
							                @endif	
							                <div class="emply-pstn-bottom">{{$detail->match_rating}}
							                	@for ($i = 1; $i <= 5; $i++)
							                		@if($i <= $detail->match_rating)
							                			<span class="la la-star rating-star-checked"></span>
							                		@else
							                			<span class="la la-star-o"></span>
							                		@endif
							                	@endfor						 						
						 					</div>
						 					<h3><a href="#" title=""><b>Total Work Experience:</b> {{$detail->total_years}}</a></h3>
						 					<span>{{$detail->core_skills_text}}</span>
						 					<h6><i class="la la-dollar"></i> <b>Expected Salary :</b> {{$detail->prefered_salary_currency}} {{$detail->prefered_salary}}</h6>
						 					<p>{{ substr($detail->about_myself, 0, 200)}} <span class="more_text">{{ substr($detail->about_myself, 200)}}</span>
						 					<a class="theme-color" id="toggleButton" onclick="toggleText(this);" href="javascript:void(0);"><i>See More</i></a>						 						
						 				</div>
						 			</div><!-- Employe List -->		
						 			@endforeach		 			
						 		</div>					 									 	
					 		</div>
					 	</div>
					</div>
				 </div>
			</div>
		</div>
	</section>	
	
@stop	
@section('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />        
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">

	$(document).ready(function() {	
		//Implement select2
		$("#core_skills").select2({
            ajax: {
              url: '<?php echo URL::to("/autocomplete/core_skill/") ?>',
              dataType: 'json',
              delay: 250,
              data: function (params) {
                return {
                  keyword: params.term, // search term
                  page: params.page
                };
              },
              processResults: function (data, params) {                
                params.page = params.page || 1;
                return {
                  results: data.items,
                  pagination: {
                    more: (params.page * 30) < data.total_count
                  }
                };
              },
              cache: true
            },
            placeholder: 'Search Skills',
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 2,
            //theme: "bootstrap",
            maximumSelectionLength: 7,        
            allowClear: true,
            dropdownAutoWidth: true,
            width: '100%',            
    		//tokenSeparators: [',', ' ', ';']        
          });
	});	
var status = "less";

function toggleText(obj)
{       
	var curr_obj = $(obj);
	var parent = curr_obj.closest('more_text');

    if (status == "less") {
        document.getElementById("textArea").innerHTML=text;
        document.getElementById("toggleButton").innerText = "See Less";
        status = "more";
    } else if (status == "more") {
        document.getElementById("textArea").innerHTML = "";
        document.getElementById("toggleButton").innerText = "See More";
        status = "less"
    }
}
</script>
@stop

