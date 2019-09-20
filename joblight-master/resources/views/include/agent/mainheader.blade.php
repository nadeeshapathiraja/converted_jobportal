@section('header')
    <!-- Logo -->
        <div id="logo">
            <div><a href="{{URL::to('/')}}"><img src="{{URL::asset('img/jobkonner_logo.png') }}" width="159" height="63" alt="Company Logo"></a></div>                    
        </div>
    <!-- Nav -->
        <nav id="nav">

            <ul>
                <li class="current"><a href="{{route('agenthome')}}">Home</a></li>  
                <li ><a href="{{ route('referapplicant',['applicant']) }}">Refer Applicants</a></li>                  
                <li>
                    <a href="#"><i class="fa fa-user-circle"></i>&nbsp;{{Session::get('user.firstname')}}</a>
                    <ul>
                        <li><a href="">Settings</a></li>                        
                    </ul>
                </li>
                <li><a href="{{URL::to('/logout')}}">SignOut</a></li>
            </ul>
        </nav>


@stop