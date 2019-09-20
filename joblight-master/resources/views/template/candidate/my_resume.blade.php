@extends('template.include.master')
@include('template.include.candidate_header')
@include('template.include.candidate_footer')
@section('main')	
	<section>
		<div class="block remove-top">
			<div class="container">
				 <div class="row no-gape">
				 	@include('template.candidate._aside')
				 	<div class="col-lg-9 column">
				 		<div class="padding-left">
					 		<div class="manage-jobs-sec">
					 			<div class="border-title"><h3>Education</h3><!-- <a href="#" title=""><i class="la la-plus"></i> Add Education</a> --></div>
						 		<div class="edu-history-sec">
								    @foreach ($education as $k => $value)
								        <div class="edu-history">
								        	<i class="la la-graduation-cap"></i>
			 								<div class="edu-hisinfo">
			 									<h3>University</h3>
			 									<i>{{ date('F,Y', strtotime($value->enrolldate))}} - {{ ($value->still_studying =='N')? date('F,Y', strtotime($value->grad_date)) : 'Yet to Graduted' }}</i>
			 									<span>{{$value->school_name}} ({{$value->city}}, {{$value->country}}) <i>{{ (isset($degree[$value->degree]) && $value->degree != '' )? $degree[$value->degree] : ''}}</i></span>
			 									<p>							      
									      			@foreach ($value->additionalskills as $key => $val)
											          {{$val->content. ', '}}
											      	@endforeach
									  			</p>
									      	</div>
									      	<!-- <ul class="action_job">
					 							<li><span>Edit</span><a id='loadeducationdata{{$k}}' class ="editnavbar" action-tab="#tab_school" href="{{route('candidateprofile', ['mode' =>'edit'])}}"><i class="la la-pencil"></i></a></li>
					 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
					 						</ul> -->
									    </div>
								    @endforeach
		 							<!-- <div class="edu-history">
		 								<i class="la la-graduation-cap"></i>
		 								<div class="edu-hisinfo">
		 									<h3>University</h3>
		 									<i>2008 - 2012</i>
		 									<span>Middle East Technical University <i>Computer Science</i></span>
		 									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
		 								</div>
		 								<ul class="action_job">
				 							<li><span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a></li>
				 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
				 						</ul>
		 							</div> -->		 							
		 						</div>
		 						<div class="border-title"><h3>Work Experience</h3><!-- <a href="#" title=""><i class="la la-plus"></i> Add Experience</a> --></div>
						 		<div class="edu-history-sec">								    
							    	@foreach ($workexp as $k => $value) 
							        <div class="edu-history style2">
							        	<i></i>
		 								<div class="edu-hisinfo">
		 									<h3> {{$value->position}} <span> {{$value->employername}} </span> </h3>
		 									<span>{{$value->city}}, {{$value->country}}</span>
		 									<i>{{ date('F,Y', strtotime($value->start_date))}} - {{ ($value->still_working =='N')? date('F,Y', strtotime($value->end_date)) : 'Present' }}</i>
		 									<p>
										        @foreach ($value->additionalskills as $key => $val)
										          {{$val->content. ', '}}
										      	@endforeach 
								  			</p>
								      	</div>
								      	<!-- <ul class="action_job">
				 							<li><span>Edit</span><a id='loadempdata{{$k}}' class ="editnavbar" action-tab="#tab_work" href="{{route('candidateprofile', ['mode' =>'edit'])}}"><i class="la la-pencil"></i></a></li>
				 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
				 						</ul> -->
								    </div>
							   		@endforeach    
		 							<!-- <div class="edu-history style2">
		 								<i></i>
		 								<div class="edu-hisinfo">
		 									<h3>Web Designer <span>Inwave Studio</span></h3>
		 									<i>2008 - 2012</i>
		 									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
		 								</div>
		 								<ul class="action_job">
				 							<li><span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a></li>
				 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
				 						</ul>
		 							</div> -->		 							
		 						</div>
		 						<!-- <div class="border-title"><h3>Portfolio</h3><a href="#" title=""><i class="la la-plus"></i> Add Portfolio</a></div>
		 						<div class="mini-portfolio">
		 							<div class="mp-row">
		 								<div class="mp-col">
		 									<div class="mportolio"><img src="http://placehold.it/165x115" alt="" /><a href="#" title=""><i class="la la-search"></i></a></div>
		 									<ul class="action_job">
				 							<li><span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a></li>
				 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
				 						</ul>
		 								</div>
		 								<div class="mp-col">
		 									<div class="mportolio"><img src="http://placehold.it/165x115" alt="" /><a href="#" title=""><i class="la la-search"></i></a></div>
		 									<ul class="action_job">
				 							<li><span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a></li>
				 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
				 						</ul>
		 								</div>
		 								<div class="mp-col">
		 									<div class="mportolio"><img src="http://placehold.it/165x115" alt="" /><a href="#" title=""><i class="la la-search"></i></a></div>
		 									<ul class="action_job">
				 							<li><span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a></li>
				 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
				 						</ul>
		 								</div>
		 								<div class="mp-col">
		 									<div class="mportolio"><img src="http://placehold.it/165x115" alt="" /><a href="#" title=""><i class="la la-search"></i></a></div>
		 									<ul class="action_job">
				 							<li><span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a></li>
				 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
				 						</ul>
		 								</div>
		 							</div>
		 						</div> -->
		 						<div class="border-title"><h3>Professional Skills</h3><!-- <a href="#" title=""><i class="la la-plus"></i> Add Skills</a> --></div>
		 						<div class="progress-sec">		 							
		 							@foreach (explode(',',$core_skills_list) as $value)
									  <div class="progress-sec with-edit">
		 								<span>{{$value}}</span>
		 								<div class="progressbar"> <div class="progress" style="width: 100%;"><!-- <span>80%</span> --></div> </div>
		 								<!-- <ul class="action_job">
				 							<li><span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a></li>
				 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
				 						</ul> -->
		 							</div>
		 							@endforeach									
		 							<!-- <div class="progress-sec with-edit">
		 								<span>Adobe Photoshop</span>
		 								<div class="progressbar"> <div class="progress" style="width: 80%;"><span>80%</span></div> </div>
		 								<ul class="action_job">
				 							<li><span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a></li>
				 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
				 						</ul>
		 							</div> -->		 							
		 						</div>
		 						<div class="border-title"><h3>Additional Skills</h3><!-- <a href="#" title=""><i class="la la-plus"></i> Add Skills</a> --></div>
		 						<div class="edu-history-sec">
		 							@foreach ($additionalskill as $key => $val)		 							  
									  <div class="edu-history">
									  	<i class="la la-bullseye"></i>
		 								<i></i>
		 								<div class="edu-hisinfo">
		 									<h3>{{$val->content}}</h3>		 									
		 								</div>
		 								<!-- <ul class="action_job">
				 							<li><span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a></li>
				 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
				 						</ul> -->
		 							</div>
		 							@endforeach	
		 							<!-- <div class="edu-history style2">
		 								<i></i>
		 								<div class="edu-hisinfo">
		 									<h3>Perfect Attendance Programs</h3>
		 									<i>2008 - 2012</i>
		 									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
		 								</div>
		 								<ul class="action_job">
				 							<li><span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a></li>
				 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
				 						</ul>
		 							</div> -->
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
<script type="text/javascript">
  $( ".editnavbar" ).on( "click", function(e) {     
    sessionStorage.setItem('current_tab', $(this).attr('action-tab'));
    sessionStorage.setItem('loadid',$(this).attr('id'));
  });
</script>
@stop