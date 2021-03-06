@extends('template.include.master')
@include('template.include.candidate_header')
@include('template.include.candidate_footer')
@section('main')
<section>
<div class="block remove-top"><div class="container"><div class="row no-gape">
	<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">		
	@include('template.candidate._profile_aside')			
	<div class="col-lg-9 column">
		<div class="padding-left">					
		<div class="tab-content form-group form-horizontal">
		    <div id="tab_contact" class="tab-pane fade in active">			    	
		 		<div class="border-title"><h3>{{ trans('front/candidate.title_1') }}</h3></div>		 		
				<div class="contact-edit">
				    <form id = 'form-save-contact' method="post" norefresh="1" enctype="multipart/form-data">					    	    	
				    	<input type="hidden" name="candidate_profile_id" value="<?php echo Session::get('user.candidateprofileid'); ?>">
				    	<input type="hidden" name="formtype" value="contact">			      				      						      	
				      	
				      	<div class="upload-img-bar">
				      		<input type= "hidden" id="public_path" value="{{URL::asset('new/images/profile_preview.png')}}">
				      		<input type="hidden" id= "image_uploaded" name="image_uploaded" value="NO">
				      		<input id="product_image" type="file" name="product_image" class="form-control" style="display:none;">
			 				<span class="round"><img class="product_img_preview" src="{{URL::asset('new/images/profile_preview.png')}}" alt="" onerror='this.src= "{{URL::asset('new/images/profile_preview.png')}}";$("#image_uploaded").val("NO"); '/><i>x</i></span>
			 				<div class="upload-info">
			 					<a onclick="javascript:triggerfileinput();" title="">Browse</a>
			 					<span>Max file size is 1MB, Minimum dimension: 270x210 And Suitable files are .jpg & .png</span>
			 					<div id="message" align="center"></div>
			 				</div>
			 			</div>

				      	<div class="container col-lg-12">		      								
							<p>{{ trans('front/candidate.text') }}</p>																									
							<div class="col-lg-6">
		 						<span for="firstname" class="pf-title">{{trans('front/candidate.lbl_firstname')}}<sup>*</sup></span>
		 						<div class="pf-field">
		 							<input type="text" name="firstname" id="firstname" data-rule-required="true" required maxlength="20">								
		 						</div>
		 					</div>
		 					<div class="col-lg-6">
		 						<span for="firstname" class="pf-title">{{trans('front/candidate.lbl_lastname')}}<sup>*</sup></span>
		 						<div class="pf-field">
		 							<input type="text" name="lastname" id="lastname" data-rule-required="true">								
		 						</div>
		 					</div>													
							<div class="col-lg-6">
								<span for="gender" class="pf-title">{{trans('front/candidate.lbl_gender')}}</span>																	
								<div class="radio" style="padding-top: 0px !important">
					                <div class="col-lg-6">
					                <input type="radio" name="gender" id="gender" value="M"><label for="gender">{{trans('front/candidate.ddl_option_boy')}}</label>
					            	</div>
					            	<div class="col-lg-6">
					                <input type="radio" name="gender" id="gender_F" value="F"><label for="gender_F">{{trans('front/candidate.ddl_option_girl')}}</label>
					                </div>
					            </div>																
							</div>
							
							<div class="col-lg-6">
								<span for="race" class="pf-title">{{trans('front/candidate.lbl_race')}}</span>
								<div class="pf-field">
									{!! Form::select('race', $race, null, ['id' => 'race','class' => 'chosen']) !!}
								</div>
							</div>	

							<div class="col-lg-6">
								<span for="date_of_birth" class="pf-title">{{trans('front/candidate.lbl_dob')}}</span>
								<div class="pf-field">
									<input type="date" name="date_of_birth" id="date_of_birth" max="1979-12-31" data-rule-required="true">	
								</div>
							</div>		
							<div class="col-lg-6">
								<span for="mobile" class="pf-title">{{trans('front/candidate.lbl_phone')}}</span>
								<div class="pf-field">
									<input type="text" name="mobile" id="mobile" data-rule-required="true" required>								
								</div>
							</div>																			
						</div>								
						<!-- <div class="col-lg-4">		
							<div class="form-group">
								<div class="fileinput fileinput-new" data-provides="fileinput" align="center">
								<input type= "hidden" id="public_path" value="{{URL::asset('img/preview.jpg')}}">
								<div id="image_preview"><img class="product_img_preview" src="{{URL::asset('img/preview.jpg')}}" onerror='this.src= "{{URL::asset('img/preview.jpg')}}";$("#image_uploaded").val("NO"); '/></div>
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
						</div> -->	 
						@include('element.address') 								
						<div align="center" class="col-lg-12">
					    	<button class="btntabsave btn btn-success" action="{{URL::to('/candidate/ajaxsave/')}}" >Update</button>
					    	<!-- <button class="btntabsave btnnexttab btn btn-primary" navigate='#tab_work' action="{{URL::to('/candidate/ajaxsave/')}}" >Update and continue</button> -->
					    </div>								
					</form>  					
				</div>
		    </div>
		    <div id="tab_work" class="tab-pane fade">
		    	<div class="manage-jobs-sec">
			      <div class="border-title"><h3>{{ trans('front/candidate.title_2') }}</h3><a class="work-popup" onclick="javascript:loadempdata();"><i class="la la-plus"></i> Add Experience</a></div>
			      <div class="col-lg-12">
					  	<div class="edu-history-sec">								    
					    	@foreach ($workexp as $k => $value) 
					        <div class="edu-history style2" id="empdata{{$k}}">
					        	<i></i>
 								<div class="edu-hisinfo">
 									<h3> {{$value->position}} <span> {{$value->employername}} </span> </h3>
 									<span>{{$value->city}}, {{$value->country}}</span>
 									<i>{{ date('F,Y', strtotime($value->start_date))}} - {{ ($value->still_working =='N')? date('F,Y', strtotime($value->end_date)) : 'Present' }}</i>
 									<p>
 										<ul>								        
								      	@for ($i = 0; $i < count($value->additionalskills) ; $i++)
										    @if($i < 2)
										    <li>{{$value->additionalskills[$i]->content}}</li>
										    @else
										    	<?php break; ?>
										    @endif	
										@endfor
						  				</ul>
						  			</p>
						      	</div>
						      	<ul class="action_job">
		 							<li><span>Edit</span>		 								
		 								<a id='loadempdata{{$k}}' onclick="javascript:loadempdata('{{$k}}');"> <i class="la la-pencil work-popup"></i> </a>
		 							</li>
		 							<li><span>Delete</span>		 								
		 								<a onclick="javascript:deletedata('{{$value->candidate_workexp_id}}', 'WORK', '{{URL::to('/candidate/ajaxremove/')}}', 'empdata{{$k}}');"> <i class="la la-trash-o"></i></a>
		 							</li>

		 						</ul>
						    </div>
					   		@endforeach     								 							
 						</div>
					  	<!-- Modal -->
					  	<div class="account-popup-area work-popup-box">
						  <form id = 'form-save-work' method="post" norefresh="1" enctype="multipart/form-data">
			      			<input type="hidden" name="formtype" value="work">
			      			<input type="hidden" name="candidate_workexp_id" id="candidate_workexp_id" value="">			      
							<div class="account-popup data-entry-popup">
								<span class="close-popup"><i class="btntabcancel la la-close"></i></span>
							    <div class="panel panel-default">
							      <div class="panel-heading">{{ trans('front/candidate.tab2_sec1_title') }}</div>
							      <div class="panel-body">
							      	<div class="col-sm-12">
										<span for="employername" class="pf-title-slim">{{trans('front/candidate.lbl_tab2_sec1_empname')}}<sup>*</sup></span>
										<div class="pf-field">
											<input type="text" name="employername" id="employername" class="form-control" data-rule-required="true" required>
										</div>
									</div>
									<div class="col-sm-12">
										<span for="industry" class="pf-title-slim">{{trans('front/candidate.lbl_tab2_sec1_industry')}}<sup>*</sup></span>
										<div class="pf-field dropdown-field">											
											{!! Form::select('industry', $industry, null, ['class' => 'chosen', 'id' => 'industry', 'required']) !!}
										</div>										
									</div>
									<div class="col-sm-12">
										<span for="city" class="pf-title-slim">{{trans('front/candidate.lbl_city')}}</span>
										<div class="pf-field">
											<input type="text" name="city" id="city" class="form-control" data-rule-required="true">								
										</div>
									</div>
									<div class="col-sm-12">
										<span for="state" class="pf-title-slim">{{trans('front/candidate.lbl_state')}}</span>
										<div class="pf-field">
											<input type="text" name="state" id="state" class="form-control" data-rule-required="true">								
										</div>
									</div>
									<div class="col-sm-12">
										<span for="country" class="pf-title-slim">{{trans('front/candidate.lbl_country')}}</span>
										<div class="pf-field">
											<input type="text" name="country" id="country" class="form-control" data-rule-required="true">								
										</div>
									</div>									
							      </div>
							    </div>
							    <div class="panel panel-default">
							      <div class="panel-heading">{{ trans('front/candidate.tab2_sec2_title') }}</div>
							      <div class="panel-body">
							      	<div class="col-sm-12">
										<span for="position" class="pf-title-slim">{{trans('front/candidate.lbl_tab2_sec2_positiontitle')}}<sup>*</sup></span>
										<div class="pf-field">
											<input type="text" name="position" id="position" class="form-control" data-rule-required="true" required>								
										</div>
									</div>
									<div class="col-sm-12">
										<span for="start_date" class="pf-title-slim">{{trans('front/candidate.lbl_tab2_sec2_startdate')}}<sup>*</sup></span>
										<div class="pf-field">
											<input type="month" name="start_date" id="start_date" class="form-control" max="9999-12" data-rule-required="true" required>	
										</div>
									</div>
									<div class="col-sm-12">
										<span for="still_working" class="pf-title-slim">{{trans('front/candidate.lbl_tab2_sec2_stillworking')}}<sup>*</sup></span>
										<div class="pf-field dropdown-field">	
										<div class="radio">
								            <div class="col-lg-6">
							                	<input type="radio" name="still_working" id="still_working" value="Y"><label for="still_working">{{trans('front/candidate.ddl_option_yes')}}</label>
							            	</div>
							            	<div class="col-lg-6">
							                	<input type="radio" name="still_working" id="still_working_N" value="N"><label for="still_working_N">{{trans('front/candidate.ddl_option_no')}}</label>
							                </div>
							            </div>    							
										</div>
									</div>
									<div class="col-sm-12" id="div_enddate">
										<span for="end_date" class="pf-title-slim">{{trans('front/candidate.lbl_tab2_sec2_enddate')}}<sup>*</sup></span>
										<div class="pf-field">
											<input type="month" name="end_date" id="end_date" class="form-control" max="9999-12" data-rule-required="true">								
										</div>
									</div>
									<div class="col-sm-12">
										<span for="salary" class="pf-title-slim">{{trans('front/candidate.lbl_tab2_sec2_salary')}}</span>
										<div class="pf-field">
											<input type="number" name="salary" id="salary" class="form-control" data-rule-required="true">								
										</div>
									</div>
							      </div>
							    </div>
							    <div class="panel panel-default">
							      <div class="panel-heading">{{ trans('front/candidate.tab2_sec3_title') }}</div>
							      <div class="panel-body">							      								  
									<div class="col-sm-12">																																		
										<small>{{ trans('front/candidate.lbl_add_to_list_subtitle') }}</small>																									
										<textarea name="responsibilities" id="responsibilities"  rows="3" cols="50" class="form-control" placeholder="{{ trans('front/candidate.ph_responsibilities') }}" maxlength="3000"></textarea>
										<br>
										<button id = 'btn_responsibilities' class='btn btn-default btn_addtolist' text-element='responsibilities' list-element='responsibilitylist' warning-element='noresponsibilityset'>{{ trans('front/candidate.btn_savencon') }}</button>																
									</div>	
									<div class="col-sm-12 pf-field">								
										<p>{{ trans('front/candidate.lbl_tab2_sec3_part3') }}</p>
										<div class="col-sm-12" id="noresponsibilityset">
											<span class="label label-warning" >{{trans('front/candidate.lbl_tab2_sec3_part3_warning')}}</span>
										</div>
										<div class="col-sm-12">
											<ul id="responsibilitylist" class="sortable"></ul>
					                  	</div>
									</div>					  
							      </div>
							    </div>														      						      
						      	<button class="btntabsave btn btn-success" action="{{URL::to('/candidate/ajaxsave/')}}" >Save</button>						        
						  	</div>
							</form>
						</div>
					</div>
			    </div>
		    </div>
		    <div id="tab_school" class="tab-pane fade">
		    	<div class="manage-jobs-sec">
			    
			      
			      <div class="border-title"><h3>{{ trans('front/candidate.title_3') }}</h3><a class="education-popup" onclick="javascript:loadeducationdata();"><i class="la la-plus"></i> Add Education</a></div>			      
			      <div class="col-lg-12">
			      	<p>{{ trans('front/candidate.text') }}</p>
			      		<div class="edu-history-sec">
						    @foreach ($education as $k => $value)
						        <div class="edu-history" id="educationdata{{$k}}">
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
							      	<ul class="action_job">
			 							<li><span>Edit</span>		 								
			 								<a id='loadeducationdata{{$k}}' onclick="javascript:loadeducationdata('{{$k}}');"> <i class="la la-pencil education-popup"></i> </a>
			 							</li>
			 							<li><span>Delete</span>
			 								<a onclick="javascript:deletedata('{{$value->candidate_educ_id}}', 'SCHOOL', '{{URL::to('/candidate/ajaxremove/')}}', 'educationdata{{$k}}');"> <i class="la la-trash-o"></i></a> 
			 							</li>			 							
			 						</ul>
							    </div>
						    @endforeach 								 							
 						</div>			      		
					  	<!-- Modal -->
					  	<div class="account-popup-area education-popup-box">
							<form id = 'form-save-school' method="post" norefresh="1" enctype="multipart/form-data">  
							<input type="hidden" name="formtype" value="school">
			      			<input type="hidden" name="candidate_educ_id" id="candidate_educ_id" value="">
							<div class="account-popup data-entry-popup">
								<span class="close-popup"><i class="btntabcancel la la-close"></i></span>
				      			<div class="panel panel-default">
				      				<div class="panel-heading">{{ trans('front/candidate.tab3_sec1_title') }}</div>
				      				<div class="panel-body">
				      					<div class="col-sm-12">
											<span for="school_type" class="pf-title-slim">{{trans('front/candidate.lbl_schooltype')}}<sup>*</sup></span>
											<div class="pf-field dropdown-field">																					
												<div class="radio">													
									            	<div class="col-lg-4">
									                	<input type="radio" name="school_type" id="school_type" value="HIGHSCHOOL"><label for="school_type">{{trans('front/candidate.rb_schooltype_opt1')}}  </label>
									                </div>
									            	<div class="col-lg-4">
									                	<input type="radio" name="school_type" id="school_type_c" value="COLLEGE"><label for="school_type_c">{{trans('front/candidate.rb_schooltype_opt2')}}</label>
									                </div>
									            	<div class="col-lg-4">
									                	<input type="radio" name="school_type" id="school_type_o" value="OTHER"><label for="school_type_o">{{trans('front/candidate.rb_schooltype_opt3')}}</label>
									            	</div>
									            </div>							
											</div>
										</div>
										<div class="col-sm-12">
											<span for="school_name" class="pf-title-slim">{{trans('front/candidate.lbl_schooname')}}<sup>*</sup></span>
											<div class="pf-field">
												<input type="text" name="school_name" id="school_name" class="form-control" data-rule-required="true" placeholder="{{trans('front/candidate.ph_name')}}" required>								
											</div>
										</div>
										<div id="div_degree">
											<div class="col-sm-12">
												<span for="degree" class="pf-title-slim">{{trans('front/candidate.lbl_degree')}}<sup>*</sup></span>
												<div class="pf-field dropdown-field">													
													{!! Form::select('degree', $degree, null, ['id' => 'degree','class' => 'chosen', 'required']) !!}
												</div>
											</div>
											<div class="col-sm-12">
												<span for="field_of_study" class="pf-title-slim">{{trans('front/candidate.lbl_fieldofstudy')}}<sup>*</sup></span>
												<div class="pf-field dropdown-field">
													{!! Form::select('field_of_study', $study_field, null, ['id' => 'field_of_study','class' => 'chosen', 'required']) !!}
												</div>
											</div>
										</div>
										<div class="col-sm-12">
											<span for="city" class="pf-title-slim">{{trans('front/candidate.lbl_city')}}</span>
											<div class="pf-field">
												<input type="text" name="city" id="city" class="form-control" data-rule-required="true" placeholder="{{trans('front/candidate.ph_city')}}">								
											</div>
										</div>
										<div class="col-sm-12">
											<span for="state" class="pf-title-slim">{{trans('front/candidate.lbl_state')}}</span>
											<div class="pf-field">
												<input type="text" name="state" id="state" class="form-control" data-rule-required="true">								
											</div>
										</div>
										<div class="col-sm-12">
											<span for="country" class="pf-title-slim">{{trans('front/candidate.lbl_country')}}</span>
											<div class="pf-field">
												<input type="text" name="country" id="country" class="form-control" data-rule-required="true">								
											</div>
										</div>										
										<div class="col-sm-12">
											<span for="enrolldate" class="pf-title-slim">{{trans('front/candidate.lbl_enrolleddate')}}</span>
											<div class="pf-field">
												<input type="month" name="enrolldate" id="enrolldate" class="form-control" max="9999-12" data-rule-required="true">	
											</div>
										</div>
										<div class="col-sm-12">
											<span for="still_studying" class="pf-title-slim">{{trans('front/candidate.lbl_stillschool')}}</span>
											<div class="pf-field dropdown-field">										
												<select name="still_studying" id="still_studying" class='chosen'>
													<option value="">{{trans('front/candidate.ddl_option_na')}}</option>
													<option value="Y">{{trans('front/candidate.ddl_option_yes')}}</option>
													<option value="N">{{trans('front/candidate.ddl_option_no')}}</option>
												</select>							
											</div>
										</div>
										<div class="col-sm-12" id="div_expgraddate">
											<span for="exp_graddate" class="pf-title-slim">{{trans('front/candidate.lbl_expgraddate')}}</span>
											<div class="pf-field">
												<input type="month" name="exp_graddate" id="exp_graddate" class="form-control" max="9999-12" data-rule-required="true">	
											</div>
										</div>
										<div class="col-sm-12" id="div_isgraduated">
											<span for="is_graduated" class="pf-title-slim">{{trans('front/candidate.lbl_isgraduated')}}</span>
											<div class="pf-field dropdown-field">										
												<select name="is_graduated" id="is_graduated" class='chosen'>
													<option value=""></option>
													<option value="Y">{{trans('front/candidate.ddl_option_yes')}}</option>
													<option value="N">{{trans('front/candidate.ddl_option_no')}}</option>
												</select>							
											</div>
										</div>
										<div class="col-sm-12" id="div_graddate">
											<span for="grad_date" class="pf-title-slim">{{trans('front/candidate.lbl_graddate')}}</span>
											<div class="pf-field">
												<input type="month" name="grad_date" id="grad_date" class="form-control" max="9999-12" data-rule-required="true">	
											</div>
										</div>
										<div class="col-sm-12" id="div_lastenrollyear">
											<span for="lastenrollyear" class="pf-title-slim">{{trans('front/candidate.lbl_lastenrollyear')}}</span>
											<div class="pf-field">
												<input type="month" name="lastenrollyear" id="lastenrollyear" class="form-control" max="9999-12" data-rule-required="true">	
											</div>
										</div>
				      				</div>
				      			</div>
				      			<div class="panel panel-default">
				      				<div class="panel-heading">{{ trans('front/candidate.tab3_sec2_title') }}</div>
				      				<div class="panel-body">
					      				<div class="col-sm-12">								
											<p>{{ trans('front/candidate.lbl_tab3_sec2_part1') }}</p>
											<div class="col-sm-12">								
											<small>{{ trans('front/candidate.lbl_add_to_list_subtitle') }}</small>
											</div>
											<div class="col-sm-12">																
												<textarea name="eduinfor" id="eduinfor"  rows="5" cols="50" class="form-control" placeholder="{{ trans('front/candidate.ph_eduinfo') }}" maxlength="3000"></textarea>
												<br>
												<button id = 'btn_eduinfor' class='btn_addtolist btn-default' text-element='eduinfor' list-element='educationlist' warning-element='noeducationset'>{{ trans('front/candidate.btn_savencon') }}</button>
											</div>								
										</div>	
										<div class="col-sm-12">								
											<p>{{ trans('front/candidate.lbl_tab3_sec2_part2') }}</p>
											<div class="col-sm-12" id="noeducationset">
												<span class="label label-warning" >{{trans('front/candidate.lbl_tab3_sec2_part2_warning')}}</span>
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
										  <input type="checkbox" id="future_study" name="future_study" value="Y"><label for="future_study">{{ trans('front/candidate.ck_tab3_sec3_option') }}</label>
										</div>
				      				</div>
				      			</div>
						      	<button class="btntabsave btn btn-success" action="{{URL::to('/candidate/ajaxsave/')}}" >Save</button>						        				     						    
							</div>
							{!! Form::close() !!}
						</div>
					</div>	
		    	</div>
			</div>
		    <div id="tab_addskill" class="tab-pane fade">			    
			    <div class="contact-edit">
			    {!! Form::open(['url' => 'candidate', 'method' => 'post', 'role' => 'form', 'id' => 'form-save-skill', 'norefresh' => '1']) !!}	
			    <input type="hidden" name="formtype" value="skill">			     			
		 		<div class="border-title"><h3>{{ trans('front/candidate.title_4') }}</h3></div>		 		
      			<div class="col-lg-12">
					<span for="core_skills" class="pf-title">{{trans('front/candidate.lbl_tab3_core_skill')}}<sup>*</sup></span>
					<div class="pf-field dropdown-field">															
						<!-- <input id="core_skills" name="core_skills" required="required">  -->  
						{!! Form::select('core_skills[]', array(), null, ['id' => 'core_skills', 'class' => 'multiple-core-skill', 'multiple' => 'multiple', 'required']) !!}
					</div>
				</div>						
				<div class="border-title"><h3>Languages Known</h3><a class="language-popup" onclick="javascript:loadlanguagedata();"><i class="la la-plus"></i> Add Language</a></div>							
				<div class="mini-portfolio">
					@foreach ($languageskill as $key => $val) 				  	
					<div class="mp-row row" id="languageskill{{$key}}">
						<div class="mp-col">
							<div class="mportolio"><span>{{$language[$val->language_code]}}</span></div>
						</div>
						<div class="mp-col">
							<div class="mportolio"><span>Written - {{$lang_skill_level[$val->written_level]}}</span></div>
						</div>
						<div class="mp-col">
							<div class="mportolio"><span>Spoken - {{$lang_skill_level[$val->spoken_level]}}</span></div>
						</div>
						<ul class="mp-col action_job">							
							<li><span>Edit</span><a class="language-popup"  onclick="javascript:loadlanguagedata('{{$key}}');"><i class="la la-pencil"></i></a></li>
							<li><span>Delete</span><a onclick="javascript:deletedata('{{$val->candidate_lang_id}}', 'LANGUAGE', '{{URL::to('/candidate/ajaxremove/')}}', 'languageskill{{$key}}');"><i class="la la-trash"></i></a></li>
						</ul>						
					</div>
					@endforeach					
				</div>				
				<div class="border-title"><h3>{{ trans('front/candidate.tab4_sec1_title') }}</h3></div>
      			<div class="col-lg-12">      				      				      												
					<p>{{ trans('front/candidate.lbl_tab4_sec1_part1') }}</p>											
					<small>{{ trans('front/candidate.lbl_tab4_sec1_part1_subtitle') }}</small>					
					<textarea name="addskills" id="addskills"  rows="5" cols="50" class="form-control" placeholder="{{ trans('front/candidate.ph_addskills') }}" maxlength="3000"></textarea>
					<br>
					<button class='btn_addtolist btn-default' text-element='addskills' list-element='skillslist' warning-element='noskillset' >{{ trans('front/candidate.btn_savencon') }}</button>					
				</div>	
				<div class="col-lg-12">								
					<p>{{ trans('front/candidate.lbl_add_to_list_subtitle') }}</p>
					<div class="col-sm-12" id="noskillset">
						<?php
						if(!$additionalskill){ ?>
						<span class="label label-warning" >{{trans('front/candidate.lbl_tab4_sec1_part2_warning')}}</span>
						<?php } ?>
					</div>
					<div class="col-sm-12">
						<ul id="skillslist" class="sortable">
						<?php						        
				          foreach ($additionalskill as $key => $val) { ?>									              
				            <li class="ui-state-default">
								<span class="editable" id= "{{$val->skill_id}}" style="margin-left: auto;">{{$val->content}}</span>
					          	<!-- <span class="ui-icon ui-icon-pencil edit-icon" onclick="editlist(this)"></span> -->
					          	<i class="la la-trash delete-icon" onclick="deletelist(this,'skillslist','noskillset')"></i>
					        </li>           
				          <?php      
				            }
				        ?>
				        </ul>		
                  	</div>
				</div>														      				      				      											    
			      <div align="center" class="col-lg-12">
			    	<button class="btntabsave btn btn-success" action="{{URL::to('/candidate/ajaxsave/')}}" >Update</button>
			    	<!-- <button class="btntabsave btnnexttab btn btn-primary" navigate='#tab_addpreference' action="{{URL::to('/candidate/ajaxsave/')}}" >Save and continue</button> -->
			      </div>
			    {!! Form::close() !!}
				</div>
				<div class="account-popup-area language-popup-box">
					<div class="account-popup data-entry-popup">
						<span class="close-popup"><i class="btntabcancel la la-close"></i></span>			    
					  	{!! Form::open(['url' => 'candidate', 'method' => 'post', 'role' => 'form', 'id' => 'form-language-skill', 'norefresh' => '1']) !!}					  	
					  	<input type="hidden" name="formtype" value="language">
					    <input type="hidden" name="candidate_lang_id" id="candidate_lang_id" value="">				  			      				      
				      	<div class="col-lg-12">
							<span for="language" class="pf-title">Languages</span>
							<div class="pf-field dropdown-field">													
								{!! Form::select('language_code', $language, null, ['id' => 'language_code','class' => 'chosen', 'required']) !!}
							</div>
						</div>
						<div class="col-lg-6">
							<span for="spoken_level" class="pf-title">Written Skill</span>
							<div class="pf-field dropdown-field">													
								{!! Form::select('spoken_level', $lang_skill_level, null, ['id' => 'spoken_level','class' => 'chosen', 'required']) !!}
							</div>
						</div>
						<div class="col-lg-6">
							<span for="written_level" class="pf-title">Spoken Skill</span>
							<div class="pf-field dropdown-field">													
								{!! Form::select('written_level', $lang_skill_level, null, ['id' => 'written_level','class' => 'chosen', 'required']) !!}										                  
							</div>
						</div>
						<div class="col-lg-6"></div>
						<div class="col-lg-6">
						  <button class="btntabsave btn" action="{{URL::to('/candidate/ajaxsave/')}}" >Save</button>
						</div>
				    	{!! Form::close() !!}
				  </div>  
				</div>
		    </div>
		    <div id="tab_addpreference" class="tab-pane fade">
		    	<div class="border-title"><h3>{{ trans('front/candidate.title_5') }}</h3></div>		 		
				<div class="contact-edit">
		    	<form id = 'form-save-preference' method="post" norefresh="1" enctype="multipart/form-data">
		    		<input type="hidden" name="formtype" value="preference">			      	
			      	
		      		<div class="col-lg-12">
						<span for="about_myself" class="pf-title">About Yourself<sup>*</sup></span>
						<div class="pf-field">								
								<textarea name="about_myself" id="about_myself"  rows="5" cols="50" class="form-control" placeholder="Write about yourself" maxlength="3000">{{$userprofile->about_myself}}</textarea>
						</div>
					</div>		      								
					<div class="col-lg-6">
						<span for="prefered_industry" class="pf-title">Job Industry</span>
						<div class="pf-field dropdown-field">
							{!! Form::select('prefered_industry', $industry, $userprofile->prefered_industry, ['class' => 'chosen']) !!}
						</div>
					</div>
					<div class="col-lg-6">
						<span for="prefered_category" class="pf-title">Job Category</span>
						<div class="pf-field dropdown-field">
							{!! Form::select('prefered_category', $job_category, $userprofile->prefered_category, ['class' => 'chosen']) !!}
						</div>
					</div>
					<div class="col-lg-6">
						<span for="prefered_level" class="pf-title">Job Level</span>
						<div class="pf-field dropdown-field">
							{!! Form::select('prefered_level', $job_level, $userprofile->prefered_level, ['class' => 'chosen']) !!}
						</div>
					</div>
					<div class="col-lg-6">
						<span for="prefered_type" class="pf-title">Job Type</span>
						<div class="pf-field dropdown-field">
							{!! Form::select('prefered_type', $job_type, $userprofile->prefered_type, ['class' => 'chosen']) !!}
						</div>
					</div>	
					<div class="col-lg-6">
						<span class="pf-title">Expected Salary</span>
						<div class="pf-field col-lg-6">
							{!! Form::select('prefered_salary_currency', $currency, $userprofile->prefered_salary_currency, ['id'=>'currency_min' ,'class' => 'chosen', 'style' => 'margin-right:2px']) !!}							
						</div>
						<div class="pf-field col-lg-6">
							<input type="text" name="prefered_salary" id="prefered_salary" value='{{$userprofile->prefered_salary}}'>								
						</div>	
					</div>	
					<div class="social-edit">
						<h3>Prefered Job Location</h3>
					<div class="col-lg-4">
						<span for="prefered_location" class="pf-title">I want to work here</span>
						<div class="pf-field dropdown-field">
							{!! Form::select('prefered_location', $country, $userprofile->prefered_location, ['id'=>'job_country', 'class' => 'chosen']) !!}
						</div>
					</div>						
					<div class="col-lg-4">
						<span for="prefered_location2" class="pf-title">I can consider here</span>
						<div class="pf-field dropdown-field">
							{!! Form::select('prefered_location2', $country, $userprofile->prefered_location2, ['id'=>'job_country', 'class' => 'chosen']) !!}
						</div>
					</div>
					<div class="col-lg-4">
						<span for="prefered_location3" class="pf-title">I can also consider here</span>
						<div class="pf-field dropdown-field">
							{!! Form::select('prefered_location3', $country, $userprofile->prefered_location3, ['id'=>'job_country', 'class' => 'chosen']) !!}
						</div>
					</div>		
					</div>													
					<div align="center" class="col-lg-12">
			    		<button class="btntabsave btn btn-primary" action="{{URL::to('/candidate/ajaxsave/')}}" >Update</button>
			    		<!-- <button class="btntabsave btnnexttab btn btn-primary" navigate='#tab_contact' action="{{URL::to('/candidate/ajaxsave/')}}" >Save and continue</button> -->			    	
			    	</div>
		    	</form>	
		    	</div>	    	
		    </div>
	    </div>
	    </div>	    			
	</div>
</div></div></div>
</section>
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
<script src="{{ asset('js/geolocation.js') }}"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
{!! HTML::script('js/plugins.js') !!}
{!! HTML::script('js/jquery-ui.js') !!}
{!! HTML::script('js/jquery.inlineedit.js') !!}	
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />        
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<style>
  .sortable { list-style-type: none; margin: 0; padding: 0; }
  .sortable li { margin: 0 3px 3px 3px; padding: 0.4em; font-size: 1.4em; cursor: move;}
  .sortable li span { margin-left: -1.3em; }
  .delete-icon{
  	float: right; cursor:pointer;
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
	function triggerfileinput(){
		$('#product_image').trigger('click');
	}
	$('.work-popup').on('click', function(){
        $('.work-popup-box').fadeIn('fast');
        $('html').addClass('no-scroll');
    });
    $('.education-popup').on('click', function(){
        $('.education-popup-box').fadeIn('fast');
        $('html').addClass('no-scroll');
    });
    $('.language-popup').on('click', function(){
        $('.language-popup-box').fadeIn('fast');
        $('html').addClass('no-scroll');
    });
    $('.close-popup').on('click', function(){
        $('.work-popup-box').fadeOut('fast');
        $('.education-popup-box').fadeOut('fast');
        $('.language-popup-box').fadeOut('fast');
        $('html').removeClass('no-scroll');
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
			$("#message").html("<?php echo trans('front/candidate.msg_imgvalid');?>");
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
		$('.product_img_preview').attr('src', e.target.result);
		// $('.product_img_preview').attr('width', '250px');
		// $('.product_img_preview').attr('height', '230px');
	};

	$('.upload-img-bar > span i').on('click', function(){
        $("#image_uploaded").val("NO");
		$("#product_image").val("");
		$("#message").empty();
   	 	var preview_path = $("#public_path").val();
   	 	$('.product_img_preview').attr('src',preview_path);
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
			    	main_form.find('#'+key).val(obj[key]).change().trigger("chosen:updated");
			    	//if(main_form.find('#'+key).hasClass('chosen')) main_form.find('#'+key).trigger("chosen:updated");			    		
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
    		'<li class="ui-state-default">'
    		+ '<span class="editable" id= '+ id +' style="margin-left: auto;">' + value + '</span>'          	
          	+ '<i class="la la-trash delete-icon" onclick="deletelist(this,\''+list_element+'\',\''+warning_element+'\')"></i>'
          	//+ '<i class="la la-pencil edit-icon" onclick="editlist(this)"></i></li>'
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
			var enrolldate = $('#form-save-school').find('#enrolldate').val();
			var expGradDate = $('#form-save-school').find('#exp_graddate').val();
			
			if(!$("input[name='school_type']:checked").val()){
				alert('Please select school type');
        		return false;
			}
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
			if(still_study == 'Y'){
				if(Date.parse(enrolldate) > Date.parse(expGradDate)){
					alert('Enroll date must be earlier than Expected Graduation date ');
					return false;
				}
			}else if(still_study == 'N'){
				var enddate = lastenrollyear? grad_date : grad_date;
				if(Date.parse(enrolldate) > Date.parse(enddate)){
					alert('Enroll date must be earlier than Graduation date ');
					return false;
				}
			}

        }else if(curr_tab == 'form-save-work'){        	
			var still_working = $("input[name='still_working']:checked").val();
			var start_date = $('#form-save-work').find('#start_date').val();
        	var end_date = $('#form-save-work').find('#end_date').val();
			if(!still_working){
				alert('Are you still working in this job?');
				return false;
			}else if(still_working == 'N'){
				if(end_date == ''){
        			alert('Please fill in Employment end date');        	
					return false;
				}else{
					if(Date.parse(start_date) > Date.parse(end_date)){
						alert('Start date must be earlier than End date ');
						return false;
					}
				}
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

	$(".btntabcancel").on("click", function(e){
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
		   $('#end_date').removeAttr('required');
	    }else{
			$('#div_enddate').show();
			$('#end_date').attr('required', 'required');
	    }
	});

	$('#div_degree').hide();
	$('input:radio[name="school_type"]').change(function(){
	    if($(this).val() === 'HIGHSCHOOL'){
		   $('#div_degree').hide();
		   $('#degree').removeAttr('required');
		   $('#field_of_study').removeAttr('required');
	    }else if($(this).val() === 'COLLEGE'){
			$('#div_degree').show();
			$('#degree').attr('required', 'required');
		   	$('#field_of_study').attr('required', 'required');
		}else{
			$('#div_degree').show();
			$('#degree').attr('required', 'required');
		   	$('#field_of_study').attr('required', 'required');
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
	    		'<li class="ui-state-default">'
	    		+ '<span class="editable" style="margin-left: auto;">' + $text_element.val() + '</span>'
	          	//+ '<i class="la la-pencil edit-icon" onclick="editlist(this)"></i>'
	          	+ '<i class="la la-trash delete-icon" onclick="deletelist(this,\''+$(this).attr("list-element")+'\',\''+$(this).attr("warning-element")+'\')"></i></li>'           
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
		id.parentElement.children[0].click();
	}
	 
	// Edit and save todo
	/*$('.editable').inlineEdit({
	    save: function(e, data) {
	            var $this = $(this);	            
	        }
	});*/
</script>
@stop