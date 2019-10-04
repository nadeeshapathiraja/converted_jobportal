@section('header')
	<div class="responsive-header">
		<div class="responsive-menubar">
			<div class="res-logo"><a href="index.html" title=""><img src="{{ URL::asset('new/images/logo.png')}}" alt="" /></a></div>
			<div class="menu-resaction">
				<div class="res-openmenu">
					<img src="{{ URL::asset('new/images/icon.png')}}" alt="" /> Menu
				</div>
				<div class="res-closemenu">
					<img src="{{ URL::asset('new/images/icon2.png')}}" alt="" /> Close
				</div>
			</div>
		</div>
		<div class="responsive-opensec">
			<div class="btn-extars">

				<ul class="account-btns">
					<li class="signup-popup"><a title=""><i class="la la-key"></i> Sign Up</a></li>
					<li class="signin-popup"><a title=""><i class="la la-external-link-square"></i> Login</a></li>
				</ul>
			</div><!-- Btn Extras -->
			<form class="res-search">
				<input type="text" placeholder="Job title, keywords or company name" />
				<button type="submit"><i class="la la-search"></i></button>
			</form>
			<div class="responsivemenu">

			</div>
		</div>
	</div>

	<header class="stick-top forsticky">
		<div class="menu-sec">
			<div class="container">
				<div class="logo">
					<a href="{{route('mainindex')}}" title=""><img class="hidesticky" src="{{ URL::asset('new/images/logo.png')}}" alt="" /><img class="showsticky" src="{{ URL::asset('new/images/logo.png')}}" alt="" /></a>
				</div><!-- Logo -->
				<div class="btn-extars">

					<ul class="account-btns">
						<li class="signup-popup"><a title=""><i class="la la-key"></i> Sign Up</a></li>
						<li class="signin-popup"><a title=""><i class="la la-external-link-square"></i> Login</a></li>
					</ul>
				</div><!-- Btn Extras -->
				<nav>


				</nav><!-- Menus -->
			</div>
		</div>
	</header>
@stop

@section('popups')
<div class="account-popup-area signin-popup-box">
	<div class="account-popup">
		<span class="close-popup"><i class="la la-close"></i></span>
		<h3>User Login</h3>
		<span>Choose User type and Click To Login</span>
		<div class="select-user">
			<span onclick="changeType('candidate', '{{URL::to('/candidate/login')}}' )" class="active">Candidate</span>
			<span onclick="changeType('employer', '{{URL::to('/employer/ajaxlogin')}}' )">Employer</span>
		</div>
		<form name="login" id="signin_form" method="post" action="{{URL::to('/candidate/login')}}" accept-charset="utf-8">
			{{ csrf_field() }}
			<input type="hidden" name="account_type" value="candidate" id="signin_account_type">
			<div class="cfield">
				<input id="username" name="login_id"  type="text" placeholder="Username" autofocus/>
				<i class="la la-user"></i>
			</div>
			<div class="cfield">
				<input id="password" name="password" type="password" placeholder="********" />
				<i class="la la-key"></i>
			</div>
			<div class="middleware_msg">{{Session::get('loginstatus')}}</div>
			<p class="remember-label">
				<input type="checkbox" name="cb" id="cb1"><label for="cb1">Remember me</label>
			</p>
			<a href="{{route('forgot-password')}}" title="">Forgot Password?</a>
			<button type="submit">Login</button>
		</form>

		<div class="extra-login">
			<span>Or</span>
			<div class="login-social">
				<a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i></a>
				<a class="tw-login" href="#" title=""><i class="fa fa-twitter"></i></a>
			</div>
		</div>
	</div>
</div><!-- LOGIN POPUP -->

<div class="account-popup-area signup-popup-box">
	<div class="account-popup">
		<span class="close-popup"><i class="la la-close"></i></span>
		<h3>Sign Up</h3>
		<div class="select-user">
			<span class="active">Candidate</span>
			<span onclick="window.location='{{route('employersignup')}}' "> Employer</span>
        </div>


		<form name='signup' method="post" action="{{URL::to('/candidate/signup')}}" accept-charset="utf-8">
            {{-- {!! Form::hidden('account_type', 'candidate')!!} --}}

			<div class="cfield">
				<input name="first_name" type="text" required placeholder="First Name" />
				<i class="la la-user"></i>
			</div>
			<div class="cfield">
				<input name="last_name" type="text" required placeholder="Last Name" />
				<i class="la la-user"></i>
			</div>
			<div class="cfield">
				<input id="email" name="email" class="email" type="text" placeholder="Email" required
				title="You can't register with an email already in use. Please sign in or use a different email" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');"/>
				<i class="la la-envelope-o"></i>
			</div>
			<div class="cfield">
				<input name="password" type="password" placeholder="********" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required autocomplete="new-password"
				title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" onchange="this.setCustomValidity(this.validity.patternMismatch ? this.title : '');"/>
				<i class="la la-key"></i>
			</div>
			<div class="cfield">
				<input type="text" placeholder="Referral Code" name="referral_code" maxlength="40" />
				<i class="la la-envelope-o"></i>
			</div>
            <button type="submit">Signup</button>

        </form>


		<div class="extra-login">
			<span>Or</span>
			<div class="login-social">
				<a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i></a>
				<a class="tw-login" href="#" title=""><i class="fa fa-twitter"></i></a>
			</div>
		</div>
	</div>
</div><!-- SIGNUP POPUP -->
@stop

@section('main-scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBalFpLm5S9IyehiU8bjgqe_webG9VTnLQ&amp;libraries=places&amp;callback=geolocate_min" async="" defer=""></script>
<script type="text/javascript">
$(document).ready(function() {
	if('<?php echo Session::get('loginstatus') ?>' !== ''){
		$('.signin-popup-box').fadeIn('fast');
    	$('html').addClass('no-scroll');
	}
})

$(document).on('blur', '.email', function() {
   var email = $(this).val();
   if(email)
      checkemail(email);
});
function checkemail(email){
      var url = '<?php echo URL::to("/ajaxcheckemail");?>';
      var data = {};
      data.email = email;
      data._token = '<?php echo csrf_field(); ?>';
      $.ajax({
           type: 'POST',
           data: data,
           dataType: 'json',
           url: url,
           beforeSend: function() {
           },
           success: function(data) {
            if(data.allow == 'yes'){
				$('.email').removeAttr('pattern');
            }else{
            	$('.email').attr('pattern', email+'-dup');
            }

           },
           error: function(error) {

           }
       });
}

function changeType(type, url){
	$('#signin_account_type').val(type);
	$('#signin_form').attr('action', url);
}



$('.agent-popup').on('click', function(){
    $('.agent-popup-box').fadeIn('fast');
    $('html').addClass('no-scroll');
});
$('.close-popup').on('click', function(){
    $('.agent-popup-box').fadeOut('fast');
    $('html').removeClass('no-scroll');
});

/*
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '595488987505039',
      cookie     : true,
      xfbml      : true,
      version    : 'v.3.0'
    });

    FB.AppEvents.logPageView();

  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
*/
</script>
@stop
