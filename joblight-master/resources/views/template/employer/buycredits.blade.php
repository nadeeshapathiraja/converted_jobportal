@extends('template.include.master')
@include('template.include.employer_header')
@include('template.include.employer_footer')
@section('main')
	<form method="POST" id="my_form_50" action="{{Route('confirmcredits', ['credits'=> 50, 'pack_name' => 'Basic Pack'])}}" accept-charset="UTF-8">
        {{ csrf_field() }}
    </form>
    <form method="POST" id="my_form_100" action="{{Route('confirmcredits', ['credits'=> 100, 'pack_name' => 'Premium Pack'])}}" accept-charset="UTF-8">
        {{ csrf_field() }}
    </form>
    <form method="POST" id="my_form_300" action="{{Route('confirmcredits', ['credits'=> 300, 'pack_name' => 'VIP Pack'] )}}" accept-charset="UTF-8">
        {{ csrf_field() }}
    </form>                        						
	<section>
		<div class="block no-padding">
			<div class="container">
				 <div class="row no-gape">
				 	@include('template.employer._aside')
				 	<div class="col-lg-9 column">
				 		<div class="padding-left">
					 		<div class="manage-jobs-sec">
					 			<h3>Buy Credits to Download Resumes</h3>
						 		<div class="cat-sec">
									<div class="row no-gape">
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="p-category view-resume-list">
												<a href="javascript:{}" onclick="document.getElementById('my_form_50').submit(); return false;"  title="">
													<i class="la la-tag"></i>
													<span>Basic Pack</span>
													<p>50 Credits</p>
												</a>
												</form>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="p-category">
												<a href="javascript:{}" onclick="document.getElementById('my_form_100').submit(); return false;"   title="">
													<i class="la la-tags"></i>
													<span>Premium Pack</span>
													<p>100 Credits</p>
												</a>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div class="p-category">
												<a href="javascript:{}" onclick="document.getElementById('my_form_300').submit(); return false;" title="">
													<i class="la la-archive"></i>
													<span>VIP Pack</span>
													<p>300 Credits</p>
												</a>
											</div>
										</div>
									</div>
								</div>	

								<h3>Purchase History</h3>
						 		<table>
						 			<thead>
						 				<tr>
						 					<td>Transaction ID</td>
						 					<td>Pack Name</td>
						 					<td>Credits</td>
						 					<td>Purchase Date</td>						 					
						 					<td>Status</td>
						 				</tr>
						 			</thead>
						 			<tbody>
						 				@foreach($trans_history as $history)
						 					<tr>
							 					<td>
							 						<div class="table-list-title">
							 							<h3><a href="#" title="">{{$history->transaction_no}}</a></h3>
							 						</div>
							 					</td>
							 					<td>
							 						<span class="applied-field">{{$history->pack_name}}</span>
							 					</td>
							 					<td>
							 						<span class="">{{$history->credits}}</span>
							 					</td>
							 					<td>
							 						<span>{{date_format(date_create($history->created_at),"F j, Y")}} </span>						 						
							 					</td>						 					
							 					<td>
							 						<span class="status">{{$history->status}}</span>
							 					</td>
							 				</tr>
						 				@endforeach						 				
						 			</tbody>
						 		</table>							 							
						 		{!! $trans_history->render() !!}
					 		</div>					 		
					 	</div>
					</div>				 	
				 </div>
			</div>
		</div>
	</section>	
	
@stop	

