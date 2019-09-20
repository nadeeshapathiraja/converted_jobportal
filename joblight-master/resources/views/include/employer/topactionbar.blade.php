@section('topactionbar')  
   <nav class="employee_navbar">
      <ul>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropbtn">Jobs</a>
          <div class="dropdown-content">
            <a href="{{URL::to('/employer/managejob/draft')}}">Draft</a>
            <a href="{{URL::to('/employer/managejob/posted')}}">Posted</a>
            <a href="{{URL::to('/employer/managejob/terminated')}}">Terminated</a>
          </div>
        </li>
        <li class="dropdown"><a href="{{URL::to('/employer/talentsearch')}}">Talent Search</a></li>                 
        <li><a href="#">Interviews</a></li>
        <li><a href="{{Route('editprofile', $employerprofiles->employer_profile_id)}}">Profiles</a></li>
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropbtn">More Actions</a>
          <div class="dropdown-content">
            <a href="#">History</a>
            <a href="#">Support</a>
            <a href="#">Resources</a>
            <a href="{{URL::to('/logout')}}">Logout</a>
          </div>
        </li>
      </ul>
   </nav>
@stop   