@extends('include.template')

@section('main')
<div class="col-sm-12">
<div class="profilecontainer">
  <div class="avatar-flip">
    @if($userprofile->profile_picture)
    <img src='<?php echo env("AS3_URL").env("AS3_bucket")."/"; ?>{{$userprofile->profile_picture}}' height="150" width="150">
    <img src='<?php echo env("AS3_URL").env("AS3_bucket")."/"; ?>{{$userprofile->profile_picture}}' height="150" width="150">
    @else
    <img src="{{URL::asset('img/preview.jpg')}}" height="150" width="150">
    <img src="{{URL::asset('img/preview.jpg')}}" height="150" width="150">
    @endif
  </div>
  
  <div class="edit_hover_class">   
  <h2>{{$userprofile->firstname}} {{$userprofile->lastname}} &nbsp; <a class="editnavbar" action-tab="#tab_contact" href="{{route('candidateprofile', ['mode' =>'edit'])}}"><span class="glyphicon glyphicon-pencil"></span></a></h2> 
  </div>
  
  <p>{{$email}} || {{$userprofile->mobile}} <span class="glyphicon glyphicon-earphone"></span>|| {{$userprofile->city}} {{$userprofile->state}} {{$userprofile->zipcode}} {{$userprofile->country}}</p>
  @if($userprofile->about_myself)
  <p>Summary about myself : {{$userprofile->about_myself}} </p>
  @endif
  @if($core_skills_list)
  <p><b>Core Skills :</b> {{$core_skills_list}} </p>
  @endif
  <div style="text-align: left">
    <div class="edit_hover_class">   
  	  <h3>Work Experience &nbsp;<a class="editnavbar" action-tab="#tab_work" href="{{route('candidateprofile', ['mode' =>'edit'])}}"><span class="glyphicon glyphicon-pencil"></span></a> </h3>    
    </div>
  	<?php 	
    //var_dump($workexp);
  		foreach ($workexp as $k => $value) {   ?>             
          <div class="well">
            <div class="edit_hover_class">
            <h5> {{$value->employername}}  ({{$value->city}}, {{$value->country}}) <a id='loadempdata{{$k}}' class="editnavbar" action-tab="#tab_work" href="{{route('candidateprofile', ['mode' =>'edit'])}}"> <span class="glyphicon glyphicon-pencil"></span> </a> 
              <span style="float:right;">{{ date('F,Y', strtotime($value->start_date))}} - {{ ($value->still_working =='N')? date('F,Y', strtotime($value->end_date)) : 'Present' }}</span>
            </h5> 
            </div>
            <hr>
            <p>{{$value->position}}</p>
        <?php   
  			foreach ($value->additionalskills as $key => $val) { ?>
        <ul>
          <li>{{$val->content}}</li>
        </ul>
  					
      <?php      
  			}
        ?>
      </div>
        <?php } ?> 
    <div class="edit_hover_class">       
      <h3>Education &nbsp; <a class ="editnavbar" action-tab="#tab_school" href="{{route('candidateprofile', ['mode' =>'edit'])}}"><span class="glyphicon glyphicon-pencil"></span></a> </h3>
    </div>
     <?php  
    //var_dump($education);
      foreach ($education as $k => $value) {   ?>  
            <div class="well">                       
            <div class="edit_hover_class">
            <h5> {{$value->school_name}}  ({{$value->city}}, {{$value->country}}) <a id='loadeducationdata{{$k}}' class ="editnavbar" action-tab="#tab_school" href="{{route('candidateprofile', ['mode' =>'edit'])}}"> <span class="glyphicon glyphicon-pencil"></span> </a> 
              <span style="float:right;">{{ date('F,Y', strtotime($value->enrolldate))}} - {{ ($value->still_studying =='N')? date('F,Y', strtotime($value->grad_date)) : 'Yet to Graduted' }}</span>
            </h5> 
            </div>     
            <hr>   
            <p>{{ (isset($degree[$value->degree]) && $value->degree != '' )? $degree[$value->degree] : ''}}</p>
      <?php   
        foreach ($value->additionalskills as $key => $val) { ?>
        <ul>
          <li>{{$val->content}}</li>
        </ul>
            
      <?php } ?>
      </div>
        <?php } ?>
    <div class="edit_hover_class">   
      <h3>Additional Skills &nbsp;<a class ="editnavbar" action-tab="#tab_addskill" href="{{route('candidateprofile', ['mode' =>'edit'])}}"><span class="glyphicon glyphicon-pencil"></span></a> </h3>
    </div>
    <?php
    //var_dump($additionalskill); 
      foreach ($additionalskill as $key => $val) { ?>
          <ul>
            <li>{{$val->content}}</li>
          </ul>
              
      <?php      
        }
    ?>
  </div>
</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
  $( ".editnavbar" ).on( "click", function(e) {     
    sessionStorage.setItem('current_tab', $(this).attr('action-tab'));
    sessionStorage.setItem('loadid',$(this).attr('id'));
  });
</script>

<style>
@import url(http://fonts.googleapis.com/css?family=Roboto:900,300);

.edit_hover_class a{
visibility:hidden;
}
.edit_hover_class:hover a {
 visibility:visible;
}
.profilecontainer {

  margin: 120px auto 120px;
  background-color: #fff;
  padding: 0 20px 20px;
  border-radius: 6px;
  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.075);
  -webkit-box-shadow: 0 2px 5px rgba(0,0,0,0.075);
  -moz-box-shadow: 0 2px 5px rgba(0,0,0,0.075);
  text-align: center;
}
.profilecontainer:hover .avatar-flip {
  transform: rotateY(180deg);
  -webkit-transform: rotateY(180deg);
}
.profilecontainer:hover .avatar-flip img:first-child {
  opacity: 0;
}
.profilecontainer:hover .avatar-flip img:last-child {
  opacity: 1;
}
.avatar-flip {
  border-radius: 100px;
  overflow: hidden;
  height: 150px;
  width: 150px;
  position: relative;
  margin: auto;
  top: -60px;
  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  box-shadow: 0 0 0 13px #f0f0f0;
  -webkit-box-shadow: 0 0 0 13px #f0f0f0;
  -moz-box-shadow: 0 0 0 13px #f0f0f0;
}
.avatar-flip img {
  position: absolute;
  left: 0;
  top: 0;
  border-radius: 100px;
  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
}
.avatar-flip img:first-child {
  z-index: 1;
}
.avatar-flip img:last-child {
  z-index: 0;
  transform: rotateY(180deg);
  -webkit-transform: rotateY(180deg);
  opacity: 0;
}
h2 {
  font-size: 32px;
  font-weight: 600;
  margin-bottom: 15px;
  color: #333;
}
h4 {
  font-size: 13px;
  color: #00baff;
  letter-spacing: 1px;
  margin-bottom: 25px
}
h5{
  /*background: beige;*/
  font-size: 18px;
}
h3{
  background: #b3d8f9;  
}
p {
  font-size: 16px;
  line-height: 26px;
  margin-bottom: 20px;
  color: #666;
}
hr{
  border-top: 1px solid #8c8b8b;
  margin: 0px;
  max-width: 100%
}
.well{
  margin-bottom: 10px;
}
</style>
@stop