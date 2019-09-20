@extends('template.include.master')
@include('template.include.agent_header')
@include('template.include.agent_footer')
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
				 						<a href="#" title=""><i class="la la-file-text"></i>Company Profile</a>
				 						<ul>
				 							<li><a href="#" title="">My Profile</a></li>
				 							<li><a href="#" title="">Social Network</a></li>
				 							<li><a href="#" title="">Contact Information</a></li>
				 						</ul>
				 					</li>
				 					<li class="inner-child">
				 						<a href="#" title=""><i class="la la-briefcase"></i>Manage Jobs</a>
				 						<ul>
				 							<li><a href="#" title="">My Profile</a></li>
				 							<li><a href="#" title="">Social Network</a></li>
				 							<li><a href="#" title="">Contact Information</a></li>
				 						</ul>
				 					</li>
				 					<li class="inner-child">
				 						<a href="#" title=""><i class="la la-money"></i>Transactions</a>
				 						<ul>
				 							<li><a href="#" title="">My Profile</a></li>
				 							<li><a href="#" title="">Social Network</a></li>
				 							<li><a href="#" title="">Contact Information</a></li>
				 						</ul>
				 					</li>
				 					<li class="inner-child">
				 						<a href="#" title=""><i class="la la-paper-plane"></i>Resumes</a>
				 						<ul>
				 							<li><a href="#" title="">My Profile</a></li>
				 							<li><a href="#" title="">Social Network</a></li>
				 							<li><a href="#" title="">Contact Information</a></li>
				 						</ul>
				 					</li>
				 					<li class="inner-child">
				 						<a href="#" title=""><i class="la la-user"></i>Packages</a>
				 						<ul>
				 							<li><a href="#" title="">My Profile</a></li>
				 							<li><a href="#" title="">Social Network</a></li>
				 							<li><a href="#" title="">Contact Information</a></li>
				 						</ul>
				 					</li>
				 					<li class="inner-child">
				 						<a href="#" title=""><i class="la la-file-text"></i>Post a New Job</a>
				 						<ul>
				 							<li><a href="#" title="">My Profile</a></li>
				 							<li><a href="#" title="">Social Network</a></li>
				 							<li><a href="#" title="">Contact Information</a></li>
				 						</ul>
				 					</li>
				 					<li class="inner-child">
				 						<a href="#" title=""><i class="la la-flash"></i>Job Alerts</a>
				 						<ul>
				 							<li><a href="#" title="">My Profile</a></li>
				 							<li><a href="#" title="">Social Network</a></li>
				 							<li><a href="#" title="">Contact Information</a></li>
				 						</ul>
				 					</li>
				 					<li class="inner-child"> 
				 						<a href="#" title=""><i class="la la-lock"></i>Change Password</a>
				 						<ul>
				 							<li><a href="#" title="">My Profile</a></li>
				 							<li><a href="#" title="">Social Network</a></li>
				 							<li><a href="#" title="">Contact Information</a></li>
				 						</ul>
				 					</li>
				 					<li><a href="#" title=""><i class="la la-unlink"></i>Logout</a></li>
				 				</ul>
				 			</div>
				 		</div>
				 	</aside>
				 	<div class="col-lg-9 column">
				 		<div class="padding-left">
					 		<div class="manage-jobs-sec">
					 			<h3>Agent Dashboard</h3>					 			
					 			<div class="extra-job-info">
						 			<span><i class="la la-clock-o"></i><strong>{{$invite_sent}}</strong> Invite Sent</span>
						 			<span><i class="la la-file-text"></i><strong>{{$invite_accepted}}</strong> Invite Accepted</span>
						 			<span><i class="la la-users"></i><strong>{{$invite_registered}}</strong> Registered</span>
						 		</div>
						 		<h3>Recent Referral Uploads to JobKonner</h3>	
						 		<table>
			                        <thead>
			                        	<tr>
			                        		<td>Title/File Name</td>
						 					<td>Applications</td>
						 					<td>Created date</td>
						 					<td>Status</td>
						 					<td>Action</td>
			                        	</tr>			                          
			                        </thead>
			                        <tbody>
			                        @foreach ($agent_referal as $detail)
			                          	<tr>
						 					<td>
						 						<div class="table-list-title">
						 							<h3><a href="#" title="">{{$detail->document_name}}</a></h3>
						 						</div>
						 					</td>
						 					<td>
						 						<span class="applied-field">{{$detail->applicant_count}} Refered</span>
						 					</td>
						 					<td>
						 						<span>{{date_format(date_create($detail->created_at),"F j, Y")}}</span>						 						
						 					</td>
						 					<td>
						 						<span class="status active">Invite Sent</span>
						 					</td>
						 					<td>
						 						<ul class="action_job">
						 							<li><span>View File</span><a href="{{route('viewuploads',[$detail->agent_referral_id, $detail->document_name])}}" title=""><i class="la la-eye"></i></a></li>
						 						</ul>
						 					</td>
						 				</tr>
			                        @endforeach					                        
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

