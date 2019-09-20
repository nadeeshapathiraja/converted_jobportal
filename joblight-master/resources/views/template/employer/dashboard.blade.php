@extends('template.include.master')
@include('template.include.employer_header')
@include('template.include.employer_footer')
@section('main')
	
	<section>
		<div class="block no-padding">
			<div class="container">
				 <div class="row no-gape">				 	
				 	@include('template.employer._aside')
				 	<div class="col-lg-9 column">
				 		<div class="padding-left">
					 		<div class="manage-jobs-sec">
					 			<h3>Employer Dashboard</h3>
					 			<div class="emply-list-sec">
						 			<div class="emply-list">
						 				<div class="emply-list-thumb">
						 					<a href="#" title=""><img onerror="this.src='{{URL::asset('new/images/profile_preview.png')}}';" src='<?php echo env("AS3_URL").env("AS3_bucket")."/".$employerprofiles->logo_url; ?>' alt="" /></a>
						 				</div>
						 				<div class="emply-list-info">
						 					<div class="emply-pstn">{{$employerprofiles->credits ? $employerprofiles->credits : 0}} Credits</div>
						 					<h3><a href="#" title="">{{$employerprofiles->name}}</a></h3>
						 					<span>{{$employerprofiles->contact_person}}, {{$employerprofiles->contact_number}}</span>
						 					<h6><i class="la la-map-marker"></i> {{$employerprofiles->address}}</h6>
						 					<p>{{ substr($employerprofiles->description, 0, 200) }}</p>
						 				</div>
						 			</div><!-- Employe List -->				 			
						 		</div>
					 			<div class="extra-job-info">
						 			<span><i class="la la-clock-o"></i><strong>{{$no_posted}}</strong> Job Posted</span>
						 			<span><i class="la la-file-text"></i><strong>{{$avg_response}}</strong> Average Responses</span>
						 			<span><i class="la la-users"></i><strong>{{$no_downloaded}}</strong> Resume Downloaded</span>
						 		</div>
						 		<h3>Recently Posted</h3>
						 		<table>
						 			<thead>
						 				<tr>
						 					<td>Title</td>
						 					<td>Applications</td>
						 					<td>Created & Expired</td>
						 					<td>Status</td>
						 					<td>Action</td>
						 				</tr>
						 			</thead>
						 			<tbody>
						 				<tr>
						 					<td>
						 						<div class="table-list-title">
						 							<h3><a href="#" title="">Web Designer / Developer</a></h3>
						 							<span><i class="la la-map-marker"></i>Sacramento, California</span>
						 						</div>
						 					</td>
						 					<td>
						 						<span class="applied-field">3+ Applied</span>
						 					</td>
						 					<td>
						 						<span>October 27, 2017</span><br />
						 						<span>April 25, 2011</span>
						 					</td>
						 					<td>
						 						<span class="status active">Active</span>
						 					</td>
						 					<td>
						 						<ul class="action_job">
						 							<li><span>View Job</span><a href="#" title=""><i class="la la-eye"></i></a></li>
						 							<li><span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a></li>
						 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
						 						</ul>
						 					</td>
						 				</tr>
						 				<tr>
						 					<td>
						 						<div class="table-list-title">
						 							<h3><a href="#" title="">Web Designer / Developer</a></h3>
						 							<span><i class="la la-map-marker"></i>Sacramento, California</span>
						 						</div>
						 					</td>
						 					<td>
						 						<span class="applied-field">3+ Applied</span>
						 					</td>
						 					<td>
						 						<span>October 27, 2017</span><br />
						 						<span>April 25, 2011</span>
						 					</td>
						 					<td>
						 						<span class="status active">Active</span>
						 					</td>
						 					<td>
						 						<ul class="action_job">
						 							<li><span>View Job</span><a href="#" title=""><i class="la la-eye"></i></a></li>
						 							<li><span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a></li>
						 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
						 						</ul>
						 					</td>
						 				</tr>
						 				<tr>
						 					<td>
						 						<div class="table-list-title">
						 							<h3><a href="#" title="">Web Designer / Developer</a></h3>
						 							<span><i class="la la-map-marker"></i>Sacramento, California</span>
						 						</div>
						 					</td>
						 					<td>
						 						<span class="applied-field">3+ Applied</span>
						 					</td>
						 					<td>
						 						<span>October 27, 2017</span><br />
						 						<span>April 25, 2011</span>
						 					</td>
						 					<td>
						 						<span class="status">Inactive</span>
						 					</td>
						 					<td>
						 						<ul class="action_job">
						 							<li><span>View Job</span><a href="#" title=""><i class="la la-eye"></i></a></li>
						 							<li><span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a></li>
						 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
						 						</ul>
						 					</td>
						 				</tr>
						 				<tr>
						 					<td>
						 						<div class="table-list-title">
						 							<h3><a href="#" title="">Web Designer / Developer</a></h3>
						 							<span><i class="la la-map-marker"></i>Sacramento, California</span>
						 						</div>
						 					</td>
						 					<td>
						 						<span class="applied-field">3+ Applied</span>
						 					</td>
						 					<td>
						 						<span>October 27, 2017</span><br />
						 						<span>April 25, 2011</span>
						 					</td>
						 					<td>
						 						<span class="status active">Active</span>
						 					</td>
						 					<td>
						 						<ul class="action_job">
						 							<li><span>View Job</span><a href="#" title=""><i class="la la-eye"></i></a></li>
						 							<li><span>Edit</span><a href="#" title=""><i class="la la-pencil"></i></a></li>
						 							<li><span>Delete</span><a href="#" title=""><i class="la la-trash-o"></i></a></li>
						 						</ul>
						 					</td>
						 				</tr>

						 			</tbody>
						 		</table>
					 		</div>
					 	</div>
					</div>
				 </div>
			</div>
		</div>
	</section>	
	
@stop	

