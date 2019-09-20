@extends('template.include.master')
@if($mode == 'NEW')
	@include('template.include.index_header')
	@include('template.include.index_footer')
@else
	@include('template.include.employer_header')
	@include('template.include.employer_footer')
@endif	
@section('main')
	<section>
		<div class="block no-padding">
			<div class="container">
				<div class="row no-gape">
				@if($mode == 'NEW')
                	<div class="col-lg-12 column">
                		<div class="padding-left">
					 		<div class="profile-title" id="mp">
					 			<h3>For employers only</h3>		
					 			<span>					 				
				                     Please enter a valid email address. Verification will be sent to this email.
				                     You will receive updates through this email address.
					 			</span>			 			
					 		</div>
                @else
                	@include('template.employer._aside')			 					 	
				 	<div class="col-lg-9 column">  
				 		<div class="padding-left">
					 		<div class="profile-title" id="mp">
					 			<h3>My Profile</h3>					 			
					 		</div>
                @endif				 					 		
					 		<div class="contact-edit">
					 			<form method="POST" id="form-main" action="{{URL::to('/employer/ajaxsignup')}}" accept-charset="utf-8" enctype="multipart/form-data">
					 				<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">	
					            	<input type="hidden" name="account_type" value="employer"> 	               	             
					               	<input type="hidden" name="employer_profile_id" id="employer_profile_id" value="">
					 				<div class="col-lg-12 column">
						 				<div class="row">
						 					<div class="col-lg-12 upload-img-bar">
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
						 					<div class="col-lg-6">
						 						<span class="pf-title">Full Name</span>
						 						<div class="pf-field">					 							
						 							<input placeholder="Full Name" id="contact_person" name="contact_person" type="text" value="" required>
						 						</div>
						 					</div>
						 					<div class="col-lg-6">
						 						<span class="pf-title">Current Position</span>
						 						<div class="pf-field">					 							
						 							<input placeholder="Current Position" id="contact_position" name="contact_position" type="text" value="" required>
						 						</div>
						 					</div>
						 					<div class="col-lg-6">
						 						<span class="pf-title">Email Address</span>
						 						<div class="pf-field">					 							
						 							@if($mode=='NEW')								                    	
								                    	<input id="email" name="contact_email" class="email" type="email" placeholder="Email" required
														title="You can't register with an email already in use. Please sign in or use a different email" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');"/>
														<i class="la la-envelope-o"></i>
								                    @else
								                    	<input id="contact_email" placeholder="Email address" name="contact_email" type="email" value="" disabled>
								                    @endif
						 						</div>
						 					</div>
						 					<div class="col-lg-6">
						 						<span class="pf-title">Contact Number</span>
						 						<div class="pf-field">					 							
						 							<input id="contact_number" placeholder="Contact number e.g. 034567890" name="contact_number" type="text" value="" required>
						 						</div>
						 					</div>	

						 					@if($mode == 'NEW')
						 					<div class="profile-title" id="mp">
									 			<h3>Create Password</h3>	 			
									 		</div> 
									 		<div class="upload-info">
									 			<span> * minimum 6 characters, at least one number, one lowercase and one uppercase letter </span>	
									 		</div>
									 		<div class="col-lg-6">
						 						<span class="pf-title">Password</span>
						 						<div class="pf-field">
													<input class="signup_text" id="password" placeholder="Password" name="password" type="password" value="" 
													required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers"                     
													onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); if(this.checkValidity()) form.password_confirmation.pattern = this.value;">
						 						</div>
						 					</div>

						 					<div class="col-lg-6">
						 						<span class="pf-title">Confirm Password</span>
						 						<div class="pf-field">					 							
													<input class="signup_text" id="confirm_password" placeholder="Password confirmation" name="password_confirmation" type="password" value="" 
													required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Please enter the same Password as above" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');">
						 						</div>
						 					</div>						 															
											@endif


						 					<div class="profile-title" id="mp">
									 			<h3>Company Information</h3>								 			
									 		</div>

						 					<div class="col-lg-6">
						 						<span class="pf-title">Company Name</span>
						 						<div class="pf-field">
						 							@if($mode=='NEW')
								                    	<input placeholder="Company name" id="name" name="name" type="text" value="" required>
								                    @else
								                        <input placeholder="Company name" id="name" name="name" type="text" value="" readonly>
								                    @endif   
						 						</div>
						 					</div>
						 					<div class="col-lg-6">
						 						<span class="pf-title">Employer Type</span>
						 						<div class="pf-field">					 							
													{!! Form::select('recruitment_type', $employer_type, null, [ 'id'=>'recruitment_type' ,'class' => 'chosen', 'required']) !!}
						 						</div>
						 					</div>

						 					<div class="col-lg-6">
						 						<span class="pf-title">Company Industry</span>
						 						<div class="pf-field">					 							
													{!! Form::select('industry', $employer_industry, null, ['id' => 'industry','class' => 'chosen', 'required']) !!}
						 						</div>
						 					</div>

						 					<div class="col-lg-6">
						 						<span class="pf-title">Address</span>
						 						<div class="pf-field">					 							
													<input id="address" placeholder="Address" name="address" type="text" value="" required>
						 						</div>
						 					</div>
						 					<div class="col-lg-6">
						 						<span class="pf-title">Postcode</span>
						 						<div class="pf-field">					 							
													<input id="zip" placeholder="Postcode" name="zip" type="text" value="">
						 						</div>
						 					</div>
						 					<div class="col-lg-6">
						 						<span class="pf-title">City</span>
						 						<div class="pf-field">
						 							<input id="city" placeholder="Location" name="city" type="text" value="" required>
						 						</div>
						 					</div>
						 					<div class="col-lg-6">
						 						<span class="pf-title">State</span>
						 						<div class="pf-field">
						 							<input id="state" placeholder="State" name="state" type="text" value="" required>
						 						</div>
						 					</div>

						 					<div class="col-lg-6">
						 						<span class="pf-title">Country</span>
						 						<div class="pf-field">
						 							{!! Form::select('country', $country, null, ['id'=>'country' ,'class' => 'chosen', 'required']) !!}
						 						</div>
						 					</div>					 					
						 					
						 					<div class="col-lg-12">
						 						<span class="pf-title">LinkedIn Company Page URL</span>
						 						<div class="pf-field">
						 							<input id="crunchbase_url" placeholder="LinkedIn Company Page URL e.g. https://www.linkedin.com/company/jobstore-com" name="crunchbase_url" type="text" value=""><i class="la la-linkedin"></i>
						 						</div>
						 					</div>

						 					<div class="col-lg-12">
						 						<span class="pf-title">About The Company</span>
						 						<div class="pf-field">
						 							<textarea id="description" placeholder="About The Company" name="description" cols="50" rows="10" required></textarea>
						 						</div>
						 					</div>
						 					@if($mode == 'NEW')						 						
												<div class="upload-info">
										 			<span>* By signing up to jobkonner, you agree to our <a class="theme-color" href="">Privacy Policy</a> and <a class="theme-color" href="">Terms of Service</a>. 
													</span>													
										 		</div>
						 						<div class="col-lg-12">
							 						<button type="submit">Register</button>
							 					</div>
						 					@else
						 						<div class="col-lg-12">
							 						<button type="submit">Update</button>
							 					</div>
						 					@endif
						 					
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
<script type="text/javascript">

$(document).ready(function() {   
   var mode = '<?php echo $mode;?>';
   if(mode == 'EDIT') {
      $('#save_btn').attr('value','Save');      
      var main_form = $("#form-main");
      main_form.attr('action', "<?php echo Route('updateprofile');?>");
      var obj = JSON.parse('<?php echo $employerprofiles_json; ?>');
      loadformdata(main_form, obj);
   }
});

$(document).on('blur', '#email', function() {
   $('#email_errmsg').html('');
   $('#email').removeClass('form_required');
   $('#save_btn').prop('disabled', false);
   var email = $(this).val(); 
   if(email)
      checkemail(email, 'employer');   
   else
      $('#email').addClass('form_required').focus();   
});

function checkemail(email, type){
      var url = '<?php echo URL::to("/ajaxcheckemail");?>';      
      var data = {};    
      data.email = email; 
      data.account_type = type;
      data._token = '<?php echo Session::getToken(); ?>';
      $.ajax({
           type: 'POST',
           data: data,
           dataType: 'json',
           url: url,
           beforeSend: function() {               
           },
           success: function(data) {     
            if(data.allow == 'yes'){
               $('#save_btn').prop('disabled', false);
            }else{
               $('#email_errmsg').html(data.msg);
               $('#email').addClass('form_required').focus();               
               $('#save_btn').prop('disabled', true);
               this.value='Continue';
            }

           },
           error: function(error) {
               
           }
       });
}

function loadformdata(main_form, obj){    
      for(var key in obj){                          
          if(obj.hasOwnProperty(key)){
            var input_type = main_form.find("#"+key).prop('type');
            console.log(key +' = '+input_type + '=>'+obj[key]);
            if(key == 'additionalskills'){
               list_element = main_form.find('button.btn_addtolist').attr('list-element');                  
               warning_element = main_form.find('button.btn_addtolist').attr('warning-element');               
               for (var s in obj[key]) {                 
                  addionalskillList(obj[key][s].skill_id ,obj[key][s].content,list_element,warning_element);
               };
            }else if(obj['logo_url']){
				var img_url = '<?php echo env("AS3_URL").env("AS3_bucket")."/"; ?>';
				var img = {target:{result:img_url+obj['logo_url']}};
				imageIsLoaded(img); $("#image_uploaded").val("YES");
			}else if(!input_type) continue;           
            if(input_type == 'radio' || input_type == 'checkbox'){               
               $('input[name='+key+'][value='+obj[key]+']').attr('checked', true).change();              
            }else if(input_type == 'select-one' || input_type == 'select-multiple' ) {                                                    
               main_form.find('#'+key).val(obj[key]).change().trigger("chosen:updated");
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

function triggerfileinput(){
	$('#product_image').trigger('click');
}   
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
</script>
@stop