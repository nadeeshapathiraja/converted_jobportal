@extends('include.employer.maintemplate')
@include('include.employer.mainheader')
@include('include.employer.topactionbar')

@section('main')    
  <div >
  <section class="box">  
     <div class="home_bar">        
       <h1>
          Talent Search
       </h1>                
     </div>
      <div id="header-wrapper">
          <div class="container">
          <form method="GET" action="{{ route('talentsearch') }}" accept-charset="UTF-8" id="seek" name="seek">  
            <div class="row 200%">
              <div class="3u 12u$(medium)">
                  <label for="type">Qualification</label>
                  {!! Form::select('qualification', $qualification, null, ['class' => 'signup_select']) !!}
              </div>
              <div class="3u 12u$(medium) important(medium)">
                  <label for="type">Experience</label>
                  {!! Form::select('experience', $experience, $search['experience'], ['class' => 'signup_select']) !!}
              </div>
              <div class="3u 12u$(medium)">
                  <label for="type">Expected Salary</label>
                  <div style="display: inline-block;;">
                  {!! Form::select('salary_currency', $currency, $search['salary_currency'], ['id'=>'currency_min' ,'class' => 'signup_select', 'style' => 'width:40%;margin-right:2px', 'id' => 'salary_currency']) !!}
                  {!! Form::text('expected_salary', $search['expected_salary'], ['style' => 'width:60%;float:right;']) !!}
                  </div>
              </div>

              <div class="3u 12u$(medium) important(medium)">
                  <label for="type">Country of residence</label>
                  {!! Form::select('country', $country, $search['country'], ['class' => 'signup_select']) !!}
              </div>
            </div>
            <div class="row 200%">              
              <div class="3u 12u$(medium) important(medium)">
                  {!! Form::label('job_type', 'Job Type', ['class'=>'control-label']) !!}
                  {!! Form::select('job_type', $job_type, $search['job_type'], ['class' => 'signup_select']) !!}
              </div>
              <div class="6u 12u$(medium)">
                  {!! Form::label('title', 'Skills', ['class'=>'control-label']) !!}   
                  {!! Form::select('skills[]', array(), null, ['class' => 'multiple-core-skill', 'multiple' => 'multiple']) !!}                  
              </div>
              <div class="3u 12u$(medium) important(medium)">
                  <button type="submit" class="btn btn-primary">Search</button>
              </div>
            </div>
            </form>
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
                 Talent search Ratings  
                 &nbsp;  {{$detail->match_rating}}
              </div>
           </div>            
               @if($detail->resume_downloaded > 0)                                
                  <div class="home_actions">Resume Downloaded</div>                   
               @else
                  <a href="" onclick="downloadresume('{{route('downloadresume')}}' , '{{$detail->candidate_profile_id}}', '{{$detail->account_id}}', null, this);return false;">
                    <div class="home_actions">Download Resume</div>
                 </a>
               @endif                                   
          </div> 
        </div>                      
     @endforeach      

    </section>
  </div>
@stop
@section('scripts')
<script>      
      $(document).ready(function() {   
      var skills = JSON.parse('<?php echo $search["skills"]; ?>');
      var studentSelect = $('.multiple-core-skill');
      $('#core_skills').empty();
      for(var key in skills){     
        $.ajax({
            type: 'GET',
            url: '<?php echo URL::to("/autocomplete/core_skill/") ?>' + '/' + skills[key]
        }).then(function (data) {
            // create the option and append to Select2
            data = data.items[0];
            var option = new Option(data.text, data.id, true, true);
            studentSelect.append(option).trigger('change');

            // manually trigger the `select2:select` event
            studentSelect.trigger({
                type: 'select2:select',
                params: {
                    data: data
                }
            });
        });
      }

          $(".multiple-core-skill").select2({
            ajax: {
              url: '<?php echo URL::to("/autocomplete/core_skill/") ?>',
              dataType: 'json',
              delay: 250,
              data: function (params) {
                return {
                  keyword: params.term, // search term
                  page: params.page
                };
              },
              processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                  results: data.items,
                  pagination: {
                    more: (params.page * 30) < data.total_count
                  }
                };
              },
              cache: true
            },
            placeholder: 'Search for a Skills',
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 2,
          });
          
      });
</script>
@stop      