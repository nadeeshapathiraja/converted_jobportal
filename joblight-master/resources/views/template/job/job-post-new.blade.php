@extends('template.include.master')
@include('template.include.employer_header')
@include('template.include.employer_footer')
@section('main')
<section>
	<div class="block no-padding">
		<div class="container">
			<div class="row no-gape">			 	
				@include('template.job._aside')
			 	<div class="col-lg-10 column">
			 		<div class="padding-left">
				 		<div class="profile-title">
				 			<h3>Post a New Job</h3>				 			
				 		</div>				 		
				 		<div class="profile-form-edit contact-edit">
				 			<form method="POST" id="form-save-post" action="{{URL::to('/employer/ajaxcreatepost')}}" accept-charset="UTF-8">
					      	<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
					        <input type="hidden" name="jobpost_id" id="jobpost_id">
				 				<div class="row">
				 					<div class="col-lg-12">
				 						<span class="pf-title">Job Title</span>
				 						<div class="pf-field">
				 							<input type="text" id="job_title" name="job_title" placeholder="Job Title" />
				 						</div>
				 					</div>
				 					<div class="col-lg-6">
				 						<span class="pf-title">City</span>
				 						<div class="pf-field">
				 							<input id="geo_autocomplete" name="job_city" placeholder="City" type="text">
				 							<input type="hidden" id="state" name="job_state" placeholder="State" type="text">
				 						</div>
				 					</div>			
				 					<div class="col-lg-6">
				 						<span class="pf-title">Country</span>
				 						<div class="pf-field">
				 							{!! Form::select('job_country', $country, null, ['id'=>'country', 'class' => 'chosen', 'required']) !!}
				 						</div>
				 					</div>
				 					<div class="col-lg-6">
				 						<span class="pf-title">Job/Position Level</span>
				 						<div class="pf-field">				 							
											{!! Form::select('job_level', $job_level, null, ['class' => 'chosen', 'id' => 'job_level' ,'required']) !!}
				 						</div>
				 					</div>
				 					<div class="col-lg-6">
				 						<span class="pf-title">Categories</span>
				 						<div class="pf-field">				 							
											{!! Form::select('job_category', $job_category, null, ['class' => 'chosen','id' => 'job_category' ,'required']) !!}
				 						</div>
				 					</div>
				 					<div class="col-lg-6">
				 						<span class="pf-title">Job Type</span>
				 						<div class="pf-field">
				 							{!! Form::select('job_type', $job_type, null, ['class' => 'chosen', 'id' => 'job_type' ,'required']) !!}
				 						</div>
				 					</div>
				 					<div class="col-lg-2">
				 						<span class="pf-title">Offerd Salary</span>
				 						<div class="pf-field">
				 							{!! Form::select('salary_currency', $currency, null, ['id'=>'currency_min' ,'class' => 'chosen', 'style' => 'width:24%;margin-right:2px', 'id' => 'salary_currency' ,'required']) !!}
				 						</div>
				 					</div>
				 					<div class="col-lg-2">
				 						<span class="pf-title">Min</span>
				 						<div class="pf-field">
				 							<input id="salary_min" name="salary_min" placeholder="Minimum" type="text">
				 						</div>
				 					</div>
				 					<div class="col-lg-2">
				 						<span class="pf-title">Max</span>
				 						<div class="pf-field">
				 							<input id="salary_max" name="salary_max" placeholder="Maximum" type="text">
				 						</div>
				 					</div>
				 					<div class="col-lg-12">
				 						<span class="pf-title">New Description</span>
				 						<div class="pf-field">
											<input id="job_description" name="job_description" type="hidden"></input>
											<textarea id="job_editor"></textarea>
				 						</div>
				 					</div>						 						
				 					<!-- 			 					
				 					<div class="col-lg-6">
				 						<span class="pf-title">Experience</span>
				 						<div class="pf-field">
				 							<select data-placeholder="Please Select Specialism" class="chosen">
												<option>Web Development</option>
												<option>Web Designing</option>
												<option>Art & Culture</option>
												<option>Reading & Writing</option>
											</select>
				 						</div>
				 					</div>
				 					<div class="col-lg-6">
				 						<span class="pf-title">Gender</span>
				 						<div class="pf-field">
				 							<select data-placeholder="Please Select Specialism" class="chosen">
												<option>Web Development</option>
												<option>Web Designing</option>
												<option>Art & Culture</option>
												<option>Reading & Writing</option>
											</select>
				 						</div>
				 					</div>
				 					<div class="col-lg-6">
				 						<span class="pf-title">Industry</span>
				 						<div class="pf-field">
				 							<select data-placeholder="Please Select Specialism" class="chosen">
												<option>Web Development</option>
												<option>Web Designing</option>
												<option>Art & Culture</option>
												<option>Reading & Writing</option>
											</select>
				 						</div>
				 					</div>
				 					<div class="col-lg-6">
				 						<span class="pf-title">Qualification</span>
				 						<div class="pf-field">
				 							<select data-placeholder="Please Select Specialism" class="chosen">
												<option>Web Development</option>
												<option>Web Designing</option>
												<option>Art & Culture</option>
												<option>Reading & Writing</option>
											</select>
				 						</div>
				 					</div>
				 					<div class="col-lg-12">
				 						<span class="pf-title">Application Deadline Date</span>
				 						<div class="pf-field">
				 							<input type="text" placeholder="01.11.207" />
				 						</div>
				 					</div>
				 					<div class="col-lg-12">
				 						<span class="pf-title">Skill Requirments</span>
				 						<div class="pf-field">
					 						<ul class="tags">
									           <li class="addedTag">Photoshop<span onclick="$(this).parent().remove();" class="tagRemove">x</span><input type="hidden" name="tags[]" value="Web Deisgn"></li>
						            			<li class="tagAdd taglist">  
						              				 <input type="text" id="search-field">
									            </li>
											</ul>
										</div>
				 					</div> -->			 						
			 						<div class="col-lg-12 contact-textinfo less-top">	
			 							<input id="draftList" name="draftList" type="hidden" value="">
			 							<a href="{{URL::to('/employer/main')}}" title="" > Cancel </a>
			 							<a href="javascript:{}" onclick="$('#draftList').val('YES'); document.getElementById('form-save-post').submit(); return false;" class="fill"><i id="markfavi"  class="la la-paper-plane"></i>  Save</a>
								 		<button id="formsave" name="preview" type="submit">Preview & Post</button>
								 	</div>		 										 					
				 				</div>
				 			</form>
				 		</div>				 		
				 	</div>
				</div>
			 </div>
		</div>
	</div>
</section>
@stop

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBalFpLm5S9IyehiU8bjgqe_webG9VTnLQ&amp;libraries=places&amp;callback=geolocate_min" async="" defer=""></script>
{!! HTML::style('new/minified/themes/default.min.css') !!}
{!! HTML::script('new/minified/sceditor.min.js') !!}
{!! HTML::script('new/minified/formats/xhtml.js') !!}

<script type="text/javascript">
var job_editor = document.getElementById('job_editor');
var instance = sceditor.create(job_editor, {		
	    format: 'xhtml',	    
	    emoticonsEnabled : false,
	    height: '500px',
	    width: '100%',
	    style: '/new/minified/themes/content/default.min.css',
	    toolbarExclude : 'image|maximize|emoticon|youtube|date|time',
	});
sceditor.instance(job_editor).blur(function() {
    $('#job_description').val(sceditor.instance(job_editor).val());
});
$(document).ready(function() {
	var main_form = $("#form-save-post");
    var obj = JSON.parse('<?php echo $post_json; ?>');
    loadformdata(main_form, obj);
    form_data_change = false;
    main_form.on('keyup change', 'input, select, textarea', function(){
        form_data_change = true;
        edited_form = main_form;
    }); 
});

function loadformdata(main_form, object){      
  var obj = object[0];  
    for(var key in obj){                        
        if(obj.hasOwnProperty(key)){
          var input_type = main_form.find("#"+key).prop('type');
          //console.log(key +' = '+input_type + '=>'+obj[key]);
          if(key == 'notification_type' || key == 'application_receive_mode'){
            $('input[name='+key+'][value='+obj[key]+']').attr('checked', true).change().click();          
          }else if(key == 'job_country'){
            main_form.find('#country').val(obj[key]).trigger("chosen:updated");
          }else if(key == 'job_city'){
            main_form.find('#geo_autocomplete').val(obj[key]).trigger("chosen:updated");
          }else if(key == 'job_description'){
            sceditor.instance(job_editor).val(obj[key]);
          }else if(key == 'is_confidential'){
            if(obj[key] == 'Y')
              main_form.find('#company_list').val('Confidential').change();
          }
          if(!input_type) continue;         
          if(input_type == 'radio' || input_type == 'checkbox'){            
            $('input[name='+key+'][value='+obj[key]+']').attr('checked', true).change();          
          }else if(input_type == 'select-one' || input_type == 'select-multiple' ) {                                          
            main_form.find('#'+key).val(obj[key]).change().trigger("chosen:updated");
          }else if(input_type == 'month' && obj[key]){
            document.getElementById(key).value =  obj[key].substr(0, 7);
          }else{            
            main_form.find('#'+key).val(obj[key]);
          }                     

        }
    }
  }
</script>
@stop