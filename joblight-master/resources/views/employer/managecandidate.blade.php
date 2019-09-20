@extends('include.employer.maintemplate')
@include('include.employer.mainheader')
@include('include.employer.topactionbar')

@section('main')    
  <div >
  <section class="box">
    <div class="main_container">    
     <div class="home_bar">        
      <!--<div class="top_title"> -->
          <h1>{{$mode}}</h1>
      <!-- </div> -->
      <div class="header_filter_tab">
          <a href="{{route('managecandidate',['job_id' => $job_id])}}"><div id="new" class="list_all list_allon">New Applicants ({{$candidate_applied}})</div></a>
          <a href="{{route('managecandidate',['job_id' => $job_id, 'status' => 'shortlist'])}}"><div id="shortlist" class="list_all">Shortlisted ({{$shortisted_candidate}}) </div></a>
          <a href="{{route('managecandidate',['job_id' => $job_id, 'status' => 'interview_invite'])}}"><div id="interview_invite" class="list_all">Interview ({{$interview_candidate}}) </div></a>
          <a href="{{route('managecandidate',['job_id' => $job_id, 'status' => 'not_suitable'])}}"><div id="not_suitable" class="list_all">Not Relevant ({{$notsuitable_candidate}}) </div></a>
        </div>               
      </div>
     
     
     @foreach ($candidate_details as $detail)     
     <div class="home_box">
        <div class="home_boxcontainer">
          <div class="home_titlebox">
              <div class="home_title">                
                @if(isset($detail->work))                                
                 @foreach ($detail->work as $work)                  
                    <div>{{$work->position}} ({{$work->total_years}}) </div>
                  @endforeach
                 @endif                 
              </div>  
              @if(isset($detail->education))
                @foreach ($detail->education as $edu)
                  <div>{{$edu->degree}} , {{$edu->school_name}}</div>
                @endforeach
                @endif
          </div>  
          <div class="home_controlbox">                                
                {{$detail->core_skills_text}}
                <label style="float:right;"> <b>Total Work Experience:</b> {{$detail->total_years}}</label><br>
                {{$detail->about_myself}}
                <label style="float:right;"><b>Expected Salary :</b> {{$detail->prefered_salary_currency}} {{$detail->prefered_salary}}</label>&nbsp;                            
          </div>                        
          </div>   
          <div class="home_statusbox">
            <div class="home_postcontrols">
              <div class="home_current">
                 Published on 
                 &nbsp; –
              </div>
           </div>            
               @if($detail->resume_downloaded > 0)                                
                  <div class="home_actions">Resume Downloaded</div>                   
               @else
                  <a href="" onclick="downloadresume('{{route('downloadresume')}}' , '{{$detail->candidate_profile_id}}', '{{$detail->account_id}}', '{{$job_id}}', this);return false;">
                    <div class="home_actions">Download Resume</div>
                 </a>
               @endif  
                 <div class="home_dots">•</div>
                 <a href="javascript:confirmAction('{{route('processcandidate',['id' => $detail->candidate_application_id, 'emp_status' => 'interview_invite', 'mode' => 'employer'])}}' , 'Invite this Candidate for Interview')">
                    <div class="home_actions">Interview Invite</div>
                 </a>
                 <div class="home_dots">•</div>
                 <a href="javascript:confirmAction('{{route('processcandidate',['id' => $detail->candidate_application_id, 'emp_status' => 'not_suitable', 'mode' => 'employer'])}}' , 'move this Candidate to not suitable list')">
                    <div class="home_actions">Not Suitable</div>
                 </a>
                 <div class="home_dots">•</div>
                 <a href="javascript:confirmAction('{{route('processcandidate',['id' => $detail->candidate_application_id, 'emp_status' => 'shortlist', 'mode' => 'employer'])}}' , 'shortlist this Candidate')">
                    <div class="home_actions">Shortlist</div>
                 </a> 
                
          </div> 
          </div>                   
     @endforeach     
     <div class="pagination"></div>
     </div>     
    </section>
  </div>

@stop
@section('scripts')
<script>
    
  $('.header_filter_tab').find('div').removeClass( "list_allon" );
  var curr_status = '<?php echo $emp_status ? $emp_status : "new";?>';
  $('#'+curr_status).addClass('list_allon');
</script>
@stop