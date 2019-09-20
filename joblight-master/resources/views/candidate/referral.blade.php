@extends('include.global_template')
@if(Session::get('user.login_type') == 'agent')    
@include('include.agent.mainheader')
@else
@include('include.candidate.mainheader')
@endif
@section('main')
<div id="feature-wrapper">
    <div class="container">
        <div class="row 200%">
            <div class="12u 12u$(medium) important(medium)">
                @if(Session::get('user.login_type') == 'agent')                
                                    
                @else
                <ul class="breadcrumb">
                    <li><a href="{{ route('candidatehome') }}">Home</a></li>  
                    <li><a href="#">Refer</a></li>                                      
                </ul>
                @endif   
            </div>                        
            <div class="10u 12u(medium)" style="padding-top:10px;">     
            {!! Form::open(['route' => 'sendinvite', 'method' => 'post', 'id'=>'form']) !!}     
            {!! Form::hidden('jobpost_id',$id) !!}
            {!! Form::hidden('mode',$mode) !!}         
        			<div class="box">
                <h3>{{$title}}</h3>
                <div class="10u 12u(medium)" style="padding-top:10px;">                                      
                    <span>Enter email address {{$sub_title}} [Seperate multiple emails using <b>;</b> ]</span>   
                    <input id="candidate_email" name="candidate_email" required="required">                                          
                </div>
                @if(Session::get('user.login_type') == 'agent')
                <div class="10u 12u(medium)" align="right" style="padding-top:10px;">
                    {!! Form::file('importExcel', ['id' => 'importExcel']); !!}
                    {!! Form::submit( 'Load form excel', ['class' => 'button alt icon fa-upload btn-primary', 'id' => 'btn-read-excel'] ) !!}
                </div>
                @endif
                <div class="10u 12u(medium)" style="padding-top:10px;">                               
                    <textarea id="message" name="message" placeholder="Optional Message" class="12u 12u(medium)"></textarea>                                    
                </div>
                <div class="10u 12u(medium)" align="right" style="padding-top:10px;">                                                   
                    <button type="submit" class="button alt icon fa-send btn-primary">{{$caption}}</button>                             
                </div>
              </div> 
              {!! Form::close() !!}
            </div>      
        </div>
    </div>

    @if(Session::get('user.login_type') == 'agent')
        @if(count($agent_referal) > 0)
        <div class="container">
            <div class="row 200%">
                <div class="10u 12u$(medium) important(medium)">
                    <div class="box">
                      <h3>Past Uploads to JobKonner</h3>
                      <table class="default">
                        <thead>
                          <th>Date</th>
                          <th>File Name</th>
                          <th>Applicant Count</th>
                        </thead>
                        @foreach ($agent_referal as $detail)
                          <tr>
                            <th>{{$detail->created_at}}</th>
                            <td><a href="{{route('viewuploads',[$detail->agent_referral_id, $detail->document_name])}}">{{$detail->document_name}}</a></td>
                            <td>{{$detail->applicant_count}}</td>
                          </tr>  
                        @endforeach
                      </table>
                    </div>
                </div>
            </div>
        </div>  
        @endif 
    @else    
        @if(count($refered_data) > 0)
        <div class="container">
            <div class="row 200%">
                <div class="10u 12u$(medium) important(medium)">
                    <div class="box">
                      <h3>Past Referrals to JobKonner</h3>
                      <table class="default">
                        <thead>
                          <th>Invited Candidate</th>
                          <th>Invite Status</th>
                          <th>Resume Downloaded</th>
                        </thead>
                        @foreach ($refered_data as $detail)
                          <tr>
                            <th>{{$detail->referral_email}}</th>
                            <td>{{ ($detail->referral_status == 'completed')? 'Joined JobKonner' : ucwords($detail->referral_status) }}</td>
                            <td>{{$detail->resume_downloads}}</td>
                          </tr>  
                        @endforeach
                      </table>
                    </div>
                </div>
            </div>
        </div>  
        @endif    
    @endif        
</div>    
@stop
@section('scripts')
<script>
  $("#candidate_email").tagsInput({    
    'height':'100px',
    'width':'100%',
    'defaultText' : '',
    'delimiter': [';']
  });

  $('#btn-read-excel').on('click', function(e) {
    e.preventDefault();
    var file_data = $('#importExcel').prop('files')[0];   
    if(file_data){
        var form_data = new FormData();                  
        form_data.append('file', file_data);                            
        $.ajax({
                    url: '<?php echo route("import.excel") ?>',
                    dataType: 'text',  // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,                         
                    type: 'post',
                    success: function(php_script_response){                        
                        $("#candidate_email").importTags(php_script_response);
                    }
         });
    }
});
</script>
@stop