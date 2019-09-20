@extends('include.employer.maintemplate')
@include('include.employer.mainheader')
@include('include.employer.topactionbar')

@section('main')    
  <div >
  <section class="box">
    <div class="main_container">    
     <div class="home_bar">        
       <h1>
          <a href="">
          {{$mode}}
          ({{count($post_details)}})
          </a>
       </h1>                
     </div>
     <!--
     <div style="display:block;">
        <div class="top_searchbox">
           <form method="GET" action="https://www.jobstore.com/employer/candidate" accept-charset="UTF-8">
              <input class="home_searchpost" placeholder="Search candidates by position..." name="position" type="text" value="">
              <input class="home_searchsubmit" type="submit" value="Search">
           </form>
        </div>
        <div class="top_adminbox">
           <div class="home_filtertitle">Filter by job poster: </div>
           <select name="filter" class="home_filterpost" id="filter">
              <option name="" class="permission_select" disabled="disabled" selected="selected">Select a person to filter by</option>
              <option name="" value="346731">whatever</option>
           </select>
           <script>
              $(function(){
                $('#filter').on('change', function () {
                  var id = $(this).val();
                  var url = "https://www.jobstore.com/employer/home"+"?filter=draft&member="+id;
                  if (id){
                    window.location = url;
                  }
                  return false;
                });
              });
              
           </script>
           <a href="https://www.jobstore.com/employer/home?filter=active">
              <div class="home_filterremove">
                 See all jobs
              </div>
           </a>
        </div>
     </div> -->
     
     @foreach ($post_details as $detail)
     <div class="home_box">
        <div class="home_boxcontainer">
           <div class="home_titlebox">
              <div class="home_title">
                 <a href="{{URL::to('/post/'.$detail->jobpost_id.'/'.$detail->job_title)}}">{{$detail->job_title}}</a>
              </div>              
           </div>
           @if($mode == 'POSTED')
           <div class="home_controlbox">
              <a href="{{route('managecandidate', [$detail->jobpost_id])}}">
                 <div class="home_controlsreview">
                    <div class="home_controlvalues">
                       <div class="home_count">{{$detail->candidate_applied}} New </div>                       
                    </div>
                 </div>
              </a>
              <a href="{{route('managecandidate', [$detail->jobpost_id, 'shortlist'])}}">
                 <div class="home_controlsreview">
                    <div class="home_controlvalues">
                       <div class="home_count">{{$detail->shortisted_candidate}} Shortlisted </div>                       
                    </div>
                 </div>
              </a>
              <a href="{{route('managecandidate', [$detail->jobpost_id,'interview_invite'])}}">
                 <div class="home_controlsreview">
                    <div class="home_controlvalues">
                       <div class="home_count">{{$detail->interview_candidate}} Interview </div>                       
                    </div>
                 </div>
              </a>                            
              <a href="{{route('managecandidate', [$detail->jobpost_id, 'not_suitable'])}}">
                 <div class="home_controlsreview">
                    <div class="home_controlvalues">
                       <div class="home_count">{{$detail->notsuitable_candidate}} Irrelevant </div>                       
                    </div>
                 </div>
              </a>                            
           </div>
           @endif
        </div>            
        <div class="home_statusbox">
           <div class="home_draft">{{$detail->status}}</div>
           <div class="home_postcontrols">
              <div class="home_current">
                 Published on {{$detail->posted_at}}
                 &nbsp; –
              </div>
              <div class="home_current">
                 Updated on {{date_format(date_create($detail->updated_at),"F j, Y")}} 
              </div>
              <div class="home_expiry"></div>
           </div>
           <a href="javascript:confirmDelete('{{URL::to('/employer/deletepost/'.$detail->jobpost_id)}}')">
              <div class="home_actions">
                 Terminate
              </div>
           </a>
           <script>
              function confirmDelete(delUrl) {
                if (confirm("Are you sure you want to terminate this posting?")) {
                  document.location = delUrl;
                }
              }
           </script>
           <div class="home_dots">•</div>
           <a href="{{URL::to('/post/'.$detail->jobpost_id.'/'.$detail->job_title)}}" target="_blank">
              <div class="home_actions">
                 Post Job
              </div>
           </a>
           <div class="home_dots">•</div>
           <a href="{{route('editpost',[$detail->jobpost_id])}}">
              <div class="home_actions">
                 Edit
              </div>
           </a>
           <div class="home_dots">•</div>
           <a href="#">
              <div class="home_actions">
                 Copy Post
              </div>
           </a>
        </div>
        <div class="pagination"></div>
     </div>
     @endforeach     
    </div>
    </section>
  </div>

@stop