@extends($mode == 'NEW' ? 'include.global_template' : 'include.employer.maintemplate')
@if($mode == 'NEW')
  @include('include.employer.guest_header')
@else
  @include('include.employer.mainheader')
  @include('include.employer.topactionbar')
@endif



@section('main')
<div id="features-wrapper">
   <div class="container">
      <div class="row">
         <div class="2u 12u(medium)">
         </div>
         <div class="9u 12u(medium)" style="background-color: rgba(255, 153, 0, 0.2);padding: 0 40px 40px 40px;">
            <form method="POST" id="form-main" action="{{URL::to('/employer/ajaxsignup')}}" accept-charset="utf-8">               
               <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">	
               <input type="hidden" name="account_type" value="employer"> 	               	             
               <input type="hidden" name="employer_profile_id" id="employer_profile_id" value="">
                  @if($mode == 'NEW')
                  <h1 class="signup_title">
                     For employers only
                  </h1>
                  <div class="signup_section">
                     Please enter a valid email address. Verification will be sent to this email.
                     You will receive updates through this email address. If you already have an account, please
                     <a href="{{URL::to('/employer/')}}" class="to_register">sign in here</a>.
                  </div>
                  @endif

                  <div class="signup_titleblock">
                     <span class="signup_titlehead">
                     Personal Details
                     </span>
                  </div>
                  <div class="signup_boxleft">
                     <label for="contact_person">Full Name</label>
                     <input class="signup_text" placeholder="Full Name" id="contact_person" name="contact_person" type="text" value="" required>
                  </div>
                  <div class="signup_boxright">
                  	 <label for="contact_position">Current Position</label>
                     <input class="signup_text" placeholder="Current Position" id="contact_position" name="contact_position" type="text" value="" required>                     
                  </div>
                  <div class="signup_boxleft">
                     <label for="email">Email Address</label>
                     @if($mode=='NEW')
                     <input class="signup_text" id="email" placeholder="Email address" name="contact_email" type="email" value="" required>                                       
                     @else
                     <input class="signup_text" id="contact_email" placeholder="Email address" name="contact_email" type="email" value="" disabled>                                       
                     @endif
                  </div>
                  <div class="signup_boxright">
                     <label for="contact">Contact Number</label>
                     <input class="signup_text" id="contact_number" placeholder="Contact number e.g. 034567890" name="contact_number" type="text" value="" required>                     
                  </div>    
                  <div class="middleware_msg" id="email_errmsg"></div>               
                  <br>
                  <div class="signup_titleblock">
                     <span class="signup_titlehead">
                     Company Information
                     </span>
                  </div>
                  <div class="signup_boxleft">
                     <label for="name">Company Name</label>
                     @if($mode=='NEW')
                        <input class="signup_text" placeholder="Company name" id="name" name="name" type="text" value="" required>
                     @else
                        <input class="signup_text" placeholder="Company name" id="name" name="name" type="text" value="" disabled>
                     @endif   
                     
                  </div>
                  <div class="signup_boxright">
                     <label for="type">Employer Type</label>
                     {!! Form::select('recruitment_type', $employer_type, null, [ 'id'=>'recruitment_type' ,'class' => 'signup_select', 'required']) !!}
                  </div>
                  
                  <div class="signup_boxleft">
                     <label for="industry">Company Industry</label>
                     {!! Form::select('industry', $employer_industry, null, ['id' => 'industry','class' => 'signup_select', 'required']) !!}                     
                     
                  </div>
                  <div class="signup_boxright">
                     <label for="address">Address</label>
                     <input class="signup_text" id="address" placeholder="Address" name="address" type="text" value="" required>
                     
                  </div>                  
                  <div class="signup_boxleft">
                     <label for="city">City</label>
                     <input class="signup_text" id="city" placeholder="Location" name="city" type="text" value="" required>
                     
                  </div>
                  <div class="signup_boxright">
                     <label for="zip">Postcode</label>
                     <input class="signup_text" id="zip" placeholder="Postcode" name="zip" type="text" value="">
                     
                  </div>
                  <div class="signup_boxleft">
                     <label for="state">State</label>
                     <input class="signup_text" id="state" placeholder="State" name="state" type="text" value="" required>
                     
                  </div>
                  <div class="signup_boxright">
                     <label for="country">Country</label>
                     {!! Form::select('country', $country, null, ['id'=>'country' ,'class' => 'signup_select', 'required']) !!}                     
                  </div>
                  <div class="signup_boxleft" style="width:100%;">
                     <label for="crunchbase_url">LinkedIn Company Page URL</label>
                     <input class="signup_text" id="crunchbase_url" placeholder="LinkedIn Company Page URL e.g. https://www.linkedin.com/company/jobstore-com" name="crunchbase_url" type="text" value="">
                     
                  </div>
                  <div class="signup_boxleft" style="width:100%;">
                     <label for="description">About The Company</label>
                     <textarea class="signup_textarea" id="description" placeholder="About The Company" name="description" cols="50" rows="10" required></textarea>                     
                  </div>   
                  @if($mode == 'NEW')               
                  <br><br>
                  <div class="signup_titleblock">
                     <span class="signup_titlehead">
                     Create Password
                     </span>
                  </div>                  
                  <div class="signup_boxpassword">
                     <label for="password">Password</label>
                     <input class="signup_text" id="password" placeholder="Password" name="password" type="password" value="" 
                     required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers"                     
                     onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); if(this.checkValidity()) form.password_confirmation.pattern = this.value;">
                  </div>
                  <div class="signup_boxconfirm">
                     <label for="confirm_password">Confirm Password</label>
                     <input class="signup_text" id="confirm_password" placeholder="Password confirmation" name="password_confirmation" type="password" value="" 
                     required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Please enter the same Password as above" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');">                     
                  </div>  
                  <span class="remindpword">
                     * minimum 6 characters, at least one number, one lowercase and one uppercase letter
                  </span>                                  
                  <br><br>
                  <div class="signup_tos">
                     * By signing up to jobkonner, you agree to
                     <br>&nbsp; our
                     <a href="">Privacy Policy</a>
                     and
                     <a href="">Terms of Service</a>.
                  </div>
                  @endif
                  <input class="signup_submit" id="save_btn" type="submit" value="Continue" />               
            </form>                   
         </div>
      </div>
   </div>
</div>
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
</script>
@stop
