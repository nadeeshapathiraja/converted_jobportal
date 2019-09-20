@extends('include.template')


@section('main')
<div class="brand"></div>
	<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">					
	<div class="col-lg-10">	
		<ul class="nav nav-tabs">
		    <li class="active" id="tab_contact_nav"><a class="editnavbar" data-toggle="tab" href="#tab_contact" form="form-save-contact">{{ trans('front/candidate.tab_1') }}</a></li>
		    <li id="tab_work_nav"><a class="editnavbar" data-toggle="tab" href="#tab_work" form="form-save-work">{{ trans('front/candidate.tab_2') }}</a></li>
		    <li id="tab_school_nav"><a class="editnavbar" data-toggle="tab" href="#tab_school" form="form-save-school">{{ trans('front/candidate.tab_3') }}</a></li>
		    <li id="tab_addskill_nav"><a class="editnavbar" data-toggle="tab" href="#tab_addskill" form="form-save-skill">{{ trans('front/candidate.tab_4') }}</a></li>
		    <li id="tab_addpreference_nav"><a class="editnavbar" data-toggle="tab" href="#tab_addpreference" form="form-save-preference">{{ trans('front/candidate.tab_5') }}</a></li>
	  	</ul>

		<div class="box">
		<div class="tab-content form-group form-horizontal">
		    <div id="tab_contact" class="tab-pane fade in active">
			    <form id = 'form-save-contact' method="post" norefresh="1" enctype="multipart/form-data">			    	
			    	<input type="hidden" name="candidate_profile_id" value="<?php echo Session::get('user.candidateprofileid'); ?>">
			    	<input type="hidden" name="formtype" value="contact">
			      	<h3>{{ trans('front/candidate.title_1') }}</h3>
			      	<div class="row">	
				      	<div class="col-sm-8">		      								
							<p>{{ trans('front/candidate.text') }}</p>																		
							<div class="form-group">
								<label for="firstname" class="col-sm-3">{{trans('front/candidate.lbl_firstname')}}<sup>*</sup></label>
								<div class="col-sm-9">
									<input type="text" name="firstname" id="firstname" class="form-control" data-rule-required="true" required maxlength="20">								
								</div>
							</div>
							<div class="form-group">
								<label for="lastname" class="col-sm-3">{{trans('front/candidate.lbl_lastname')}}</label>
								<div class="col-sm-9">
									<input type="text" name="lastname" id="lastname" class="form-control" data-rule-required="true">								
								</div>
							</div>						
							<div class="form-group">
								<label for="gender" class="col-sm-3">{{trans('front/candidate.lbl_gender')}}</label>
								<div class="col-sm-9">									
									<div class="radio" style="padding-top: 0px !important">
						                <label class='radio-inline' style="padding-top: 0px !important"><input type="radio" name="gender" id="gender" value="M">{{trans('front/candidate.ddl_option_boy')}}  </label>

						                <label  class='radio-inline' style="padding-top: 0px !important"><input type="radio" name="gender" id="gender" value="F">{{trans('front/candidate.ddl_option_girl')}}</label>
						                
						            </div>								
								</div>
							</div>
							
							<div class="form-group">
								<label for="race" class="col-sm-3">{{trans('front/candidate.lbl_race')}}</label>
								<div class="col-sm-9">
									{!! Form::select('race', $race, null, ['id' => 'race','class' => 'form-control']) !!}
								</div>
							</div>	

							<div class="form-group">
								<label for="date_of_birth" class="col-sm-3">{{trans('front/candidate.lbl_dob')}}</label>
								<div class="col-sm-9">
									<input type="date" name="date_of_birth" id="date_of_birth" class="form-control" max="9999-12-1" data-rule-required="true">	
								</div>
							</div>		
							<div class="form-group">
								<label for="mobile" class="col-sm-3">{{trans('front/candidate.lbl_phone')}}</label>
								<div class="col-sm-9">
									<input type="text" name="mobile" id="mobile" class="form-control" data-rule-required="true" required>								
								</div>
							</div>							
							<!-- <div class="form-group">
								<label for="country" class="col-sm-3">{{trans('front/candidate.lbl_country')}}</label>
								<div class="col-sm-9">
									{!! Form::select('country', $country, $userprofile->country, ['id'=>'country', 'class' => 'form-control']) !!}						
								</div>
							</div>
							<div class="form-group">
								<label for="zipcode" class="col-sm-3">{{trans('front/candidate.lbl_zipcode')}}</label>
								<div class="col-sm-9">
									<input type="text" name="zipcode" id="zipcode" class="form-control" data-rule-required="true">								
								</div>
							</div>
							<div class="form-group">
								<label for="city" class="col-sm-3">{{trans('front/candidate.lbl_city')}}</label>
								<div class="col-sm-9">
									<input type="text" name="city" id="city" class="form-control" data-rule-required="true">								
								</div>
							</div>
							<div class="form-group">
								<label for="state" class="col-sm-3">{{trans('front/candidate.lbl_state')}}</label>
								<div class="col-sm-9">
									<input type="text" name="state" id="state" class="form-control" data-rule-required="true">								
								</div>
							</div>
							<div class="form-group">
								<label for="address1" class="col-sm-3">{{trans('front/candidate.lbl_address1')}}</label>
								<div class="col-sm-9">
									<input type="text" name="address1" id="address1" class="form-control" data-rule-required="true">								
								</div>
							</div>
							<div class="form-group">
								<label for="address2" class="col-sm-3">{{trans('front/candidate.lbl_address2')}}</label>
								<div class="col-sm-9">
									<input type="text" name="address2" id="address2" class="form-control" data-rule-required="true">								
								</div>
							</div> -->						
						</div>		
						<div class="col-sm-4">		
							<div class="form-group">
								<div class="fileinput fileinput-new" data-provides="fileinput" align="center">
								<input type= "hidden" id="public_path" value="{{URL::asset('img/preview.jpg')}}">
								<div id="image_preview"><img id="product_img_preview" src="{{URL::asset('img/preview.jpg')}}" onerror='this.src= "{{URL::asset('img/preview.jpg')}}";$("#image_uploaded").val("NO"); '/></div>
									<hr id="line">
									<div>
										<span class="btn btn-success btn-file">
										<span class="fileinput-new">Choose Profile Photo</span>
										<input id="product_image" type="file" name="product_image" class="form-control">
										</span>
										<input type='button' id="product_image_remove" class="btn btn-danger fileinput-exists" data-dismiss="fileinput" value="Remove Photo"/>
										<input type="hidden" id= "image_uploaded" name="image_uploaded" value="NO">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div id="message" align="center"></div>
							</div>
						</div>	 
					</div>
					<div class="row">	
						<div class="col-lg-10">
						@include('element.address') 	
						</div>
					</div>
					<div align="center" class="form-group">
				    	<button class="btntabsave btn btn-primary" action="{{URL::to('/candidate/ajaxsave/')}}" >Save</button>
				    	<button class="btntabsave btnnexttab btn btn-primary" navigate='#tab_work' action="{{URL::to('/candidate/ajaxsave/')}}" >Save and continue</button>
				    </div>
				</form>  					
		    </div>
		    <div id="tab_work" class="tab-pane fade">
			    <form id = 'form-save-work' method="post" norefresh="1" enctype="multipart/form-data">
			      <input type="hidden" name="formtype" value="work">
			      <input type="hidden" name="candidate_workexp_id" id="candidate_workexp_id" value="">
			      <h3>{{ trans('front/candidate.title_2') }}</h3>	
			      <div class="col-lg-12">		      
			      	<p>{{ trans('front/candidate.text') }}</p>	
			      		{!! Form::open(['url' => 'candidate', 'method' => 'post', 'role' => 'form']) !!}	
			      		<div class="form-group">
			      			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#workModal" data-backdrop="static" onclick="javascript:loadempdata();">Add work experience</button>	      		
			      		</div> 
		      			<?php 	
					    //var_dump($workexp);					    	
				  		foreach ($workexp as $k => $value) {   ?>  
				  		<div class="well" id="empdata{{$k}}">           
				            <div class="edit_hover_class">
				            <h5> {{$value->employername}}  ({{$value->city}}, {{$value->country}}) 
				            	<a onclick="javascript:deletedata('{{$value->candidate_workexp_id}}', 'WORK', '{{URL::to('/candidate/ajaxremove/')}}', 'empdata{{$k}}');"> <span class="glyphicon glyphicon-trash"></span></a> 					            	
				            	<a id='loadempdata{{$k}}' data-toggle="modal" data-target="#workModal" data-backdrop="static" onclick="javascript:loadempdata('{{$k}}');"> <span class="glyphicon glyphicon-pencil"></span> </a> 
				            	<span style="float:right;">{{ date('F,Y', strtotime($value->start_date))}} - {{ ($value->still_working =='N')? date('F,Y', strtotime($value->end_date)) : 'Present' }}</span>
				            </h5> 
				            </div>
				            <p>{{$value->position}}</p>
					      <?php   
					  		foreach ($value->additionalskills as $key => $val) { ?>
						        <ul>
						          <li>{{$val->content}}</li>
						        </ul>					  					
					      <?php } ?>
					  	</div>
					  	<?php }	?> 
					  	<!-- Modal -->
						<div id="workModal" class="modal fade" role="dialog" >
						  <div class="modal-dialog modal-lg">
						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="btntabcancel close" data-dismiss="modal">&times;</button>
						        <h4 class="modal-title">Work Experience</h4>
						      </div>
						      <div class="modal-body">														
							    <div class="panel panel-default">
							      <div class="panel-heading">{{ trans('front/candidate.tab2_sec1_title') }}</div>
							      <div class="panel-body">
							      	<div class="form-group">
										<label for="employername" class="col-sm-3">{{trans('front/candidate.lbl_tab2_sec1_empname')}}</label>
										<div class="col-sm-9">
											<input type="text" name="employername" id="employername" class="form-control" data-rule-required="true">								
										</div>
									</div>
									<div class="form-group">
										<label for="industry" class="col-sm-3">{{trans('front/candidate.lbl_tab2_sec1_industry')}}</label>
										<div class="col-sm-9">											
											{!! Form::select('industry', $industry, null, ['class' => 'form-control', 'id' => 'industry']) !!}
										</div>
									</div>
									<div class="form-group">
										<label for="city" class="col-sm-3">{{trans('front/candidate.lbl_city')}}</label>
										<div class="col-sm-9">
											<input type="text" name="city" id="city" class="form-control" data-rule-required="true">								
										</div>
									</div>
									<div class="form-group">
										<label for="state" class="col-sm-3">{{trans('front/candidate.lbl_state')}}</label>
										<div class="col-sm-9">
											<input type="text" name="state" id="state" class="form-control" data-rule-required="true">								
										</div>
									</div>
									<div class="form-group">
										<label for="country" class="col-sm-3">{{trans('front/candidate.lbl_country')}}</label>
										<div class="col-sm-9">
											<input type="text" name="country" id="country" class="form-control" data-rule-required="true">								
										</div>
									</div>									
							      </div>
							    </div>
							    <div class="panel panel-default">
							      <div class="panel-heading">{{ trans('front/candidate.tab2_sec2_title') }}</div>
							      <div class="panel-body">
							      	<div class="form-group">
										<label for="position" class="col-sm-3">{{trans('front/candidate.lbl_tab2_sec2_positiontitle')}}</label>
										<div class="col-sm-9">
											<input type="text" name="position" id="position" class="form-control" data-rule-required="true">								
										</div>
									</div>
									<div class="form-group">
										<label for="start_date" class="col-sm-3">{{trans('front/candidate.lbl_tab2_sec2_startdate')}}</label>
										<div class="col-sm-9">
											<input type="month" name="start_date" id="start_date" class="form-control" max="9999-12" data-rule-required="true">	
										</div>
									</div>
									<div class="form-group">
										<label for="still_working" class="col-sm-3">{{trans('front/candidate.lbl_tab2_sec2_stillworking')}}</label>
										<div class="col-sm-9">									
											<div class="radio" style="padding-top: 0px !important">
								                <label class='radio-inline' style="padding-top: 0px !important"><input type="radio" name="still_working" id="still_working" value="Y">{{trans('front/candidate.ddl_option_yes')}}  </label>

								                <label  class='radio-inline' style="padding-top: 0px !important"><input type="radio" name="still_working" id="still_working" value="N">{{trans('front/candidate.ddl_option_no')}}</label>
								                
								            </div>								
										</div>
									</div>
									<div class="form-group" id="div_enddate">
										<label for="end_date" class="col-sm-3">{{trans('front/candidate.lbl_tab2_sec2_enddate')}}</label>
										<div class="col-sm-9">
											<input type="month" name="end_date" id="end_date" class="form-control" max="9999-12" data-rule-required="true">								
										</div>
									</div>
									<div class="form-group">
										<label for="salary" class="col-sm-3">{{trans('front/candidate.lbl_tab2_sec2_salary')}}</label>
										<div class="col-sm-9">
											<input type="number" name="salary" id="salary" class="form-control" data-rule-required="true">								
										</div>
									</div>
							      </div>
							    </div>
							    <div class="panel panel-default">
							      <div class="panel-heading">{{ trans('front/candidate.tab2_sec3_title') }}</div>
							      <div class="panel-body">
							      	<div class="form-group">								
										<p>{{ trans('front/candidate.lbl_tab2_sec3_part1') }}</p>
									</div>
									<div class="form-group">								
										<div class="col-sm-10">
											<input type="text" name="jobkeyword" id="jobkeyword" class="form-control" data-rule-required="true" placeholder="{{ trans('front/candidate.ph_jobsearch') }}">
										</div>
										<div class="col-sm-2">
											<button id = 'btn_jobsearch' class="btn btn-primary">{{ trans('front/candidate.btn_search') }}</button>
										</div>
									</div>							  
									<div class="form-group">								
										<p>{{ trans('front/candidate.lbl_tab2_sec3_part2') }}</p>
										<div class="col-sm-12">								
										<small>{{ trans('front/candidate.lbl_add_to_list_subtitle') }}</small>
										</div>
										<div class="col-sm-12">																
											<textarea name="responsibilities" id="responsibilities"  rows="5" cols="50" class="form-control" placeholder="{{ trans('front/candidate.ph_responsibilities') }}" maxlength="3000"></textarea>
											<br>
											<button id = 'btn_responsibilities' class='btn_addtolist' text-element='responsibilities' list-element='responsibilitylist' warning-element='noresponsibilityset' class="btn btn-primary">{{ trans('front/candidate.btn_savencon') }}</button>
										</div>								
									</div>	
									<div class="form-group">								
										<p>{{ trans('front/candidate.lbl_tab2_sec3_part3') }}</p>
										<div class="col-sm-12" id="noresponsibilityset">
											<label class="label label-warning" >{{trans('front/candidate.lbl_tab2_sec3_part3_warning')}}</label>
										</div>
										<div class="col-sm-12">
											<ul id="responsibilitylist" class="sortable"></ul>
					                  	</div>
									</div>					  
							      </div>
							    </div>								
						      </div>
						      <div class="modal-footer">
						      	<button class="btntabsave btn btn-primary" action="{{URL::to('/candidate/ajaxsave/')}}" >Save</button>
						        <button type="button" class="btntabcancel btn btn-default" data-dismiss="modal">Close</button>
						      </div>
						    </div>
						  </div>
						</div>								
						{!! Form::close() !!}
					</div>				      
			    </form> 			    
		    </div>
		    <div id="tab_school" class="tab-pane fade">
			    <form id = 'form-save-school' method="post" norefresh="1" enctype="multipart/form-data">
			      <input type="hidden" name="formtype" value="school">
			      <input type="hidden" name="candidate_educ_id" id="candidate_educ_id" value="">
			      <h3>{{ trans('front/candidate.title_3') }}</h3>
			      <div class="col-lg-12">
			      	<p>{{ trans('front/candidate.text') }}</p>	
			      		{!! Form::open(['url' => 'candidate', 'method' => 'post', 'role' => 'form']) !!}
			      		<div class="form-group">
			      			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#educationModal" data-backdrop="static" onclick="javascript:loadeducationdata();">Add education</button>	      		
			      		</div> 
			      		<?php  
					    //var_dump($education);
					      foreach ($education as $k => $value) {   ?> 
					      	<div class="well" id='educationdata{{$k}}'>                             
					            <div class="edit_hover_class">
					            <h5> {{$value->school_name}}  ({{$value->city}}, {{$value->country}}) 
					            	<a onclick="javascript:deletedata('{{$value->candidate_educ_id}}', 'SCHOOL', '{{URL::to('/candidate/ajaxremove/')}}', 'educationdata{{$k}}');"> <span class="glyphicon glyphicon-trash"></span></a> 
					            	<a id='loadeducationdata{{$k}}' data-toggle="modal" data-target="#educationModal" data-backdrop="static" onclick="javascript:loadeducationdata('{{$k}}');"> <span class="glyphicon glyphicon-pencil"></span> </a>
					            	<span style="float:right;">{{ date('F,Y', strtotime($value->enrolldate))}} - {{ ($value->still_studying =='N')? date('F,Y', strtotime($value->grad_date)) : 'Yet to Graduted' }}</span>
					            </h5> 
					            </div>
					            <p>{{ (isset($degree[$value->degree]) && $value->degree != '' )? $degree[$value->degree] : ''}}</p>
					      <?php   
					        foreach ($value->additionalskills as $key => $val) { ?>
					        <ul>
					          <li>{{$val->content}}</li>
					        </ul>					            
					      <?php } ?>
					  	</div>
					  	<?php }	?> 
					  	<!-- Modal -->
						<div id="educationModal" class="modal fade" role="dialog" >
						  <div class="modal-dialog modal-lg">
						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="btntabcancel close" data-dismiss="modal">&times;</button>
						        <h4 class="modal-title">Educational Qualification</h4>
						      </div>
						      <div class="modal-body">					      		
				      			<div class="panel panel-default">
				      				<div class="panel-heading">{{ trans('front/candidate.tab3_sec1_title') }}</div>
				      				<div class="panel-body">
				      					<div class="form-group">
											<label for="school_type" class="col-sm-3">{{trans('front/candidate.lbl_schooltype')}}</label>
											<div class="col-sm-9">										
												<div class="radio" style="padding-top: 0px !important">
									                <label class='radio-inline' style="padding-top: 0px !important"><input type="radio" name="school_type" id="school_type" value="HIGHSCHOOL">{{trans('front/candidate.rb_schooltype_opt1')}}  </label>

									                <label  class='radio-inline' style="padding-top: 0px !important"><input type="radio" name="school_type" id="school_type" value="COLLEGE">{{trans('front/candidate.rb_schooltype_opt2')}}</label>

									                <label  class='radio-inline' style="padding-top: 0px !important"><input type="radio" name="school_type" id="school_type" value="OTHER">{{trans('front/candidate.rb_schooltype_opt3')}}</label>
									            </div>							
											</div>
										</div>
										<div class="form-group">
											<label for="school_name" class="col-sm-3">{{trans('front/candidate.lbl_schooname')}}</label>
											<div class="col-sm-9">
												<input type="text" name="school_name" id="school_name" class="form-control" data-rule-required="true" placeholder="{{trans('front/candidate.ph_name')}}">								
											</div>
										</div>
										<div id="div_degree">
											<div class="form-group">
												<label for="degree" class="col-sm-3">{{trans('front/candidate.lbl_degree')}}</label>
												<div class="col-sm-9">													
													{!! Form::select('degree', $degree, null, ['id' => 'degree','class' => 'form-control']) !!}
												</div>
											</div>
											<div class="form-group">
												<label for="field_of_study" class="col-sm-3">{{trans('front/candidate.lbl_fieldofstudy')}}</label>
												<div class="col-sm-9">
													{!! Form::select('field_of_study', $study_field, null, ['id' => 'field_of_study','class' => 'form-control']) !!}
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="city" class="col-sm-3">{{trans('front/candidate.lbl_city')}}</label>
											<div class="col-sm-9">
												<input type="text" name="city" id="city" class="form-control" data-rule-required="true" placeholder="{{trans('front/candidate.ph_city')}}">								
											</div>
										</div>
										<div class="form-group">
											<label for="state" class="col-sm-3">{{trans('front/candidate.lbl_state')}}</label>
											<div class="col-sm-9">
												<input type="text" name="state" id="state" class="form-control" data-rule-required="true">								
											</div>
										</div>
										<div class="form-group">
											<label for="country" class="col-sm-3">{{trans('front/candidate.lbl_country')}}</label>
											<div class="col-sm-9">
												<input type="text" name="country" id="country" class="form-control" data-rule-required="true">								
											</div>
										</div>										
										<div class="form-group">
											<label for="enrolldate" class="col-sm-3">{{trans('front/candidate.lbl_enrolleddate')}}</label>
											<div class="col-sm-9">
												<input type="month" name="enrolldate" id="enrolldate" class="form-control" max="9999-12" data-rule-required="true">	
											</div>
										</div>
										<div class="form-group">
											<label for="still_studying" class="col-sm-3">{{trans('front/candidate.lbl_stillschool')}}</label>
											<div class="col-sm-3">										
												<select name="still_studying" id="still_studying" class='form-control'>
													<option value="">{{trans('front/candidate.ddl_option_na')}}</option>
													<option value="Y">{{trans('front/candidate.ddl_option_yes')}}</option>
													<option value="N">{{trans('front/candidate.ddl_option_no')}}</option>
												</select>							
											</div>
										</div>
										<div class="form-group" id="div_expgraddate">
											<label for="exp_graddate" class="col-sm-3">{{trans('front/candidate.lbl_expgraddate')}}</label>
											<div class="col-sm-9">
												<input type="month" name="exp_graddate" id="exp_graddate" class="form-control" max="9999-12" data-rule-required="true">	
											</div>
										</div>
										<div class="form-group" id="div_isgraduated">
											<label for="is_graduated" class="col-sm-3">{{trans('front/candidate.lbl_isgraduated')}}</label>
											<div class="col-sm-3">										
												<select name="is_graduated" id="is_graduated" class='form-control'>
													<option value=""></option>
													<option value="Y">{{trans('front/candidate.ddl_option_yes')}}</option>
													<option value="N">{{trans('front/candidate.ddl_option_no')}}</option>
												</select>							
											</div>
										</div>
										<div class="form-group" id="div_graddate">
											<label for="grad_date" class="col-sm-3">{{trans('front/candidate.lbl_graddate')}}</label>
											<div class="col-sm-9">
												<input type="month" name="grad_date" id="grad_date" class="form-control" max="9999-12" data-rule-required="true">	
											</div>
										</div>
										<div class="form-group" id="div_lastenrollyear">
											<label for="lastenrollyear" class="col-sm-3">{{trans('front/candidate.lbl_lastenrollyear')}}</label>
											<div class="col-sm-9">
												<input type="month" name="lastenrollyear" id="lastenrollyear" class="form-control" max="9999-12" data-rule-required="true">	
											</div>
										</div>
				      				</div>
				      			</div>
				      			<div class="panel panel-default">
				      				<div class="panel-heading">{{ trans('front/candidate.tab3_sec2_title') }}</div>
				      				<div class="panel-body">
					      				<div class="form-group">								
											<p>{{ trans('front/candidate.lbl_tab3_sec2_part1') }}</p>
											<div class="col-sm-12">								
											<small>{{ trans('front/candidate.lbl_add_to_list_subtitle') }}</small>
											</div>
											<div class="col-sm-12">																
												<textarea name="eduinfor" id="eduinfor"  rows="5" cols="50" class="form-control" placeholder="{{ trans('front/candidate.ph_eduinfo') }}" maxlength="3000"></textarea>
												<br>
												<button id = 'btn_eduinfor' class='btn_addtolist' text-element='eduinfor' list-element='educationlist' warning-element='noeducationset' class="btn btn-primary">{{ trans('front/candidate.btn_savencon') }}</button>
											</div>								
										</div>	
										<div class="form-group">								
											<p>{{ trans('front/candidate.lbl_tab3_sec2_part2') }}</p>
											<div class="col-sm-12" id="noeducationset">
												<label class="label label-warning" >{{trans('front/candidate.lbl_tab3_sec2_part2_warning')}}</label>
											</div>
											<div class="col-sm-12">
												<ul id="educationlist" class="sortable"></ul>
						                  	</div>
										</div>
				      				</div>
				      			</div>
				      			<div class="panel panel-default">
				      				<div class="panel-heading">{{ trans('front/candidate.tab3_sec3_title') }}</div>
				      				<div class="panel-body">
					      				<div class="checkbox">
										  <label><input type="checkbox" id="future_study" name="future_study" value="Y">{{ trans('front/candidate.ck_tab3_sec3_option') }}</label>
										</div>
				      				</div>
				      			</div>
				      		  </div>
				      		 <div class="modal-footer">
						      	<button class="btntabsave btn btn-primary" action="{{URL::to('/candidate/ajaxsave/')}}" >Save</button>
						        <button type="button" class="btntabcancel btn btn-default" data-dismiss="modal">Close</button>
						     </div>
						    </div>
						  </div>
						</div>
						{!! Form::close() !!}
					</div>	
			    </form>		    	
		    </div>
		    <div id="tab_addskill" class="tab-pane fade">			    
			    {!! Form::open(['url' => 'candidate', 'method' => 'post', 'role' => 'form', 'id' => 'form-save-skill', 'norefresh' => '1']) !!}	
			      <input type="hidden" name="formtype" value="skill">
			      <h3>{{ trans('front/candidate.title_4') }}</h3>
			      <div class="col-lg-12">
			      	<p>{{ trans('front/candidate.text') }}</p>				      				      					      		
		      			<div class="form-group">
							<label for="core_skills">{{trans('front/candidate.lbl_tab3_core_skill')}}<sup>*</sup></label>
							<div class="col-sm-12">															
								<!-- <input id="core_skills" name="core_skills" required="required">  -->  
								{!! Form::select('core_skills[]', array(), null, ['id' => 'core_skills', 'class' => 'multiple-core-skill', 'multiple' => 'multiple', 'required']) !!}
							</div>
						</div>
						<div class="form-group">
							<label>Languages Known</label>							
							<a data-toggle="modal" data-target="#languageModal" data-backdrop="static" onclick="javascript:loadlanguagedata();"> <span class="glyphicon glyphicon-edit"></span> </a>
						</div>	
						<?php				        
				          foreach ($languageskill as $key => $val) { ?>
				          <div id="languageskill{{$key}}">
					        <div class="form-group">							
								<div class="col-sm-3">															
									<label>{{$language[$val->language_code]}}</label>                                      
								</div>
								<div class="col-sm-3">															
									<label>Written - {{$lang_skill_level[$val->written_level]}}</label>                                      
								</div>
								<div class="col-sm-3">															
									<label>Spoken - {{$lang_skill_level[$val->spoken_level]}}</label>
								</div>								
								<div class="col-sm-3">		
									<a onclick="javascript:deletedata('{{$val->candidate_lang_id}}', 'LANGUAGE', '{{URL::to('/candidate/ajaxremove/')}}', 'languageskill{{$key}}');"> <span class="glyphicon glyphicon-trash"></span></a>													
									<a data-toggle="modal" data-target="#languageModal" data-backdrop="static" onclick="javascript:loadlanguagedata('{{$key}}');"> <span class="glyphicon glyphicon-pencil"></span> </a>
								</div>
							</div> 	
							<hr>	
							</div>					     
				          <?php      
				            }
				        ?>					
		      			<div class="panel panel-default">
		      				<div class="panel-heading">{{ trans('front/candidate.tab4_sec1_title') }}</div>
		      				<div class="panel-body">
			      				<div class="form-group">								
									<p>{{ trans('front/candidate.lbl_tab4_sec1_part1') }}</p>
									<div class="col-sm-12">								
									<small>{{ trans('front/candidate.lbl_tab4_sec1_part1_subtitle') }}</small>
									</div>
									<div class="col-sm-12">																
										<textarea name="addskills" id="addskills"  rows="5" cols="50" class="form-control" placeholder="{{ trans('front/candidate.ph_addskills') }}" maxlength="3000"></textarea>
										<br>
										<button class='btn_addtolist' text-element='addskills' list-element='skillslist' warning-element='noskillset' class="btn btn-primary">{{ trans('front/candidate.btn_savencon') }}</button>
									</div>								
								</div>	
								<div class="form-group">								
									<p>{{ trans('front/candidate.lbl_add_to_list_subtitle') }}</p>
									<div class="col-sm-12" id="noskillset">
										<?php
										if(!$additionalskill){ ?>
										<label class="label label-warning" >{{trans('front/candidate.lbl_tab4_sec1_part2_warning')}}</label>
										<?php } ?>
									</div>
									<div class="col-sm-12">
										<ul id="skillslist" class="sortable">
										<?php
								        //var_dump($additionalskill); 
								          foreach ($additionalskill as $key => $val) { ?>									              
								            <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
    											<span class="editable" id= "{{$val->skill_id}}" style="margin-left: auto;">{{$val->content}}</span>
									          	<span class="ui-icon ui-icon-pencil edit-icon" onclick="editlist(this)"></span>
									          	<span class="ui-icon ui-icon-closethick delete-icon" onclick="deletelist(this,'skillslist','noskillset')"></span>
									        </li>           
								          <?php      
								            }
								        ?>
								        </ul>		
				                  	</div>
								</div>														
		      				</div>
		      			</div>			      								
			      </div>
			      <div align="center" class="form-group">
			    	<button class="btntabsave btn btn-primary" action="{{URL::to('/candidate/ajaxsave/')}}" >Save</button>
			    	<button class="btntabsave btnnexttab btn btn-primary" navigate='#tab_addpreference' action="{{URL::to('/candidate/ajaxsave/')}}" >Save and continue</button>
			      </div>
			    {!! Form::close() !!}
			    <div id="languageModal" class="modal fade" role="dialog" >
				  <div class="modal-dialog modal-lg">
				  	{!! Form::open(['url' => 'candidate', 'method' => 'post', 'role' => 'form', 'id' => 'form-language-skill', 'norefresh' => '1']) !!}					  	
				  	<div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="btntabcancel close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Add Languages</h4>
				        <input type="hidden" name="formtype" value="language">
				        <input type="hidden" name="candidate_lang_id" id="candidate_lang_id" value="">
				      </div>
				      <div class="modal-body">	
				      	<div class="form-group">
							<label for="language" class="col-sm-3">Languages</label>
							<div class="col-sm-9">													
								{!! Form::select('language_code', $language, null, ['id' => 'language_code','class' => 'form-control', 'required']) !!}
							</div>
						</div>
						<div class="form-group">
							<label for="spoken_level" class="col-sm-3">Written Skill</label>
							<div class="col-sm-9">													
								{!! Form::select('spoken_level', $lang_skill_level, null, ['id' => 'spoken_level','class' => 'form-control', 'required']) !!}
							</div>
						</div>
						<div class="form-group">
							<label for="written_level" class="col-sm-3">Spoken Skill</label>
							<div class="col-sm-9">													
								{!! Form::select('written_level', $lang_skill_level, null, ['id' => 'written_level','class' => 'form-control', 'required']) !!}										                  
							</div>
						</div>								
				      </div>
				      <div class="modal-footer">
				      	<button class="btntabsave btn btn-primary" action="{{URL::to('/candidate/ajaxsave/')}}" >Save</button>
				        <button type="button" class="btntabcancel btn btn-default" data-dismiss="modal">Close</button>
				     </div>
				    </div>
				    {!! Form::close() !!}
				  </div>  
				</div>
		    </div>
		    <div id="tab_addpreference" class="tab-pane fade">
		    	<form id = 'form-save-preference' method="post" norefresh="1" enctype="multipart/form-data">
		    		<input type="hidden" name="formtype" value="preference">
			      	<h3>{{ trans('front/candidate.title_5') }}</h3>	
			      	<div class="col-lg-12">
			      		<div class="form-group">
							<label for="about_myself" class="col-sm-3">About Yourself<sup>*</sup></label>
							<div class="col-sm-9">								
									<textarea name="about_myself" id="about_myself"  rows="5" cols="50" class="form-control" placeholder="Write about yourself" maxlength="3000">{{$userprofile->about_myself}}</textarea>
							</div>
						</div>		      								
						<div class="form-group">
							<label for="prefered_industry" class="col-sm-3">Job Industry</label>
							<div class="col-sm-9">
								{!! Form::select('prefered_industry', $industry, $userprofile->prefered_industry, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group">
							<label for="prefered_category" class="col-sm-3">Job Category</label>
							<div class="col-sm-9">
								{!! Form::select('prefered_category', $job_category, $userprofile->prefered_category, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group">
							<label for="prefered_level" class="col-sm-3">Job Level</label>
							<div class="col-sm-9">
								{!! Form::select('prefered_level', $job_level, $userprofile->prefered_level, ['class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group">
							<label for="prefered_type" class="col-sm-3">Job Type</label>
							<div class="col-sm-9">
								{!! Form::select('prefered_type', $job_type, $userprofile->prefered_type, ['class' => 'form-control']) !!}
							</div>
						</div>	
						<div class="form-group">
							<label for="prefered_salary" class="col-sm-3">Expected Salary</label>
							<div class="col-sm-9">
								{!! Form::select('prefered_salary_currency', $currency, $userprofile->prefered_salary_currency, ['id'=>'currency_min' ,'class' => 'signup_select', 'style' => 'margin-right:2px']) !!}
								<input type="text" name="prefered_salary" id="prefered_salary" value='{{$userprofile->prefered_salary}}'>								
							</div>
						</div>
						<div class="form-group">
							<label for="prefered_location" class="col-sm-3">Prefered Primary Job Location</label>
							<div class="col-sm-9">
								{!! Form::select('prefered_location', $country, $userprofile->prefered_location, ['id'=>'job_country', 'class' => 'form-control']) !!}
							</div>
						</div>						
						<div class="form-group">
							<label for="prefered_location2" class="col-sm-3">Prefered Secondary Job Location</label>
							<div class="col-sm-9">
								{!! Form::select('prefered_location2', $country, $userprofile->prefered_location2, ['id'=>'job_country', 'class' => 'form-control']) !!}
							</div>
						</div>
						<div class="form-group">
							<label for="prefered_location3" class="col-sm-3">Prefered tertiary Job Location</label>
							<div class="col-sm-9">
								{!! Form::select('prefered_location3', $country, $userprofile->prefered_location3, ['id'=>'job_country', 'class' => 'form-control']) !!}
							</div>
						</div>
					</div>								
					<div align="center" class="form-group">
			    		<button class="btntabsave btn btn-primary" action="{{URL::to('/candidate/ajaxsave/')}}" >Save</button>
			    		<button class="btntabsave btnnexttab btn btn-primary" navigate='#tab_contact' action="{{URL::to('/candidate/ajaxsave/')}}" >Save and continue</button>			    	
			    	</div>
		    	</form>		    	
		    </div>
	    </div>	    	
		</div>
	</div>

<!-- Modal -->
<div id="confirmModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Are you sure you want to remove?</h4>
      </div>      
      <form id = 'confirmForm' method="post" norefresh="1" enctype="multipart/form-data">
      	<input type="hidden" name="id" id="id">
      	<input type="hidden" name="module" id="module">
      </form>      
      <div class="modal-footer">            	
      	<button class="btntabsave btn btn-primary" action="{{URL::to('/candidate/ajaxremove/')}}" >Save</button>
      	<button type="button" class="btn btn-default" data-dismiss="modal" action="{{URL::to('/candidate/ajaxremove/')}}">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>

  </div>
</div>
@stop
@section('scripts')
<style>
  .sortable { list-style-type: none; margin: 0; padding: 0; }
  .sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; cursor: move;}
  .sortable li span { margin-left: -1.3em; }
  .delete-icon{
  	float: right; cursor:pointer; margin-top: 16px
  }  
  .edit-icon{
  	float: right; cursor:pointer;
  }
  p{margin-left: 10px;}
</style>
<script>
	var skill_deletelist = [];
	var form_data_change = false;
	var edited_form = null;
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

		var curr_tab = sessionStorage.getItem('current_tab');		
		if(curr_tab){
			$('#tab_contact').removeClass('in active');
			$('#tab_contact_nav').removeClass('active');
			$(curr_tab).addClass('in active');
			$(curr_tab+'_nav').addClass('active');							

			var loadid = sessionStorage.getItem('loadid');			
			if(loadid){
				$('#'+loadid).trigger('click');
			}
			if(curr_tab == '#tab_contact' ||  curr_tab == '#tab_addskill' ) loadcontactdata();
		}else{
			loadcontactdata();
		}				

	});	 	
	//image upload
	$("#product_image").change(function() {
		$("#message").empty(); // To remove the previous error message
		var file = this.files[0];
		var imagefile = file.type;
		var match= ["image/jpeg","image/png","image/jpg"];
		if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
		{
			var preview_path = $("#public_path").val();
			$('#package_img_preview').attr('src',preview_path);
			$("#message").html("<?php echo trans('product/create.msg_imgvalid');?>");
			return false;
		}
		if (file) {
			var _URL = window.URL || window.webkitURL;
	        var img = new Image();
	        img.onload = function() {
	            /*if(this.width < 500 && this.height < 500){
					$("#product_image_remove").trigger('click');
					alert("<?php echo trans('product/create.msg_imgvaliddimension');?>");
	            	return false;
	            }*/
	        };
	        img.onerror = function() {
	            alert( "not a valid file: " + file.type);
	        };
	        img.src = _URL.createObjectURL(file);
    	}

    	var reader = new FileReader();
		reader.onload = imageIsLoaded;
		reader.readAsDataURL(this.files[0]);
		$("#image_uploaded").val("YES");
	});

	function imageIsLoaded(e) {
		$("#product_image").css("color","green");
		$('#image_preview').css("display", "block");
		$('#product_img_preview').attr('src', e.target.result);
		$('#product_img_preview').attr('width', '250px');
		$('#product_img_preview').attr('height', '230px');
	};


	$("#product_image_remove").on('click',function() {
		$("#image_uploaded").val("NO");
		$("#product_image").val("");
		$("#message").empty();
   	 	var preview_path = $("#public_path").val();
   	 	$('#product_img_preview').attr('src',preview_path);
	});
	//
	function deletedata(id, module, url, divid){        
		if(confirm('Delete record?')){
			$('#'+divid).hide();        
			$.ajax({
	            url : url,
	            type: 'POST',
	            data: {id:id, module:module},
	            dataType: 'json',
	            beforeSend: function () {
					 //spinner('show');
	            },
	            complete: function(xhr,status){
	            	//spinner('hide');
	            },
	            error: function(xhr){
		        },
				async : false,
	            success: function (data) {  	            
	            	$('#'+divid).hide();            	
	            }
	    	})
		}
	}		

	function loadcontactdata(){
		var main_form = $("#form-save-contact");
		var obj = JSON.parse('<?php echo $userprofile_json; ?>');
		loadformdata(main_form, obj);

		//only if address is loaded else hide it.
		var isValid = true; 
		$(".data-geolocation").each(function() {
		   var element = $(this);
		   if (element.val() == "") {
		       isValid = false;
		   }
		});
		if(isValid) $('#geo_details').show();
		//load profile pic
		if(obj['profile_picture']){
		var img_url = '<?php echo env("AS3_URL").env("AS3_bucket")."/"; ?>';
		var img = {target:{result:img_url+obj['profile_picture']}};
		imageIsLoaded(img); $("#image_uploaded").val("YES");
		}

		var skills = JSON.parse('<?php echo $core_skills; ?>');
		var studentSelect = $('#core_skills');
		$('#core_skills').empty();
		for(var key in skills){			
			$.ajax({
			    type: 'GET',
			    url: '<?php echo URL::to("/autocomplete/core_skill/") ?>' + '/' + skills[key]
			}).then(function (data) {
			    // create the option and append to Select2
			    data = data.items[0];
			    var option = new Option(data.text, data.id, true, true);
			    studentSelect.append(option).trigger('change');

			    // manually trigger the `select2:select` event
			    studentSelect.trigger({
			        type: 'select2:select',
			        params: {
			            data: data
			        }
			    });
			});
		}

		form_data_change = false;
		main_form.on('keyup change', 'input, select, textarea', function(){
    		form_data_change = true;
    		edited_form = main_form;
		});
	}

	function loadempdata(index){			
		resetformdata('form-save-work');
		var main_form = $("#form-save-work");		
		form_data_change = false;
		main_form.on('keyup change', 'input, select, textarea', function(){
    		form_data_change = true;
    		edited_form = main_form;
		});
		if(!index) {
			$('#candidate_workexp_id').val('');
			$('#workModel').find('h4.modal-title').text('Add Work Experience'); return false;
		}
		else { $('#workModel').find('h4.modal-title').text('Edit Work Experience'); }
		var workexp = JSON.parse('<?php echo $workexp_json; ?>');
		var obj = workexp[index];		
		loadformdata(main_form, obj);		
		
		return false;
	}	

	function loadeducationdata(index){			
		resetformdata('form-save-school');
		var main_form = $("#form-save-school");	
		form_data_change = false;
		main_form.on('keyup change', 'input, select, textarea', function(){
    		form_data_change = true;
    		edited_form = main_form;
		});
		if(!index) {
			$('#candidate_educ_id').val('');
			$('#educationModal').find('h4.modal-title').text('Add Educational Qualification'); 
			return false;
		}
		else { $('#educationModal').find('h4.modal-title').text('Edit Educational Qualification'); }
		var educationqly = JSON.parse('<?php echo $education_json; ?>');
		var obj = educationqly[index];			
		loadformdata(main_form, obj);
		
		return false;
	}

	function loadlanguagedata(index){
		resetformdata('form-language-skill');
		var main_form = $("#form-language-skill");	
		if(index) {
			var languageskill = JSON.parse('<?php echo $language_json; ?>');
			var obj = languageskill[index];			
			loadformdata(main_form, obj);
		}		
		form_data_change = false;
		main_form.on('keyup change', 'input, select, textarea', function(){
    		form_data_change = true;
    		edited_form = main_form;
		});
	}

    function loadformdata(main_form, obj){		
		for(var key in obj){		    		    		    
		    if(obj.hasOwnProperty(key)){
		    	var input_type = main_form.find("#"+key).prop('type');
		    	//console.log(key +' = '+input_type + '=>'+obj[key]);
		    	if(key == 'additionalskills'){
		    		list_element = main_form.find('button.btn_addtolist').attr('list-element');		    			
		    		warning_element = main_form.find('button.btn_addtolist').attr('warning-element');		    		
		    		for (var s in obj[key]) {		    			
		    			addionalskillList(obj[key][s].skill_id ,obj[key][s].content,list_element,warning_element);
		    		};
		    	}else if(!input_type) continue;		    	
		    	if(input_type == 'radio' || input_type == 'checkbox'){		    		
		    		$('input[name='+key+'][value='+obj[key]+']').attr('checked', true).change(); 		    		
		    	}else if(input_type == 'select-one' || input_type == 'select-multiple' ) {			    				    					    			
			    	main_form.find('#'+key).val(obj[key]).change();			    		
		    	}else if(input_type == 'month' && obj[key]){
		    		document.getElementById(key).value =  obj[key].substr(0, 7);
		    	}else if(input_type == 'date' && obj[key]){
		    		document.getElementById(key).value =  obj[key].substr(0, 10);
		    	}else{
		    		main_form.find('#'+key).val(obj[key]);
		    	}		    				    	

		    }
		}
	}

	function resetformdata(main_form){
		document.getElementById(main_form).reset();
		list_element = $('#'+main_form).find('button.btn_addtolist').attr('list-element');		    			
		warning_element = $('#'+main_form).find('button.btn_addtolist').attr('warning-element');
		$('#'+list_element).empty();
		$('#'+warning_element).show();
	}

	function addionalskillList(id, value, list_element, warning_element){		
		$('#'+warning_element).hide();
    	$('#'+list_element).append(
    		'<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>'
    		+ '<span class="editable" id= '+ id +' style="margin-left: auto;">' + value + '</span>'
          	+ '<span class="ui-icon ui-icon-pencil edit-icon" onclick="editlist(this)"></span>'
          	+ '<span class="ui-icon ui-icon-closethick delete-icon" onclick="deletelist(this,\''+list_element+'\',\''+warning_element+'\')"></span></li>'           
        );	     
	}

	$( ".editnavbar" ).on( "click", function(e) {
		if(form_data_change){			
			if(confirm('Some changes are not saved. Save now?')){
				e.preventDefault();
				var curr_tab = sessionStorage.getItem('current_tab');		
				$(curr_tab).find('.btntabsave').first().trigger('click');				
			}
		}
		var curr_tab = $(this).attr('href')		
		sessionStorage.setItem('current_tab', curr_tab);
		if(curr_tab == '#tab_contact' ||  curr_tab == '#tab_addskill' ) loadcontactdata();
		sessionStorage.removeItem('loadid');		
		form_data_change = false;		
	});
		
	$( ".btntabsave" ).button().on( "click", function(e) {  
		e.preventDefault();  
		//var curr_tab =  $("ul.nav-tabs> li.active").find('a').attr('form');	
		var curr_tab = $(this).closest('form').attr('id');	
		saveform(curr_tab, this);	
	});
	
	function saveform(curr_tab, obj){
		var process_flag = true;
		var content_flag = 'application/x-www-form-urlencoded; charset=UTF-8';
		var myForm = $('#'+curr_tab);
        if (!myForm[0].checkValidity()) {
        	alert('Please fill all required fields');        	
        	return false;
        }  
        var data = $('#'+curr_tab).serializeArray();	      
        //validation
        if(curr_tab == 'form-save-school'){
        	var still_study = $('#form-save-school').find('#still_studying').val();
        	var is_graduated = $('#form-save-school').find('#is_graduated').val();
        	var grad_date = $('#form-save-school').find('#grad_date').val();
        	var lastenrollyear = $('#form-save-school').find('#lastenrollyear').val();
        	
        	if (still_study == 'N' && is_graduated == '' ){
        		alert('Please fill in graduated details');        	
        		return false;
        	}else if (still_study == 'N' && is_graduated == 'Y' && grad_date == ''){
        		alert('Please fill in graduated date');        	
        		return false;
        	}else if(still_study == 'N' && is_graduated == 'N' && lastenrollyear == ''){
        		alert('Please fill in Last enrolled date');        	
        		return false;
        	}

        }else if(curr_tab == 'form-save-work'){        	
        	var still_working = $('#form-save-work').find('#still_working').val();
        	var end_date = $('#form-save-work').find('#end_date').val();

        	if(still_working == 'N' && end_date == ''){
        		alert('Please fill in Employment end date');        	
        		return false;
        	}
        }else if(curr_tab == 'form-language-skill'){
        	var curr_selection_lang_code = $('#'+curr_tab).find('#language_code').val();
        	var cand_lang_id = $('#'+curr_tab).find('#candidate_lang_id').val();
        	var languageskill = JSON.parse('<?php echo $language_json; ?>');
        	for(var key in languageskill){	
        		if(languageskill[key]['language_code'] == curr_selection_lang_code && cand_lang_id != languageskill[key]['candidate_lang_id']){
        			alert("This Language skill already exists");
        			return false;
        		}
        	}
        }
        //..
		
		data.push({name: "candidate_profile_id", value: "<?php echo Session::get('user.candidateprofileid'); ?>"});	
		

		var spanValues = [];			
		$("#"+curr_tab).find('li> span.editable').each(function(){
			var content = $(this).text()
			if($(this).hasClass('edit-in-progress')) content = $(this).find('input').val();			
		    	spanValues.push({'skill_id': $(this).attr('id'), 'content' : content});
		});
		if(spanValues)
			data.push({name: "skill_list", value: JSON.stringify(spanValues)});	
		if(skill_deletelist)
			data.push({name: "skill_deletelist", value: JSON.stringify(skill_deletelist)});	
		//Handling image
		if(curr_tab == 'form-save-contact'){
        	if($("#image_uploaded").val() === 'YES'){
        		var data = new FormData($('#form-save-contact')[0]);
				//data = formData
        		//var file_data = $('#product_image').prop('files')[0];			                 
			    //formData.append('file', file_data);  
			    process_flag = false;
			    content_flag = false;
			    //formData.append('data', data);
        	}
        }

		$.ajax({
            url : $(obj).attr('action'),
            type: 'POST',
            data: data,
            dataType: 'json',
            		cache: process_flag,
                    contentType: content_flag,
                    processData: process_flag,
            beforeSend: function () {
				 //spinner('show');
            },
            complete: function(xhr,status){
            	//spinner('hide');
            },
            error: function(xhr){
	        },
			async : false,
            success: function (data) {    
            	form_data_change = false;         	
            	location.reload();
            }
    	})
	}

	$(".btntabcancel").button().on("click", function(e){
		if(form_data_change){
			e.preventDefault();
			if(confirm('Some changes are not saved. Save now?')){				
				$(this).prev('.btntabsave').trigger('click');
			}
		}
	});

	$(".btnnexttab").button().on("click", function(e){
		current_tab = $(this).parents().find('.tab-pane').attr('id')
		$('#'+current_tab).removeClass('in active');
		$('#'+current_tab+'_nav').removeClass('active');
		next_tab = $(this).attr('navigate');
		$(next_tab).addClass('in active');
		$(next_tab+'_nav').addClass('active');	
		sessionStorage.setItem('current_tab', next_tab);
	});

	$('#div_enddate').hide();
	$('input:radio[name="still_working"]').change(function(){
	    if($(this).val() === 'Y'){
	       $('#div_enddate').hide();
	    }else{
	    	$('#div_enddate').show();
	    }
	});

	$('#div_degree').hide();
	$('input:radio[name="school_type"]').change(function(){
	    if($(this).val() === 'HIGHSCHOOL'){
	       $('#div_degree').hide();
	    }else if($(this).val() === 'COLLEGE'){
	    	$('#div_degree').show();
		}else{
	    	$('#div_degree').show();
	    }
	});

	$('#div_expgraddate').hide();
	$('#div_isgraduated').hide();
	$('#div_graddate').hide();
	$('#div_lastenrollyear').hide();
	$('#still_studying').change(function (e) { 		
		switch(this.value){
			case 'Y':
				$('#div_expgraddate').show();
				$('#div_isgraduated').hide();
				$('#div_graddate').hide();
				$('#div_lastenrollyear').hide();
			break;
			case 'N':
				$('#div_expgraddate').hide();
				$('#div_isgraduated').show();
				$('#div_graddate').hide();
				$('#div_lastenrollyear').hide();
			break;
			default:
				$('#div_expgraddate').hide();
				$('#div_isgraduated').hide();
				$('#div_graddate').hide();
				$('#div_lastenrollyear').hide();
		}
	}); 

	$('#is_graduated').change(function (e) { 		
		if($('#still_studying').val() == 'N'){
			$('#div_expgraddate').hide();
			switch(this.value){
				case 'Y':								
					$('#div_graddate').show();
					$('#div_lastenrollyear').hide();
				break;
				case 'N':				
					$('#div_graddate').hide();
					$('#div_lastenrollyear').show();
				break;
				default:			
					$('#div_graddate').hide();
					$('#div_lastenrollyear').hide();
			}
		}
	}); 

	$(function() {
	    $( ".sortable" ).sortable({
	        placeholder: "ui-state-highlight",        
	      });
	    $( ".sortable" ).disableSelection();	
	 });
	
	$( "#btn_jobsearch" ).button().on( "click", function(e) {  
		e.preventDefault();  
	});	
	
	$( ".btn_addtolist" ).button().on( "click", function(e) {  
		e.preventDefault();  
		$text_element = $('#'+$(this).attr('text-element'));
		$list_element = $('#'+$(this).attr('list-element'));
		$warning_element = $('#'+$(this).attr('warning-element'));
		if($text_element.val()){
			$warning_element.hide();
	    	$list_element.append(
	    		'<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>'
	    		+ '<span class="editable" style="margin-left: auto;">' + $text_element.val() + '</span>'
	          	+ '<span class="ui-icon ui-icon-pencil edit-icon" onclick="editlist(this)"></span>'
	          	+ '<span class="ui-icon ui-icon-closethick delete-icon" onclick="deletelist(this,\''+$(this).attr("list-element")+'\',\''+$(this).attr("warning-element")+'\')"></span></li>'           
	        );
	        $text_element.val('');
    	}
    });
	
	function deletelist(id, list_element, warning_element){			
		var skill_id = id.parentElement.getElementsByClassName('editable')[0].id;
		if(skill_id) skill_deletelist.push(skill_id);
		id.parentElement.remove();		
		var myUL = document.getElementById(list_element);
		var list = myUL.childElementCount;
		if(list < 1){
			$('#'+warning_element).show();
		}		
	}
	function editlist(id){				
		id.parentElement.children[1].click();
	}
	 
	// Edit and save todo
	$('.editable').inlineEdit({
	    save: function(e, data) {
	            var $this = $(this);	            
	        }
	});
</script>
@stop