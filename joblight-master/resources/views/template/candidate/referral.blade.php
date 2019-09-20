@extends('template.include.master')
@if(Session::get('user.login_type') == 'agent')
	@include('template.include.agent_header')
	@include('template.include.agent_footer')
@else
	@include('template.include.candidate_header')
	@include('template.include.candidate_footer')
@endif
@section('main')

	<section>
		<div class="block no-padding">
			<div class="container">
				 <div class="row no-gape">
				 	@include('template.candidate._aside')
				 	<div class="col-lg-9 column">
				 		<div class="padding-left">
					 		<div class="contact-edit">
					 			<h3>{{ $title }}</h3>					 			
						            {!! Form::open(['route' => 'sendinvite', 'method' => 'post', 'id'=>'form']) !!}     
						            {!! Form::hidden('jobpost_id',$id) !!}
						            {!! Form::hidden('mode',$mode) !!}						        	
						        	<div class="col-lg-12">
						        		<span for="message" class="pf-title">Enter email address {{$sub_title}}</span>
							        	<div class="pf-field">
					 						<ul class="tags">								           
						            			<li class="tagAdd taglist">  
						              				 <input type="text" id="search-field">
									            </li>								            
											</ul>											
										</div>
									</div>
									@if(Session::get('user.login_type') == 'agent')
					                <div class="10u 12u(medium)" align="right" style="padding-top:10px;">
					                    {!! Form::file('importExcel', ['id' => 'importExcel']); !!}
					                    <a onclick="javascript:triggerfileinput();" title="">Browse</a>
					                    {!! Form::submit( 'Load form excel', ['class' => 'button alt icon fa-upload btn-primary', 'id' => 'btn-read-excel'] ) !!}
					                </div>
					                @endif
									<div class="col-lg-12">
										<span for="message" class="pf-title">Optional Message</span>
										<div class="pf-field">								
												<textarea name="message" id="message"  rows="5" cols="50" class="form-control" placeholder="Write a custom Message to your referrals" maxlength="3000"></textarea>
										</div>
									</div>
									<div align="center" class="col-lg-12">							    		
							    		<button class="btnsave" type="submit"><i class="la la-paper-plane"></i>{{$caption}}</button>
							    	</div>						        	 
						            {!! Form::close() !!}						            
					 			
					 			@if($mode=='applicant')
						 			@if(Session::get('user.login_type') == 'agent')
						 			<div class="manage-jobs-sec">					 			
								 		<h3>Past Uploads to JobKonner</h3>
								 		<table>
					                        <thead>
					                        	<tr>
					                        		<td>Date</td>
							                        <td>File Name</td>
							                        <td>Applicant Count</td>
							                        <td>Action</td>
					                        	</tr>			                          
					                        </thead>
					                        <tbody>
					                        @foreach ($agent_referal as $detail)
					                          <tr>
					                          	<td>
					                            	<div class="table-list-title">
							 							<h3><a href="#" title="">{{date_format(date_create($detail->created_at),"F j, Y")}} </a></h3>
							 						</div>
					                            </td>
					                            
					                            <td><span class="status active">{{$detail->document_name}}</span></td>
					                            <td><span>{{$detail->applicant_count}}</span></td>
					                            <td>
							 						<ul class="action_job">
							 							<li><span>View File</span><a href="{{route('viewuploads',[$detail->agent_referral_id, $detail->document_name])}}" title=""><i class="la la-eye"></i></a></li>
							 						</ul>
							 					</td>
					                          </tr>  
					                        @endforeach					                        
					                    	</tbody>			                    	
					                      </table>	
					                      
					                      <div style="float:right">{!! $agent_referal->render() !!}</div>
							 		</div>
						 			@else					 			
						 			<div class="manage-jobs-sec">					 			
								 		<h3>Recent Referals</h3>
								 		<table>
					                        <thead>
					                        	<tr>
					                        		<td>Invited Candidate</td>
							                        <td>Invite Status</td>
							                        <td>Resume Downloaded</td>
					                        	</tr>			                          
					                        </thead>
					                        <tbody>
					                        @foreach ($refered_data as $detail)
					                          <tr>
					                            <td>
					                            	<div class="table-list-title">
							 							<h3><a href="#" title="">{{$detail->referral_email}} </a></h3>
							 						</div>
					                            </td>
					                            <td>{!! ($detail->referral_status == 'completed')? '<span class="status active">Joined 

					                            JobKonner</span>' : '<span class="status">'.ucwords($detail->referral_status).'</span>' !!}</td>
					                            <td><span>{{$detail->resume_downloads}}</span></td>
					                          </tr>  
					                        @endforeach
					                    	</tbody>			                    	
					                      </table>	
					                      
					                      <div style="float:right">{!! $refered_data->render() !!}</div>
							 		</div>
							 		@endif
						 		@endif	
					 		</div>					 		
					 	</div>
					</div>
				 </div>
			</div>
		</div>
	</section>

	
@stop
	
@section('scripts')
{!! HTML::script('new/js/tag.js') !!}
<script>	
	$(".btnsave").on( "click", function(e) {  
		console.log('sun');
		e.preventDefault();  	
		//validation id email is entered	
		$(this).closest('form')[0].submit();		
	});
	function triggerfileinput(){
		$('#importExcel').trigger('click');
	}

	$('#btn-read-excel').on('click', function(e) {
	    e.preventDefault();
	    var file_data = $('#importExcel').prop('files')[0];   
	    if(file_data){
	        var form_data = new FormData();                  
	        form_data.append('file', file_data);                            
	        $.ajax({
	                    url: '<?php echo route("import.excel") ?>',
	                    dataType: 'text',  // what to expect back from the PHP script, if anything
	                    cache: false,
	                    contentType: false,
	                    processData: false,
	                    data: form_data,                         
	                    type: 'post',
	                    success: function(php_script_response){        
	                    	php_script_response = JSON.parse(php_script_response);
	                    	for (var i = 0; i < php_script_response.length; i++) {	                    		
	                    		$('<li class="addedTag">' + php_script_response[i].email_list + '<span class="tagRemove" onclick="$(this).parent().remove();">x</span><input type="hidden" value="' + php_script_response[i].email_list + '" name="tags[]"></li>').insertBefore('.tags .tagAdd');
	                    	}	                        
	                    }
	         });
	    }
	});
</script>
@stop	
