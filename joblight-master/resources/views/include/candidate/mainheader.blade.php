@section('header')
    <!-- Logo -->
        <div id="logo">
            <div><a href="{{URL::to('/')}}"><img src="{{URL::asset('img/jobkonner_logo.png') }}" width="159" height="63" alt="Company Logo"></a></div>                    
        </div>
    <!-- Nav -->
        <nav id="nav">

            <ul>
                <li class="current"><a href="{{route('candidatehome')}}">Home</a></li>  
                <li><a href="{{URL::to('/jobsearch')}}">Search Job</a></li>              
                <li><a href="{{route('showinterview')}}">Interview</a></li>
                <li>
                    <a href="#">Applications</a>
                    <ul>
                        <li><a href="{{URL::to('/jobsearch/applied')}}">Applied Jobs</a></li>
                        <li><a href="{{URL::to('/jobsearch/shortlisted')}}">Saved Jobs</a></li>
                        <li><a href="{{URL::to('/jobsearch/recommended')}}">Recommended Jobs</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-user-circle"></i>&nbsp;{{Session::get('user.firstname')}}</a>
                    <ul>
                        <li><a href="{{route('candidateprofile')}}">Profile</a></li>
                        <li><a href="{{route('candidateprofile', ['edit'])}}">Edit Profile</a></li>
                        <li><a href="{{route('candidatesettings')}}">Settings</a></li>                        
                    </ul>
                </li>
                <li><a href="{{URL::to('/logout')}}">SignOut</a></li>
            </ul>
        </nav>


@stop