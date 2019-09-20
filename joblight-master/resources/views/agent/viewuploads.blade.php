@extends('include.global_template')
@include('include.agent.mainheader')
@section('main')
<div id="feature-wrapper">       
    @if(count($refered_data) > 0)
    <div class="container">
        <div class="row 200%">
            <div class="12u 12u$(medium) important(medium)">                
                <ul class="breadcrumb">
                    <li><a href="{{ route('agenthome') }}">Home</a></li>  
                    <li><a href="{{ route('referapplicant',['applicant']) }}">Referral</a></li>
                    <li>{{$title}}</li>                                      
                </ul>                
            </div> 
            <div class="10u 12u$(medium) important(medium)">
                <div class="box">
                {!! Form::open(['route' => 'resendinvite', 'method' => 'post', 'id'=>'form']) !!}
                  <h3>Past Referrals to JobKonner</h3>
                    <div class="12u 12u(medium)" align="right" style="padding-bottom:10px;">                                                   
                        <button type="submit" class="button alt icon fa-send btn-primary">ReSend</button>                             
                    </div>                  
                  <table class="default">
                    <thead>
                      <th><input id='toggleCheck' type="checkbox" value="0"/></th>
                      <th>Invited Candidate</th>
                      <th>Invite Status</th>
                      <th>Resume Downloaded</th>
                      <th>Resent Count</th>
                    </thead>
                    @foreach ($refered_data as $detail)
                      <tr>
                        <th><input name="referral[]" type="checkbox" class="referral_checkbox" value="{{$detail->referral_id}}" {{($detail->referral_status == 'invited')? '' : 'disabled' }}/></th>
                        <th>{{$detail->referral_email}}</th>
                        <td>{{ ($detail->referral_status == 'completed')? 'Joined JobKonner' : ucwords($detail->referral_status) }}</td>
                        <td>{{$detail->resume_downloads}}</td>
                        <td>{{$detail->resent_count}}</td>
                      </tr>  
                    @endforeach
                  </table>
                {!! Form::close() !!}  
                </div>
            </div>
        </div>
    </div>  
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
  
  $("#toggleCheck").change(function() {
    if(this.checked) {
        $('.referral_checkbox:not(:disabled)').prop('checked', true);
    }else{
        $('.referral_checkbox:not(:disabled)').prop('checked', false);
    }
});
</script>
@stop