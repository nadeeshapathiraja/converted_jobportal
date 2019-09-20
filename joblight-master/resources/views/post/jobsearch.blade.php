@extends('include.global_template')
@if(Session::get('user.login_type') == 'candidate') 
    @include('include.candidate.mainheader')
@else
    @include('include.candidate.guest_header')
@endif 
@section('main')
@if(!$mode)
<div id="feature-wrapper">
  <div class="row 200%">
    <div class="12u 12u$(medium) important(medium)">
      <form method="GET" action="{{ route('jobsearch') }}" accept-charset="UTF-8" id="seek" name="seek">     

        <div class="container">
            <div class="row 200%">
                <div class="12u 12u$(medium) important(medium)" style="padding-top:0px;">             
                   <div class="header_search" style="display:inline-block;width:74%;height:80px;line-height:80px;margin:0;float:center;">              
                         <input class="header_keyword" style="display:inline-block;width:50%;" placeholder="Job Title, Keywords or Company Name" name="keyword" id="search_keyword" type="text" value="">
                         <input class="header_location" style="display:inline-block;width:40%;" placeholder="Location or City" name="location" id="search_location" type="text" value="">
                         <input name="sort" id="sort" type="hidden" value="featured">
                         <input name="category" id="category" type="hidden">
                         <input name="type" id="type" type="hidden">
                         <input name="level" id="level" type="hidden">
                         <input name="since" id="since" type="hidden">                  
                         <button class="btn btn-small btn-primary job-search" type="submit"><i class="fa fa-search"></i></button>
                      
                   </div>            
                </div>
            </div>
        </div> 

        <div class="search_filter">
           <div class="search_header_filter">
              <ul class="category">
                 <li id="iosClick1">
                    <span class="dropdown_title search_filter_tag" default-title="Job Classification">Categories</span>
                    <div class="dropdown_body">
                       <div class="category_column">
                          <ul>
                            @foreach ($job_category as $key => $value)                        
                                <li>
                                    <div id="category_{{$key}}" class="searchbar_element">{{$value}}</div>
                                </li>
                            @endforeach                     
                          </ul>
                       </div>
                    </div>
                 </li>
              </ul>
              <ul class="type">
                 <li id="iosClick2">
                    <span class="dropdown_title search_filter_tag" default-title="Job Type">Work Type</span>
                    <div class="dropdown_body">
                       <div class="type_column">
                          <ul>
                            @foreach ($job_type as $key => $value)                        
                                <li>
                                    <div id="type_{{$key}}" class="searchbar_element">{{$value}}</div>
                                </li>
                            @endforeach                     
                          </ul>
                       </div>
                    </div>
                 </li>
              </ul>
              <ul class="level">
                 <li id="iosClick3">
                    <!-- <span class="search_filter_tag">Job Level</span> -->
                    <span class="dropdown_title search_filter_tag" default-title="Work Level">Work Level</span>            
                    <div class="dropdown_body">
                       <div class="level_column">
                          <ul>
                            @foreach ($job_level as $key => $value)                        
                                <li>
                                    <div id="level_{{$key}}" class="searchbar_element">{{$value}}</div>
                                </li>
                            @endforeach                                        
                          </ul>
                       </div>
                    </div>
                 </li>
              </ul>
              <ul class="since">
                 <li id="iosClick4">
                    <span class="dropdown_title search_filter_tag" default-title="Date Listed" selected-id="">Date Listed</span>
                    <div class="dropdown_body">
                       <div class="since_column">
                        <ul>
                            @foreach ($job_since as $key => $value)                        
                                <li>
                                    <div id="type_{{$key}}" class="searchbar_element">{{$value}}</div>
                                </li>
                            @endforeach                     
                          </ul>                  
                       </div>
                    </div>
                 </li>
              </ul>
              <!--
              <ul class="rank">
                 <li id="iosClick5">
                    <span class="search_filter_tag">Employer Type</span>
                    <div>
                       <div class="rank_column">
                          <ul>
                             <li>
                                <a href="#">Recruitment Agency</a>
                             </li>
                             <li>
                                <a href="#">Direct Employer</a>
                             </li>
                          </ul>
                       </div>
                    </div>
                 </li>
              </ul> -->
           </div>
        </div>

      </form>
    </div>
  </div>
</div>
@endif

<div id="feature-wrapper">
    <div class="container">
        <div class="row 200%">
          @if($mode)
              <div class="12u 12u$(medium) important(medium)">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>   
                    <li><a href="#">{{$mode}} jobs</a></li>                                      
                </ul>   
            </div> 
            @endif
            <div class="10u 12u$(medium) important(medium)" style="padding-top:10px;">
                <div class="box">
                    @foreach ($post_details as $detail)
                     <div class="search_box">
                        <div class="search_boxcontainer">                                                        
                            <span class="resultperiod">{{date_diff(new DateTime("now"), date_create($detail->posted_at))->format('%a')}}d ago</span>
                            <h1 class="resulttitle">
                                <a href="{{URL::to('/post/'.$detail->jobpost_id.'/'.$detail->job_title)}}" class="resulttitle_a" target="_self">
                                    {{$detail->job_title}}
                                </a>
                            </h1>
                            <p class="resultcompany"><span data-automation="jobAdvertiser">{{$detail->company_name}}</span></p>


                            <div class="resultdetail">
                               <div class="resultdetail_left">
                                  <div class="resultdescription"> <?= substr($detail->job_description, 0, 200); ?>  ...</div>
                                  <div>
                                     <div class="resultattributes_div">
                                        <p class="resultsubentry">
                                           <span><a href="#" class="resultlinks" target="_self">{{$detail->job_category}}</a></span>
                                           <!-- 
                                           <span>
                                              <i class="fa fa-angle-right" aria-hidden="true"></i>
                                              <span><a href="#" class="_1hfdS4d" target="_self">Digital &amp; Search Marketing</a></span>
                                           </span> 
                                            -->
                                        </p>
                                     </div>
                                     <div>
                                        <a href="javascript:shortlist({{$detail->jobpost_id}})" id="save_job_{{$detail->jobpost_id}}" class="resultlinks">
                                           <i id="markfavi_{{$detail->jobpost_id}}" class="fa {{!empty($detail->candidate_saved_application_id) ? 'fa-star' : 'fa-star-o'}}" aria-hidden="true"></i>
                                           <span class="resultsave">Save</span>
                                        </a>
                                        @if(isset($detail->candidate_applications_status))
                                        <span class="resultstatus">Status: {{$detail->candidate_applications_status}}</span>
                                        @endif
                                     </div>
                                  </div>
                               </div>
                               <div class="resultdetail_right">
                                  <div class="resultlocation">                                     
                                    <div> 
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>                                      
                                        <a href="#" class="resultlinks" target="_self">{{$detail->job_city}}</a>
                                    </div>
                                    <div> 
                                        <i class="fa fa-usd" aria-hidden="true"></i>                                     
                                        <a href="#" class="resultlinks" target="_self">{{$detail->salary_currency}}&nbsp;{{$detail->salary_min}}&nbsp;-&nbsp;{{$detail->salary_max}}</a>
                                    </div>
                                    @if($detail->job_level)
                                    <div> 
                                        <i class="fa fa-black-tie" aria-hidden="true"></i>
                                        <a href="#" class="resultlinks" target="_self">{{$detail->job_level}}</a>
                                    </div>
                                    @endif
                                    @if($detail->job_type)
                                    <div> 
                                        <i class="fa fa-hourglass-half" aria-hidden="true"></i>
                                        <a href="#" class="resultlinks" target="_self">{{$detail->job_type}}</a>
                                    </div>
                                    @endif
                                    <p></p>
                                  </div>                                
                                  <img class="_1RWfvxc" data-automation="jobLogo" src="/logos/Jobseeker/Thumbnail/170954.JPG" alt="Company logo" aria-hidden="true">
                               </div>
                            </div>
                        </div>                    
                     </div>
                     @endforeach 
                     @if(count($post_details) <= 0)
                        <span>No Jobs found</span>
                     @endif
                </div>
            </div>
            <div class="2u 12u$(medium)">
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<style type="text/css">
ul,menu,dir{display:block;list-style-type:none;-webkit-margin-before:0;-webkit-margin-after:0;-webkit-margin-start:0;-webkit-margin-end:0;-webkit-padding-start:0;margin:0;padding:0;}ul li{list-style-type:none;}.search_filter{display:block;width:auto;height:35px;padding:0 0 5px;background:#f5f5f5;}.search_header_filter{display:block;width:960px;height:35px;line-height:35px;margin:0 auto;}
.search_filter_tag{display:inline-block;width:auto;height:35px;line-height:35px;padding:0 25px 0 0;font-size:13px;color:#666;background:url(https://asset.jobstore.com/images/arrow_down_light_blue.png) no-repeat center right 5px/11px;cursor:pointer;}
.search_filter_selected{display:inline-block;width:auto;height:35px;line-height:35px;padding:0;font-size:13px;color:#666;}
.search_filter_remove{display:inline-block;font-size:13px;color:#f00;font-family:'Verdana';margin-left:5px;text-decoration:none !important;}
.search_filter_remove:hover{outline:none;color:#c00;cursor: pointer;}
.filter{display:inline-block;width:auto;height:35px;line-height:35px;font-size:13px;font-weight:600;color:#333;position:relative;z-index:500;margin:0 15px 0 5px;vertical-align:top;}
.category{display:inline-block;width:auto;height:35px;line-height:35px;z-index:500;position:relative;margin-right:15px;vertical-align:top;}
.category_column ul{display:flex;flex-direction:column;flex-wrap:wrap;height:360px;width:510px;}
.category>li>div{position:absolute;displaliy:block;width:510px;top:35px;left:-5px;opacity:0;visibility:hidden;overflow:hidden;border:1px solid #ccc;background:#fff;border-radius:2px;padding:25px;z-index:1;-webkit-box-shadow:0px 0px 5px 0px rgba(170,170,170,0.15);box-shadow:0px 0px 5px 0px rgba(170,170,170,0.15);}
.category>li:hover>div,.category>li:focus>div{opacity:1;visibility:visible;overflow:visible;z-index:1;}
.category .category_column{display:inline-block;width:100%;z-index:1;}
.category .category_column li{list-style:none;display:inline-block;width:48%;height:30px;line-height:30px;font-size:13px;z-index:1;vertical-align:top;margin:0;padding:0;overflow:hidden;}

 .searchbar_element{color:#448aff;margin:0;padding:0; text-decoration:none !important;}
 .searchbar_element:hover{color:#333;cursor: pointer;}
 .category_selected{color:#333;z-index:1;}

.type{display:inline-block;width:auto;height:35px;line-height:35px;z-index:500;position:relative;margin-right:15px;vertical-align:top;}.type>li>div{position:absolute;display:block;width:160px;top:35px;left:-2px;opacity:0;visibility:hidden;overflow:hidden;border:1px solid #ccc;background:#fff;border-radius:2px;padding:15px 25px;z-index:1;-webkit-box-shadow:0px 0px 5px 0px rgba(170,170,170,0.15);box-shadow:0px 0px 5px 0px rgba(170,170,170,0.15);}.type>li:hover>div,.type>li:focus>div{opacity:1;visibility:visible;overflow:visible;z-index:1;}.type .type_column{display:inline-block;width:100%;z-index:1;}.type .type_column li{list-style:none;display:inline-block;width:100%;height:30px;line-height:30px;font-size:13px;z-index:1;vertical-align:top;overflow:hidden;}.type .type_column li a{color:#448aff;}.type .type_column li a:hover{color:#333;}.type .type_selected{color:#333;z-index:1;}
.level{display:inline-block;width:auto;height:35px;line-height:35px;z-index:500;position:relative;margin-right:15px;vertical-align:top;}.level>li>div{position:absolute;display:block;width:170px;top:35px;left:-2px;opacity:0;visibility:hidden;overflow:hidden;border:1px solid #ccc;background:#fff;border-radius:2px;padding:15px 25px;z-index:1;-webkit-box-shadow:0px 0px 5px 0px rgba(170,170,170,0.15);box-shadow:0px 0px 5px 0px rgba(170,170,170,0.15);}.level>li:hover>div,.level>li:focus>div{opacity:1;visibility:visible;overflow:visible;z-index:1;}.level .level_column{display:inline-block;width:100%;z-index:1;}.level .level_column li{list-style:none;display:inline-block;width:100%;height:30px;line-height:30px;font-size:13px;z-index:1;vertical-align:top;overflow:hidden;}.level .level_column li a{color:#448aff;}.level .level_column li a:hover{color:#333;}.level .level_selected{color:#333;z-index:1;}
.since{display:inline-block;width:auto;height:35px;line-height:35px;z-index:500;position:relative;margin-right:15px;vertical-align:top;}.since>li>div{position:absolute;display:block;width:130px;top:35px;left:-2px;opacity:0;visibility:hidden;overflow:hidden;border:1px solid #ccc;background:#fff;border-radius:2px;padding:15px 25px;z-index:1;-webkit-box-shadow:0px 0px 5px 0px rgba(170,170,170,0.15);box-shadow:0px 0px 5px 0px rgba(170,170,170,0.15);}.since>li:hover>div,.since>li:focus>div{opacity:1;visibility:visible;overflow:visible;z-index:1;}.since .since_column{display:inline-block;width:100%;z-index:1;}.since .since_column li{list-style:none;display:inline-block;width:100%;height:30px;line-height:30px;font-size:13px;z-index:1;vertical-align:top;overflow:hidden;}.since .since_column li a{color:#448aff;}.since .since_column li a:hover{color:#333;}.since .since_selected{color:#333;z-index:1;}
.rank{display:inline-block;width:auto;height:35px;line-height:35px;z-index:500;position:relative;vertical-align:top;}.rank>li>div{position:absolute;display:block;width:160px;top:35px;left:-2px;opacity:0;visibility:hidden;overflow:hidden;border:1px solid #ccc;background:#fff;border-radius:2px;padding:15px 20px;z-index:1;-webkit-box-shadow:0px 0px 5px 0px rgba(170,170,170,0.15);box-shadow:0px 0px 5px 0px rgba(170,170,170,0.15);}.rank>li:hover>div,.rank>li:focus>div{opacity:1;visibility:visible;overflow:visible;z-index:1;}.rank .rank_column{display:inline-block;width:100%;z-index:1;}.rank .rank_column li{list-style:none;display:inline-block;width:100%;height:30px;line-height:30px;font-size:13px;z-index:1;vertical-align:top;overflow:hidden;}.rank .rank_column li a{color:#448aff;}.rank .rank_column li a:hover{color:#333;}.rank .rank_selected{color:#333;z-index:1;}
</style>
<script type="text/javascript">
function shortlist(id){
    //console.log($('#markfavi_'+id).attr("class"));
    var url = "<?php echo URL::to('/candidate/jobshortlist/');?>/" + id +'/' ;
    if($('#markfavi_'+id).hasClass("fa-star-o")){
        url = url + 'save';
    }else{
        //delete
        url = url + 'delete';
    }
    $.ajax({url: url, type: 'POST', success: function(result){
        if(result == 'true')
            $('#markfavi_'+id).toggleClass('fa-star-o fa-star');    
        else
            document.write(result); 

    }});    
}
//load selected id

$('.searchbar_element').on( "click", function(e) {
    
    if(!$(this).hasClass('category_selected')){
        $(this).addClass('category_selected'); 
        $(this).closest('li').siblings().find('div').removeClass('category_selected');
        $(this).closest('li').siblings().find('div').addClass('searchbar_element');
        var title_element = $(this).closest(".dropdown_body").prev();
        if(title_element.hasClass('dropdown_title')){
            title_element.html($(this).html());
            title_element.attr('selected-id', $(this).attr('id'));
            title_element.addClass('search_filter_selected');
            title_element.removeClass('search_filter_tag');
            $("<a class='search_filter_remove' onclick='removeit(this);'>x</a>").insertAfter(title_element);
            var elementClass = $(this).parents('ul').eq(1).attr('class');
            var id = $(this).attr('id').replace(elementClass+'_','');
            $('#'+elementClass).val(id);
        }else if(title_element.hasClass('search_filter_remove')){
            var pre_element = title_element.prev();
            pre_element.html($(this).html());  
            pre_element.attr('selected-id', $(this).attr('id'));   
            var elementClass = $(this).parents('ul').eq(1).attr('class');
            var id = $(this).attr('id').replace(elementClass+'_','');
            $('#'+elementClass).val(id);        
        }  
        $(this).removeClass('searchbar_element');         
    }
});

function removeit(obj){

    $(obj).next().find('li').find('div').removeClass('category_selected');
    $(obj).next().find('li').find('div').addClass('searchbar_element');        
    var pre_element = $(obj).prev();
    pre_element.html(pre_element.attr('default-title')); 
    pre_element.removeClass('search_filter_selected');
    pre_element.addClass('search_filter_tag');

    var elementClass = $(obj).parents('ul').attr('class');    
    $('#'+elementClass).val('');        
    $(obj).remove();    

}

$('#type_<?php echo $selected_type ?>').trigger('click');
$('#category_<?php echo $selected_category ?>').trigger('click');
$('#level_<?php echo $selected_level ?>').trigger('click');
$('#search_keyword').val('<?php echo $selected_keyword ?>');
$('#search_location').val('<?php echo $selected_location ?>');
</script>
@stop