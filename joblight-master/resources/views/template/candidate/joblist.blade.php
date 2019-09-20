@extends('template.include.master')
@include('template.include.candidate_header')
@include('template.include.candidate_footer')
@section('main')
	<section>
		<div class="block no-padding">
			<div class="container">
				 <div class="row no-gape">
				 	@if(empty($mode))
				 	<aside class="col-lg-4 column border-right">
				 	<form method="GET" action="{{ route('jobsearch') }}" accept-charset="UTF-8" id="seek" name="seek"> 
				 		{!! Form::hidden('size', $size, ['id' => 'searchcriteria_size']) !!}
				 		{!! Form::hidden('sort', $sort, ['id' => 'searchcriteria_sort']) !!}
				 		<div class="widget">
				 			<div class="search_widget_job">
				 				<div class="field_w_search">
				 					<input name="keyword" type="text" placeholder="Search Keywords" class="searchcriteria-text" value="{{$selected_keyword}}"/>
				 					<i class="la la-search"></i>
				 				</div><!-- Search Widget -->
				 				<div class="field_w_search">
				 					<input name="location" type="text" placeholder="All Locations" class="searchcriteria-text" value="{{$selected_location}}"/>
				 					<i class="la la-map-marker"></i>
				 				</div><!-- Search Widget -->
				 			</div>
				 		</div>
				 		<div class="widget">
				 			<h3 class="sb-title open">Date Posted</h3>
				 			<div class="posted_widget">
				 				@foreach ($job_since as $key => $value)                        	                                
	                                <input type="radio" name="since" id="date_{{$key}}" value="{{$key}}" class="searchcriteria-text"><label for="date_{{$key}}">{{$value}}</label><br />
	                            @endforeach  								
				 			</div>
				 		</div>
				 		<div class="widget">
				 			<h3 class="sb-title open">Job Type</h3>
				 			<div class="type_widget">
				 				@foreach ($job_type as $key => $value)	                                
	                                <p class="ischek"><input type="checkbox" name="type" id="jobtype_{{$key}}" value="{{$key}}" class="searchcriteria-text"><label for="jobtype_{{$key}}">{{$value}}</label></p>
	                            @endforeach								
				 			</div>
				 		</div>
				 		<div class="widget">
				 			<h3 class="sb-title open">Specialism</h3>
				 			<div class="specialism_widget">
								<div class="field_w_search">
				 					<input type="text" placeholder="Search Spaecialisms" />
				 				</div><!-- Search Widget -->
				 				<div class="simple-checkbox scrollbar">
				 					@foreach ($job_category as $key => $value)
		                                <p><input type="checkbox" name="category" id="category_{{$key}}" value="{{$key}}" class="searchcriteria-text"><label for="category_{{$key}}">{{$value}}</label></p>
		                            @endforeach 									
				 				</div>
				 			</div>
				 		</div>
				 		<div class="widget">
				 			<h3 class="sb-title open">Career Level</h3>
				 			<div class="specialism_widget">
				 				<div class="simple-checkbox">
				 					@foreach ($job_level as $key => $value)
		                                <p><input type="checkbox" name="level" id="level_{{$key}}" value="{{$key}}" class="searchcriteria-text"><label for="level_{{$key}}">{{$value}}</label></p>
		                            @endforeach									
				 				</div>
				 			</div>
				 		</div>
				 		<div class="widget">
				 			<h3 class="sb-title closed">Offerd Salary</h3>
				 			<div class="specialism_widget">
				 				<div class="simple-checkbox">
									<p><input type="checkbox" name="smplechk" id="1"><label for="1">10k - 20k</label></p>
									<p><input type="checkbox" name="smplechk" id="2"><label for="2">20k - 30k</label></p>
									<p><input type="checkbox" name="smplechk" id="3"><label for="3">30k - 40k</label></p>
									<p><input type="checkbox" name="smplechk" id="4"><label for="4">40k - 50k</label></p>
				 				</div>
				 			</div>
				 		</div>				 		
				 		<div class="widget">
				 			<h3 class="sb-title closed">Experince</h3>
				 			<div class="specialism_widget">
				 				<div class="simple-checkbox">
									<p><input type="checkbox" name="smplechk" id="9"><label for="9">1Year to 2Year</label></p>
									<p><input type="checkbox" name="smplechk" id="10"><label for="10">2Year to 3Year</label></p>
									<p><input type="checkbox" name="smplechk" id="11"><label for="11">3Year to 4Year</label></p>
									<p><input type="checkbox" name="smplechk" id="12"><label for="12">4Year to 5Year</label></p>
				 				</div>
				 			</div>
				 		</div>
				 		<div class="widget">
				 			<h3 class="sb-title closed">Gender</h3>
				 			<div class="specialism_widget">
				 				<div class="simple-checkbox">
									<p><input type="checkbox" name="smplechk" id="13"><label for="13">Male</label></p>
									<p><input type="checkbox" name="smplechk" id="14"><label for="14">Female</label></p>
									<p><input type="checkbox" name="smplechk" id="15"><label for="15">Others</label></p>
				 				</div>
				 			</div>
				 		</div>
				 		<div class="widget">
				 			<h3 class="sb-title closed">Industry</h3>
				 			<div class="specialism_widget">
				 				<div class="simple-checkbox">
									<p><input type="checkbox" name="smplechk" id="16"><label for="16">Meezan Job</label></p>
									<p><input type="checkbox" name="smplechk" id="17"><label for="17">Speicalize Jobs</label></p>
									<p><input type="checkbox" name="smplechk" id="18"><label for="18">Business Jobs</label></p>
				 				</div>
				 			</div>
				 		</div>
				 		<div class="widget">
				 			<h3 class="sb-title closed">Qualification</h3>
				 			<div class="specialism_widget">
				 				<div class="simple-checkbox">
									<p><input type="checkbox" name="smplechk" id="19"><label for="19">Matriculation</label></p>
									<p><input type="checkbox" name="smplechk" id="20"><label for="20">Intermidiate</label></p>
									<p><input type="checkbox" name="smplechk" id="21"><label for="21">Gradute</label></p>
				 				</div>
				 			</div>
				 		</div>				 		
				 	</form>
				 		<div class="widget">
				 			<div class="subscribe_widget">
				 				<h3>Still Need Help ?</h3>
								<p>Let us now about your issue and a Professional will reach you out.</p>
								<form>
									<input placeholder="Enter Valid Email Address" type="text">
									<button type="submit"><i class="la la-paper-plane"></i></button>
								</form>
							</div>
				 		</div>
				 	</aside>
				 	@else
				 	@include('template.candidate._aside')
				 	@endif
				 	<div class="col-lg-8 column">
				 		<div class="modrn-joblist">
						 	<!-- 
						 	<div class="tags-bar">
						 		<span>Full Time<i class="close-tag">x</i></span>
						 		<span>UX/UI Design<i class="close-tag">x</i></span>
						 		<span>Istanbul<i class="close-tag">x</i></span>
						 		<div class="action-tags">
						 			<a href="#" title=""><i class="la la-cloud-download"></i> Save</a>
						 			<a href="#" title=""><i class="la la-trash-o"></i> Clean</a>
						 		</div>
						 	</div>
						 	<div class="pf-field no-margin">
		 						<ul class="tags">
						           <li class="addedTag">Photoshop<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Photoshop"></li>
						           <li class="addedTag">Digital & Creative<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Digital"></li>
						           <li class="addedTag">Agency<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Agency"></li>
			            			<li class="tagAdd taglist">  
			              				 <input type="text" id="search-field">
						            </li>
						            <div class="action-tags">
							 			<a href="#" title=""><i class="la la-cloud-download"></i> Save</a>
							 			<a href="#" title=""><i class="la la-trash-o"></i> Clean</a>
							 		</div>
								</ul>
							</div> -->
					 		<div class="filterbar">
					 			<span class="emlthis"><a href="mailto:example.com" title=""><i class="la la-envelope-o"></i> Email me Jobs Like These</a></span>
					 			<div class="sortby-sec">
					 				<span>Sort by</span>
					 				<select data-placeholder="Most Recent" id="page_sort" class="chosen searchcriteria-select">
										<option value="posted_at">Most Recent</option>
										<option value="company_name">Company</option>
										<option value="job_city">Location</option>
										<option value="salary_max">Salary</option>
									</select>
									<select data-placeholder="20 Per Page" id="page_size" class="chosen searchcriteria-select">
										<option value="20">20 Per Page</option>
										<option value="30">30 Per Page</option>
										<option value="40">40 Per Page</option>
										<option value="50">50 Per Page</option>										
									</select>
					 			</div>
					 			<h5>{{count($post_details)}} @if(empty($mode))  Jobs & Vacancies @else {{ucfirst($mode)}} jobs  @endif</h5>
					 		</div>
						 </div><!-- MOdern Job LIst -->
						 <div class="job-list-modern">
						 	<div class="job-listings-sec">
								@foreach ($post_details as $detail)
								<div class="job-listing wtabs">
									<div class="job-title-sec">
										<div class="c-logo"> <img onerror="this.src='http://placehold.it/98x51';" src='<?php echo env("AS3_URL").env("AS3_bucket")."/".$detail->logo_url; ?>' alt="" /> </div>
										<h3><a href="{{route('viewpost', ['post_id' => $detail->jobpost_id, 'post_title' => $detail->job_title])}}" title="">{{$detail->job_title}}</a></h3>
										<span>{{$detail->company_name}}</span>
										<div class="job-lctn"><i class="la la-map-marker"></i>{{$detail->job_city}},{{$detail->job_country}}</div>
									</div>
									<div class="job-style-bx">
										<span class="job-is ft">{{$detail->job_level}}</span>
										<span class="fav-job"><i class="la la-heart-o"></i></span>
										<i>{{date_diff(new DateTime("now"), date_create($detail->posted_at))->format('%a')}}d ago</i>
									</div>
								</div>
								@endforeach 																
							</div>
							 <div style="float:right;">{!! $post_details->render() !!}</div>
							<!-- <div class="viewmore"><span><i></i><i></i><i></i>View More</span></div> -->
						 </div>
					 </div>
				 </div>
			</div>
		</div>
	</section>
@stop
@section('scripts')
<script>
	$(".searchcriteria-text").change(function(){	
        $(this).closest('form')[0].submit();
    })
	$(".searchcriteria-select").chosen().change(function(){	
		@if(empty($mode))
			$('#searchcriteria_size').val($('#page_size').chosen().find("option:selected").val());
			$('#searchcriteria_sort').val($('#page_sort').chosen().find("option:selected").val());		
			$('#seek')[0].submit();
		@else
			var loc = window.location.href.split('?')[0];
			window.location.assign(loc+'?size='+$('#page_size').chosen().find("option:selected").val()+'&sort='+$('#page_sort').chosen().find("option:selected").val());
		@endif
    })
    @if(!empty($size))
		$('#page_size').val('<?php echo $size;?>').trigger("chosen:updated");
	@endif
	@if(!empty($sort))
		$('#page_sort').val('<?php echo $sort;?>').trigger("chosen:updated");
	@endif
	@if(!empty($selected_level))
		/*var level = JSON.parse('<?php echo json_encode($selected_level)?>');
		for (var i = level.length - 1; i >= 0; i--) {
			$('input[name=level][value='+level[i]+']').attr('checked', true);
		}					*/
		$('input[name=level][value=<?php echo $selected_level?>]').attr('checked', true);
	@endif
	@if(!empty($selected_since))
		$('input[name=since][value=<?php echo $selected_since?>]').attr('checked', true);
	@endif
	@if(!empty($selected_type))	
		$('input[name=type][value=<?php echo $selected_type?>]').attr('checked', true);
	@endif	
	@if(!empty($selected_category))
		$('input[name=category][value=<?php echo $selected_category?>]').attr('checked', true);
	@endif	
</script>
@stop
