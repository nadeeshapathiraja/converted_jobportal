
<!DOCTYPE html>
<html class="no-js">     {!! HTML::style('css/bootstrap.min.css') !!}
<body>
<div class="col-sm-12">
<div >  
  <h2>{{$userprofile->firstname}} {{$userprofile->lastname}} </h2> 

  
  <p><b>Email: </b>{{$email}} <b>Mobile No: </b> {{$userprofile->mobile}} <b>Address: </b> {{$userprofile->city}} {{$userprofile->state}} {{$userprofile->zipcode}} {{$userprofile->country}}</p>
  @if($userprofile->about_myself)
  <p>Summary about myself : {{$userprofile->about_myself}} </p>
  @endif
  @if($core_skills_list)
  <p><b>Core Skills :</b> {{$core_skills_list}} </p>
  @endif
  <div style="text-align: left">    
  	  <h3>Work Experience</h3>        
  	<?php 	
    //var_dump($workexp);
  		foreach ($workexp as $k => $value) {   ?>             
          <div class="well">            
            <h5> {{$value->employername}}  ({{$value->city}}, {{$value->country}})               
            </h5>             
            <span style="float:right;">{{ date('F,Y', strtotime($value->start_date))}} - {{ ($value->still_working =='N')? date('F,Y', strtotime($value->end_date)) : 'Present' }}</span>
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
      <h3>Education </h3>    
     <?php  
    //var_dump($education);
      foreach ($education as $k => $value) {   ?>  
            <div class="well">                                   
            <h5> {{$value->school_name}}  ({{$value->city}}, {{$value->country}})                
            </h5>             
            <span style="float:right;">{{ date('F,Y', strtotime($value->enrolldate))}} - {{ ($value->still_studying =='N')? date('F,Y', strtotime($value->grad_date)) : 'Yet to Graduted' }}</span>
            <hr>   
            <p>{{$value->degree}}</p>
      <?php   
        foreach ($value->additionalskills as $key => $val) { ?>
        <ul>
          <li>{{$val->content}}</li>
        </ul>
            
      <?php } ?>
      </div>
        <?php } ?>    
      <h3>Additional Skills </h3>    
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
</body>
</html>



<style>

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
body{
  background: none!important;
}
</style>
