@section('header')
	<!-- Logo -->
		<div id="logo">
			<div><a href="{{URL::to('/')}}"><img src="{{URL::asset('img/jobkonner_logo.png') }}" width="159" height="63" alt="Company Logo"></a></div>			
		</div>
	<!-- Nav -->
		<nav id="nav">
			<ul>								
				<li><a href="{{route('candidatelogin')}}#login-wrapper">Log In</a></li>					
				<li><a href="{{ route('referralactivation',[Session::get('user.referralkey')]) }}" >SignUp</a></li>							
				<li><a href="{{URL::to('/jobsearch')}}">Job Search</a></li>										
				<li class ="special"><a href="{{route('employerlogin')}}">I am an Employer</a></li>
				<li class ="special"><a href="{{URL::to('/agent')}}">For Agent</a></li>
			</ul>
		</nav>

@stop