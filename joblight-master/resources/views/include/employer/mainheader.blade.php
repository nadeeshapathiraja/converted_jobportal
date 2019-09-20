@section('header')
	<!-- Logo -->
		<div id="logo">
         <div><a href="{{URL::to('/')}}"><img src="{{URL::asset('img/jobkonner_logo.png')}}" width="159" height="63" alt="Company Logo"></a></div>
         <span>for Employers</span>
		</div>
	<!-- Nav -->
		<nav id="nav">
			<ul>
				<li><a href="{{URL::to('/employer/main')}}">Home</a></li>				
				<li><a href="{{Route('buycredits')}}">Buy Credits</a></li>							
				<li class ="special"><a href="{{URL::to('/employer/postcreate')}}">Post new Job</a></li>
            <li><a href="{{route('logout')}}">Sign Out</a></li>    
			</ul>
		</nav>

	<div class="employer_headertop">
      <div class="employer_header_companydetails">
         <div class="employer_companyname">
            {{$employerprofiles->name}}
            <a href="{{Route('editprofile', $employerprofiles->employer_profile_id)}}">
               <div class="employer_editprofile">&nbsp;</div>
            </a>
         </div>
         <div class="employer_companyaddress"> {{$employerprofiles->address}} </div>
         <div class="employer_companydetails">
            Account admin: 
            <div class="employer_companyinfo"> {{$employerprofiles->contact_person}} </div>
         </div>
         <div class="employer_companydetails">
            Contact number: 
            <div class="employer_companyinfo"> {{$employerprofiles->contact_number}} </div>
         </div>
         <div class="employer_companydetails">
            Email address: 
            <div class="employer_companyinfo">  {{$employerprofiles->contact_email}} </div>
         </div>
         <div class="employer_creditdetails">
            You currently have            
               <span class="employer_creditcount"> <a href="{{Route('buycredits')}}" class="btn_link">
                  {{$employerprofiles->credits ? $employerprofiles->credits : 0}}</a>
            credits</span>            
         </div>
      </div>
    </div>  

@stop