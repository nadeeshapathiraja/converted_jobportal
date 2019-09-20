@section('header')
		<!-- Logo -->
		<div id="logo">
			<div><a href="{{URL::to('/')}}"><img src="{{URL::asset('img/jobkonner_logo.png') }}" width="159" height="63" alt="Company Logo"></a></div>
			<span>for Agents</span>
		</div>
	<!-- Nav -->
		<nav id="nav">
			<ul>
				<li class="current"><a href="">Features</a></li>				
				<li><a href="">Job Board</a></li>
				<li><a href="">Pricing</a></li>
				<li><a href="">FAQ</a></li>				
				<li class ="special"><a href="{{route('candidatelogin')}}">I am a Jobseeker</a></li>
				<li class ="special"><a href="{{route('employerlogin')}}">I am an Employer</a></li>
			</ul>
		</nav>

@stop