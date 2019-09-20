@extends('include.employer.maintemplate')
@include('include.employer.mainheader')
@include('include.employer.topactionbar')

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBalFpLm5S9IyehiU8bjgqe_webG9VTnLQ&amp;libraries=places&amp;callback=initialize" async="" defer=""></script>
<script>
function loadformdata(main_form, object){      
  var obj = object[0];  
    for(var key in obj){                        
        if(obj.hasOwnProperty(key)){
          var input_type = main_form.find("#"+key).prop('type');
          //console.log(key +' = '+input_type + '=>'+obj[key]);
          if(key == 'notification_type' || key == 'application_receive_mode'){
            $('input[name='+key+'][value='+obj[key]+']').attr('checked', true).change().click();
          }else if(key == 'locality_country'){
            main_form.find('#locality').val(obj[key]).change();
          }else if(key == 'locality_city'){
            main_form.find('#linkedin_city').val(obj[key]);
          }else if(key == 'job_city'){
            main_form.find('#locality_area').val(obj[key]);
          }else if(key == 'is_confidential'){
            if(obj[key] == 'Y')
              main_form.find('#company_list').val('Confidential').change();
          }
          if(!input_type) continue;         
          if(input_type == 'radio' || input_type == 'checkbox'){            
            $('input[name='+key+'][value='+obj[key]+']').attr('checked', true).change();          
          }else if(input_type == 'select-one' || input_type == 'select-multiple' ) {                                          
            main_form.find('#'+key).val(obj[key]).change();             
          }else if(input_type == 'month' && obj[key]){
            document.getElementById(key).value =  obj[key].substr(0, 7);
          }else{            
            main_form.find('#'+key).val(obj[key]);
          }                     

        }
    }
  }

$(document).ready(function() {
  $("input[type=radio]").click(function(){
    var value = $(this).val();
    if(value=='email') {
      $("div#co_email :input").prop('readonly', false).css('opacity', '1.0').prop('disabled', false);
      $("div#co_email .token-input-list-facebook").prop('readonly', false).css('opacity', '1.0').prop('disabled', false);
      $("div#co_url :input").prop('readonly', 'readonly').css('opacity', '0.5').prop('disabled', true);

      $("div#company_notify :input").prop('readonly', false).css('opacity', '1.0');
      $("div#company_notify").prop('readonly', false).css('opacity', '1.0');

      $("div#company_notify :input#notify1").prop('checked', 'checked');
    }

    else if(value=='url') {
      $("div#co_url :input").prop('readonly', false).css('opacity', '1.0').prop('disabled', false);
      $("div#co_email .token-input-list-facebook").prop('readonly', 'readonly').css('opacity', '0.5').prop('disabled', true);
      $("div#co_email :input").prop('readonly', 'readonly').css('opacity', '0.5').prop('disabled', true);

      $("div#company_notify :input").prop('readonly', 'readonly').css('opacity', '0.5').prop('checked', false);
      $("div#company_notify").prop('readonly', false).css('opacity', '0.5');

      $('div.post_tokeninfo').css('opacity', '0.1');
      $('p#email_error').css('opacity', '0.1');
    }
  });

  $("div#co_email :input").prop('readonly', false).css('opacity', '1.0').prop('disabled', false);
  $("div#co_email .token-input-list-facebook").prop('readonly', false).css('opacity', '1.0').prop('disabled', false);
  $("div#co_url :input").prop('readonly', 'readonly').css('opacity', '0.5').prop('disabled', true);
  
  $('#company_list').change(function(){
    var value = $(this).val();    
    if(value == 'Confidential'){
      $('#div_company_name').hide();
      $('#span_no_company').html('CONFIDENTIAL POST DETAILS');
    }else{
      $('#div_company_name').show();
      $('#span_no_company').html('COMPANY AND POST DETAILS');
    }
  });

  var main_form = $("#form-save-post");
    var obj = JSON.parse('<?php echo $post_json; ?>');
    loadformdata(main_form, obj);
    form_data_change = false;
    main_form.on('keyup change', 'input, select, textarea', function(){
        form_data_change = true;
        edited_form = main_form;
    }); 
});

$(function() {
	$("#company_email").tokenInput([
          {id:0}
        ],{theme:"facebook", preventDuplicates:true});

	$("#currency_min").change(function() {
		$("#currency_max").val($(this).val());
	});

	$("#currency_max").change(function() {
		$("#currency_min").val($(this).val());
	});
});

$("#linkedin_city").keypress(function(){
   	$('#locality_city').val('');
});
   
function initLocality() {
   	var map = new google.maps.Map(document.getElementById('mapLocality'), {
   		center: {lat: -33.8688, lng: 151.2195},
   		zoom: 13
   	});
   
   	document.getElementById('mapLocality').style.display = "none";
   
   	var card = document.getElementById('pac-card');
   	var input = document.getElementById('linkedin_city');        
   	var output = document.getElementById('locality');
   	var types = document.getElementById('type-selector');
   
   	map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
   
   	var autocomplete = new google.maps.places.Autocomplete(input);
   
   	autocomplete.bindTo('bounds', map);
   
   	var infowindow = new google.maps.InfoWindow();
   	var infowindowContent = document.getElementById('infowindow-content');
   	infowindow.setContent(infowindowContent);
   	var marker = new google.maps.Marker({
   		map: map,
   		anchorPoint: new google.maps.Point(0, -29)
   	});
   
   	autocomplete.addListener('place_changed', function() {
   		infowindow.close();
   		marker.setVisible(false);
   		var place = autocomplete.getPlace();
   		if (!place.geometry) {
   			window.alert("No details available for input: '" + place.name + "'");
   			return;
   		}
   		
   		var country = '';
   		for (var i = 0; i < place.address_components.length; i++) {
   			var addressType = place.address_components[i].types[0];                        
   			if (addressType == "country") {
   				document.getElementById("locality").value = place.address_components[i].short_name;
   				//document.getElementById("country").value = place.address_components[i].short_name;
   			}
   		}          
   
   		document.getElementById('linkedin_city').value = place.name;
   		document.getElementById('locality_city').value = place.name;
   
   	});
   	
   	 autocomplete.setTypes(['(cities)']);   
}

function initCity() {
	var map = new google.maps.Map(document.getElementById('mapCity'), {
		center: {lat: -33.8688, lng: 151.2195},
		zoom: 13
	});

	document.getElementById('mapCity').style.display = "none";

	var card = document.getElementById('pac-card');
	var input = document.getElementById('locality_area');
	var types = document.getElementById('type-selector');

	map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

	var autocomplete = new google.maps.places.Autocomplete(input);

	autocomplete.bindTo('bounds', map);

	var infowindow = new google.maps.InfoWindow();
	var infowindowContent = document.getElementById('infowindow-content');
	infowindow.setContent(infowindowContent);
	var marker = new google.maps.Marker({
		map: map,
		anchorPoint: new google.maps.Point(0, -29)
	});

	autocomplete.addListener('place_changed', function() {
		infowindow.close();
		marker.setVisible(false);
		var place = autocomplete.getPlace();
		if (!place.geometry) {
			window.alert("No details available for input: '" + place.name + "'");
			return;
		}
		var arrAddress = place.address_components;
		var itemRoute='';
		var itemLocality='';
		var itemState='';
		var itemCountry='';
		
		$.each(arrAddress, function (i, address_component) {
				//console.log('address_component:'+i);

			if (address_component.types[0] == "route"){
				console.log(i+": route:"+address_component.long_name);
				itemRoute = address_component.long_name;
			}

			if (address_component.types[0] == "locality"){
				console.log("city:"+address_component.long_name);
				itemLocality = address_component.long_name;
				document.getElementById('job_city').value = itemLocality;
			}

			if (address_component.types[0] == "administrative_area_level_1"){
				console.log("administrative_area_level_1:"+address_component.long_name);
				itemState = address_component.long_name;
				document.getElementById('job_state').value = itemState;
			}

			if (address_component.types[0] == "country"){
				console.log("country:"+address_component.long_name);
				itemCountry = address_component.short_name;
				document.getElementById('job_country').value = itemCountry;
			}

		});

		document.getElementById('locality_area').value = place.name;

	});

	 autocomplete.setTypes(['(regions)']);
}

function initialize() {
	initLocality();
	initCity();
}      


tinymce.PluginManager.add('placeholder', function(editor) {
    editor.on('init', function() {
        var label = new Label;
        
        onBlur();

        tinymce.DOM.bind(label.el, 'click', onFocus);
        editor.on('focus', onFocus);
        editor.on('blur', onBlur);

        function onFocus(){
            label.hide();
            tinyMCE.execCommand('mceFocus', false, editor);
        }

        function onBlur(){
            if(editor.getContent() == '') {
                label.show();
            }else{
                label.hide();
            }
        }
    });

    var Label = function(){
        // Create label el
        this.text = editor.getElement().getAttribute("placeholder");
        this.contentAreaContainer = editor.getContentAreaContainer();

        tinymce.DOM.setStyle(this.contentAreaContainer, 'position', 'relative');

        attrs = {style: {position: 'absolute', top:'5px', left:0, color: '#888', padding: '1%', width:'98%', overflow: 'hidden'} };
        this.el = tinymce.DOM.add( this.contentAreaContainer, "label", attrs, this.text );
    }

    Label.prototype.hide = function(){
        tinymce.DOM.setStyle( this.el, 'display', 'none' );
    }

    Label.prototype.show = function(){
        tinymce.DOM.setStyle( this.el, 'display', '' );   
    }

}); 


tinymce.init({
        selector: 'textarea#job_description' , width:'100%', height:'600px',
        plugins: ["paste", "placeholder"], paste_as_text:true, menubar:false, statusbar:false, });
        //toolbar: 'bold italic | bullist numlist', content_css:"//s3.amazonaws.com/JHP-S3/css/tinymce.css"});    
</script>
@stop
@section('main')
<div id="features-wrapper">
   <div class="container">
   		<form method="POST" id="form-save-post" action="{{URL::to('/employer/ajaxcreatepost')}}" accept-charset="UTF-8">
      	<input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
        <input type="hidden" name="jobpost_id" id="jobpost_id">
	      	<div class="row">      		
		      	<div class="8u 12u(medium)">
			      	<h1 class="signup_title">Post New Job</h1>
	              <div class="signup_titleblock">
                   <span class="signup_titlehead" id="span_no_company">
                   Company and Post Details
                   </span>
	          		</div>
	          		<div class="signup_boxleft" id='div_company_name' style="width:100%;">
                    	<label for="company_name">Company Name</label>
                    	<input class="signup_text" id="company_name" name="company_name" type="text" value="{{$employerprofiles->name}}">               
                </div>                                
              	<div class="signup_boxleft">
                    	<label for="linkedin_city">City to post job in</label>                    	
                    	<input class="signup_text" placeholder="Start typing to find city..." id="linkedin_city" name="linkedin_city" type="text" autocomplete="off">
                        <input id="locality_city" name="locality_city" type="hidden">
                        <div id="mapLocality" style="display: none; position: relative; overflow: hidden;">
                           <div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
                              <div class="gm-style" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px;">
                                 <div style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;) 8 8, default;">
                                    <div style="z-index: 1; position: absolute; top: 0px; left: 0px; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);">
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;">
                                          <div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
                                             <div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;">
                                                <div style="width: 256px; height: 256px; position: absolute; left: -21px; top: -245px;"></div>
                                             </div>
                                          </div>
                                       </div>
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div>
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div>
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;">
                                          <div style="position: absolute; left: 0px; top: 0px; z-index: -1;">
                                             <div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;">
                                                <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -21px; top: -245px;"></div>
                                             </div>
                                          </div>
                                       </div>
                                       <div style="position: absolute; z-index: 0; left: 0px; top: 0px;">
                                          <div style="overflow: hidden;"></div>
                                       </div>
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
                                          <div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;"></div>
                                       </div>
                                    </div>
                                    <div style="z-index: 2; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px;"></div>
                                    <div style="z-index: 3; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px;">
                                       <div style="z-index: 1; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px;"></div>
                                    </div>
                                    <div style="z-index: 4; position: absolute; top: 0px; left: 0px; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);">
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div>
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div>
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div>
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;"></div>
                                    </div>
                                 </div>
                                 <div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;">
                                    <a target="_blank" href="https://maps.google.com/maps?ll=-33.8688,151.2195&amp;z=13&amp;t=m&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3" title="Click to see this area on Google Maps" style="position: static; overflow: visible; float: none; display: inline;">
                                       <div style="width: 66px; height: 26px; cursor: pointer;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/google4.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 66px; height: 26px; user-select: none; border: 0px; padding: 0px; margin: 0px;"></div>
                                    </a>
                                 </div>
                                 <div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto, Arial, sans-serif; color: rgb(34, 34, 34); box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px; z-index: 10000002; display: none; width: 0px; height: 0px; position: absolute; left: 5px; top: 5px;">
                                    <div style="padding: 0px 0px 10px; font-size: 16px;">Map Data</div>
                                    <div style="font-size: 13px;"></div>
                                    <div style="width: 13px; height: 13px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/mapcnt6.png" draggable="false" style="position: absolute; left: -2px; top: -336px; width: 59px; height: 492px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div>
                                 </div>
                                 <div class="gmnoprint" style="z-index: 1000001; position: absolute; right: 0px; bottom: 0px; width: 12px;">
                                    <div draggable="false" class="gm-style-cc" style="user-select: none; height: 14px; line-height: 14px;">
                                       <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
                                          <div style="width: 1px;"></div>
                                          <div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div>
                                       </div>
                                       <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a style="color: rgb(68, 68, 68); text-decoration: none; cursor: pointer; display: none;">Map Data</a><span style="display: none;"></span></div>
                                    </div>
                                 </div>
                                 <div class="gmnoscreen" style="position: absolute; right: 0px; bottom: 0px;">
                                    <div style="font-family: Roboto, Arial, sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);"></div>
                                 </div>
                                 <div class="gmnoprint gm-style-cc" draggable="false" style="z-index: 1000001; user-select: none; height: 14px; line-height: 14px; position: absolute; right: 0px; bottom: 0px;">
                                    <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
                                       <div style="width: 1px;"></div>
                                       <div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div>
                                    </div>
                                    <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a href="https://www.google.com/intl/en-US_US/help/terms_maps.html" target="_blank" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Terms of Use</a></div>
                                 </div>
                                 <div style="cursor: pointer; width: 25px; height: 25px; overflow: hidden; display: none; margin: 10px 14px; position: absolute; top: 0px; right: 0px;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/sv9.png" draggable="false" class="gm-fullscreen-control" style="position: absolute; left: -52px; top: -86px; width: 164px; height: 175px; user-select: none; border: 0px; padding: 0px; margin: 0px;"></div>
                                 <div draggable="false" class="gm-style-cc" style="user-select: none; height: 14px; line-height: 14px; display: none; position: absolute; right: 0px; bottom: 0px;">
                                    <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
                                       <div style="width: 1px;"></div>
                                       <div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div>
                                    </div>
                                    <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a target="_new" title="Report errors in the road map or imagery to Google" href="https://www.google.com/maps/@-33.8688,151.2195,13z/data=!10m1!1e1!12b1?source=apiv3&amp;rapsrc=apiv3" style="font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;">Report a map error</a></div>
                                 </div>
                                 <div class="gmnoprint gm-bundled-control gm-bundled-control-on-bottom" draggable="false" controlwidth="0" controlheight="0" style="margin: 10px; user-select: none; position: absolute; display: none; bottom: 0px; right: 0px;">
                                    <div class="gmnoprint" style="display: none; position: absolute;">
                                       <div draggable="false" style="user-select: none; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-radius: 2px; cursor: pointer; background-color: rgb(255, 255, 255);">
                                          <div title="Zoom in" style="position: relative;">
                                             <div style="overflow: hidden; position: absolute;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/tmapctrl.png" draggable="false" style="position: absolute; left: 0px; top: 0px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 120px; height: 54px;"></div>
                                          </div>
                                          <div style="position: relative; overflow: hidden; width: 67%; height: 1px; left: 16%; background-color: rgb(230, 230, 230);"></div>
                                          <div title="Zoom out" style="position: relative;">
                                             <div style="overflow: hidden; position: absolute;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/tmapctrl.png" draggable="false" style="position: absolute; left: 0px; top: 0px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 120px; height: 54px;"></div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="gm-svpc" controlwidth="28" controlheight="28" style="background-color: rgb(255, 255, 255); box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-radius: 2px; width: 28px; height: 28px; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;) 8 8, default; display: none; position: absolute;">
                                       <div style="position: absolute; left: 1px; top: 1px;"></div>
                                    </div>
                                    <div class="gmnoprint" controlwidth="28" controlheight="0" style="display: none; position: absolute;">
                                       <div title="Rotate map 90 degrees" style="width: 28px; height: 28px; overflow: hidden; position: absolute; border-radius: 2px; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; cursor: pointer; background-color: rgb(255, 255, 255); display: none;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/tmapctrl4.png" draggable="false" style="position: absolute; left: -141px; top: 6px; width: 170px; height: 54px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div>
                                       <div class="gm-tilt" style="width: 0px; height: 0px; overflow: hidden; position: absolute; border-radius: 2px; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; top: 0px; cursor: pointer; background-color: rgb(255, 255, 255);"><img src="https://maps.gstatic.com/mapfiles/api-3/images/tmapctrl4.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 170px; height: 54px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div>
                                    </div>
                                 </div>
                                 <div class="gmnoprint" style="margin: 10px; z-index: 0; position: absolute; cursor: pointer; display: none; left: 0px; top: 0px;">
                                    <div class="gm-style-mtc" style="float: left;">
                                       <div draggable="false" title="Show street map" style="direction: ltr; overflow: hidden; text-align: center; position: relative; color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 8px; border-bottom-left-radius: 2px; border-top-left-radius: 2px; -webkit-background-clip: padding-box; background-clip: padding-box; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; font-weight: 500;">Map</div>
                                       <div style="background-color: white; z-index: -1; padding: 2px; border-bottom-left-radius: 2px; border-bottom-right-radius: 2px; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; position: absolute; left: 0px; top: 0px; text-align: left; display: none;">
                                          <div draggable="false" title="Show street map with terrain" style="color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 6px 8px 6px 6px; direction: ltr; text-align: left; white-space: nowrap;">
                                             <span role="checkbox" style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(198, 198, 198); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;">
                                                <div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img src="https://maps.gstatic.com/mapfiles/mv/imgs8.png" draggable="false" style="position: absolute; left: -52px; top: -44px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 68px; height: 67px;"></div>
                                             </span>
                                             <label style="vertical-align: middle; cursor: pointer;">Terrain</label>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="gm-style-mtc" style="float: left;">
                                       <div draggable="false" title="Show satellite imagery" style="direction: ltr; overflow: hidden; text-align: center; position: relative; color: rgb(86, 86, 86); font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 8px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; -webkit-background-clip: padding-box; background-clip: padding-box; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-left: 0px;">Satellite</div>
                                       <div style="background-color: white; z-index: -1; padding: 2px; border-bottom-left-radius: 2px; border-bottom-right-radius: 2px; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; position: absolute; right: 0px; top: 0px; text-align: left; display: none;">
                                          <div draggable="false" title="Show imagery with street names" style="color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 6px 8px 6px 6px; direction: ltr; text-align: left; white-space: nowrap;">
                                             <span role="checkbox" style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(198, 198, 198); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;">
                                                <div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden;"><img src="https://maps.gstatic.com/mapfiles/mv/imgs8.png" draggable="false" style="position: absolute; left: -52px; top: -44px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 68px; height: 67px;"></div>
                                             </span>
                                             <label style="vertical-align: middle; cursor: pointer;">Labels</label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
					</div>
					<div class="signup_boxright">
						<label for="locality">Country to post job in</label>
            {!! Form::select('locality', $country, null, ['id'=>'locality', 'class' => 'signup_select', 'required']) !!}
					</div>
					<div class="signup_titleblock">
	                     <span class="signup_titlehead">
	                     Job Details
	                     </span>
	          		</div>
	          		<div class="signup_boxleft" style="width:100%;">
                    	<label for="job_title">Job Title</label>
                    	<input class="signup_text" placeholder="Job Title" id="job_title" name="job_title" type="text" value="">
                  	</div>
                  	<div class="signup_boxleft">
                    	<label for="state">Job Location</label>
                    	<input class="signup_text" id="locality_area" placeholder="Start typing to find city..." name="area" type="text" autocomplete="off">
                        <div id="mapCity" style="display: none; position: relative; overflow: hidden;">
                           <div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
                              <div class="gm-style" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px;">
                                 <div style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;) 8 8, default;">
                                    <div style="z-index: 1; position: absolute; top: 0px; left: 0px; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);">
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;">
                                          <div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
                                             <div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;">
                                                <div style="width: 256px; height: 256px; position: absolute; left: -21px; top: -245px;"></div>
                                             </div>
                                          </div>
                                       </div>
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div>
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div>
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;">
                                          <div style="position: absolute; left: 0px; top: 0px; z-index: -1;">
                                             <div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;">
                                                <div style="width: 256px; height: 256px; overflow: hidden; position: absolute; left: -21px; top: -245px;"></div>
                                             </div>
                                          </div>
                                       </div>
                                       <div style="position: absolute; z-index: 0; left: 0px; top: 0px;">
                                          <div style="overflow: hidden;"></div>
                                       </div>
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
                                          <div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;"></div>
                                       </div>
                                    </div>
                                    <div style="z-index: 2; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px;"></div>
                                    <div style="z-index: 3; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px;">
                                       <div style="z-index: 1; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px;"></div>
                                    </div>
                                    <div style="z-index: 4; position: absolute; top: 0px; left: 0px; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);">
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div>
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div>
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div>
                                       <div style="position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;"></div>
                                    </div>
                                 </div>
                                 <div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;">
                                    <a target="_blank" href="https://maps.google.com/maps?ll=-33.8688,151.2195&amp;z=13&amp;t=m&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3" title="Click to see this area on Google Maps" style="position: static; overflow: visible; float: none; display: inline;">
                                       <div style="width: 66px; height: 26px; cursor: pointer;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/google4.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 66px; height: 26px; user-select: none; border: 0px; padding: 0px; margin: 0px;"></div>
                                    </a>
                                 </div>
                                 <div style="background-color: white; padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto, Arial, sans-serif; color: rgb(34, 34, 34); box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px; z-index: 10000002; display: none; width: 0px; height: 0px; position: absolute; left: 5px; top: 5px;">
                                    <div style="padding: 0px 0px 10px; font-size: 16px;">Map Data</div>
                                    <div style="font-size: 13px;"></div>
                                    <div style="width: 13px; height: 13px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/mapcnt6.png" draggable="false" style="position: absolute; left: -2px; top: -336px; width: 59px; height: 492px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div>
                                 </div>
                                 <div class="gmnoprint" style="z-index: 1000001; position: absolute; right: 0px; bottom: 0px; width: 12px;">
                                    <div draggable="false" class="gm-style-cc" style="user-select: none; height: 14px; line-height: 14px;">
                                       <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
                                          <div style="width: 1px;"></div>
                                          <div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div>
                                       </div>
                                       <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a style="color: rgb(68, 68, 68); text-decoration: none; cursor: pointer; display: none;">Map Data</a><span style="display: none;"></span></div>
                                    </div>
                                 </div>
                                 <div class="gmnoscreen" style="position: absolute; right: 0px; bottom: 0px;">
                                    <div style="font-family: Roboto, Arial, sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);"></div>
                                 </div>
                                 <div class="gmnoprint gm-style-cc" draggable="false" style="z-index: 1000001; user-select: none; height: 14px; line-height: 14px; position: absolute; right: 0px; bottom: 0px;">
                                    <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
                                       <div style="width: 1px;"></div>
                                       <div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div>
                                    </div>
                                    <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a href="https://www.google.com/intl/en-US_US/help/terms_maps.html" target="_blank" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Terms of Use</a></div>
                                 </div>
                                 <div style="cursor: pointer; width: 25px; height: 25px; overflow: hidden; display: none; margin: 10px 14px; position: absolute; top: 0px; right: 0px;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/sv9.png" draggable="false" class="gm-fullscreen-control" style="position: absolute; left: -52px; top: -86px; width: 164px; height: 175px; user-select: none; border: 0px; padding: 0px; margin: 0px;"></div>
                                 <div draggable="false" class="gm-style-cc" style="user-select: none; height: 14px; line-height: 14px; display: none; position: absolute; right: 0px; bottom: 0px;">
                                    <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
                                       <div style="width: 1px;"></div>
                                       <div style="background-color: rgb(245, 245, 245); width: auto; height: 100%; margin-left: 1px;"></div>
                                    </div>
                                    <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a target="_new" title="Report errors in the road map or imagery to Google" href="https://www.google.com/maps/@-33.8688,151.2195,13z/data=!10m1!1e1!12b1?source=apiv3&amp;rapsrc=apiv3" style="font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;">Report a map error</a></div>
                                 </div>
                                 <div class="gmnoprint gm-bundled-control gm-bundled-control-on-bottom" draggable="false" controlwidth="0" controlheight="0" style="margin: 10px; user-select: none; position: absolute; display: none; bottom: 0px; right: 0px;">
                                    <div class="gmnoprint" style="display: none; position: absolute;">
                                       <div draggable="false" style="user-select: none; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-radius: 2px; cursor: pointer; background-color: rgb(255, 255, 255);">
                                          <div title="Zoom in" style="position: relative;">
                                             <div style="overflow: hidden; position: absolute;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/tmapctrl.png" draggable="false" style="position: absolute; left: 0px; top: 0px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 120px; height: 54px;"></div>
                                          </div>
                                          <div style="position: relative; overflow: hidden; width: 67%; height: 1px; left: 16%; background-color: rgb(230, 230, 230);"></div>
                                          <div title="Zoom out" style="position: relative;">
                                             <div style="overflow: hidden; position: absolute;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/tmapctrl.png" draggable="false" style="position: absolute; left: 0px; top: 0px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 120px; height: 54px;"></div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="gm-svpc" controlwidth="28" controlheight="28" style="background-color: rgb(255, 255, 255); box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-radius: 2px; width: 28px; height: 28px; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;) 8 8, default; display: none; position: absolute;">
                                       <div style="position: absolute; left: 1px; top: 1px;"></div>
                                    </div>
                                    <div class="gmnoprint" controlwidth="28" controlheight="0" style="display: none; position: absolute;">
                                       <div title="Rotate map 90 degrees" style="width: 28px; height: 28px; overflow: hidden; position: absolute; border-radius: 2px; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; cursor: pointer; background-color: rgb(255, 255, 255); display: none;"><img src="https://maps.gstatic.com/mapfiles/api-3/images/tmapctrl4.png" draggable="false" style="position: absolute; left: -141px; top: 6px; width: 170px; height: 54px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div>
                                       <div class="gm-tilt" style="width: 0px; height: 0px; overflow: hidden; position: absolute; border-radius: 2px; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; top: 0px; cursor: pointer; background-color: rgb(255, 255, 255);"><img src="https://maps.gstatic.com/mapfiles/api-3/images/tmapctrl4.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 170px; height: 54px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"></div>
                                    </div>
                                 </div>
                                 <div class="gmnoprint" style="margin: 10px; z-index: 0; position: absolute; cursor: pointer; display: none; left: 0px; top: 0px;">
                                    <div class="gm-style-mtc" style="float: left;">
                                       <div draggable="false" title="Show street map" style="direction: ltr; overflow: hidden; text-align: center; position: relative; color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 8px; border-bottom-left-radius: 2px; border-top-left-radius: 2px; -webkit-background-clip: padding-box; background-clip: padding-box; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; font-weight: 500;">Map</div>
                                       <div style="background-color: white; z-index: -1; padding: 2px; border-bottom-left-radius: 2px; border-bottom-right-radius: 2px; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; position: absolute; left: 0px; top: 0px; text-align: left; display: none;">
                                          <div draggable="false" title="Show street map with terrain" style="color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 6px 8px 6px 6px; direction: ltr; text-align: left; white-space: nowrap;">
                                             <span role="checkbox" style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(198, 198, 198); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;">
                                                <div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden; display: none;"><img src="https://maps.gstatic.com/mapfiles/mv/imgs8.png" draggable="false" style="position: absolute; left: -52px; top: -44px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 68px; height: 67px;"></div>
                                             </span>
                                             <label style="vertical-align: middle; cursor: pointer;">Terrain</label>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="gm-style-mtc" style="float: left;">
                                       <div draggable="false" title="Show satellite imagery" style="direction: ltr; overflow: hidden; text-align: center; position: relative; color: rgb(86, 86, 86); font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 8px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; -webkit-background-clip: padding-box; background-clip: padding-box; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; border-left: 0px;">Satellite</div>
                                       <div style="background-color: white; z-index: -1; padding: 2px; border-bottom-left-radius: 2px; border-bottom-right-radius: 2px; box-shadow: rgba(0, 0, 0, 0.3) 0px 1px 4px -1px; position: absolute; right: 0px; top: 0px; text-align: left; display: none;">
                                          <div draggable="false" title="Show imagery with street names" style="color: rgb(0, 0, 0); font-family: Roboto, Arial, sans-serif; user-select: none; font-size: 11px; background-color: rgb(255, 255, 255); padding: 6px 8px 6px 6px; direction: ltr; text-align: left; white-space: nowrap;">
                                             <span role="checkbox" style="box-sizing: border-box; position: relative; line-height: 0; font-size: 0px; margin: 0px 5px 0px 0px; display: inline-block; background-color: rgb(255, 255, 255); border: 1px solid rgb(198, 198, 198); border-radius: 1px; width: 13px; height: 13px; vertical-align: middle;">
                                                <div style="position: absolute; left: 1px; top: -2px; width: 13px; height: 11px; overflow: hidden;"><img src="https://maps.gstatic.com/mapfiles/mv/imgs8.png" draggable="false" style="position: absolute; left: -52px; top: -44px; user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 68px; height: 67px;"></div>
                                             </span>
                                             <label style="vertical-align: middle; cursor: pointer;">Labels</label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>                                                
                        <input id="job_city" name="city" type="hidden">
                        <input id="job_state" name="state" type="hidden">
                    </div>                  	
                  	<div class="signup_boxright">
                     <label for="job_country">Country</label>
                     {!! Form::select('job_country', $country, null, ['id'=>'job_country', 'class' => 'signup_select', 'required']) !!}
		        	</div>

		        	<div class="signup_boxleft">
                     <label for="job_category">Job Category</label>
                     {!! Form::select('job_category', $job_category, null, ['class' => 'signup_select','id' => 'job_category' ,'required']) !!}
                  	</div>
                  	<div class="signup_boxright">
                     <label for="job_level">Position Level</label>
                     {!! Form::select('job_level', $job_level, null, ['class' => 'signup_select', 'id' => 'job_level' ,'required']) !!}
                  	</div>

					<div class="signup_boxleft">
                     <label for="job_type">Job Type</label>
                     {!! Form::select('job_type', $job_type, null, ['class' => 'signup_select', 'id' => 'job_type' ,'required']) !!}
                  	</div>
                  	<div class="signup_boxright">
                  		<label for="salary_currency">Minimum Salary <span class="post_salary_monthly">(Monthly)</span></label>
                      {!! Form::select('salary_currency', $currency, null, ['id'=>'currency_min' ,'class' => 'signup_select', 'style' => 'width:24%;margin-right:2px', 'id' => 'salary_currency' ,'required']) !!}
                        
                        <input placeholder="Minimum" id="salary_min" name="salary_min" type="text" style="margin-left:1% ;display:inline-block; width:34%;">
                        <span> – </span>
                        <input placeholder="Maximum" id="salary_max" name="salary_max" type="text" style="display:inline-block; width:34%;">
                    </div>
                    <div class="signup_boxleft" style="width:100%;">
                    	<label for="job_description">Job Description</label>	                    
                    	<textarea id="job_description" class="post_boxtextarea" name="job_description" cols="50" rows="10" aria-hidden="true"></textarea>
                    </div>
                <!--    
                <div class="signup_titleblock">
	                     <span class="signup_titlehead">
	                     Upload Logo &amp; Banner 
	                     </span>
	                     <span class="post_companynote">* logo and banner must be in <b>.jpg, .jpeg, .gif, .png</b> formats only</span>
	          		</div>
                
	          		<div class="signup_boxleft">
		          		<div id="uploading-logo">
	                        <img id="ready-logo" src="../img/logo.jpg" alt="">
	                        <div id="result"></div>
	                        <div id="logo_loading"></div>
	                        <input id="logo-image" name="logo_url" type="file">
	                        <p style="font-size:11px; color:#666;">* suggested logo size: 150x150</p>
	                        <div id="error-logo" class="post_error_logo"></div>
	                  	</div>
	          		</div>
	          		<div class="signup_boxright">
	          			<div id="uploading-banner">
	                        <img id="ready-banner" src="../img/banner.jpg" alt="">
	                        <div id="sample"></div>
	                        <div id="banner_loading"></div>
	                        <input id="banner-image" name="banner_url" type="file">
	                        <p style="font-size:11px; color:#666;">* banner to be displayed: 950x300</p>
	                        <div id="error-banner" class="post_error_banner"></div>
                  		</div>
	          		</div>
                
	          		<div class="signup_titleblock">
	                     <span class="signup_titlehead">
	                     How Do You Want To Receive Applications?
	                     </span>
	          		</div>
	          		<div class="signup_boxleft" style="width:100%;">
	          			      <div class="post_notificationlabel">
                           <input type="radio" name="application_receive_mode" id="coemail" checked="checked" value="email">
                           Collect applications on Jobstore and be notified by email
                           <span class="postimportant">* required if selected</span>
                        </div>
                        <div id="co_email">
                              <input class="post_text" placeholder="Add new email address" id="company_email" maxlength="100" name="company_email" type="text" style="display: none; opacity: 1;">
                              <div class="postimportant">
                                 * Separate multiple email addresses using commas
                              </div>
                        </div>
                        <div id="company_notify" class="post_notify">
                              <div class="post_notifybox">
                                <input id="notify1" checked="checked" name="notification_type" type="radio" value="4">
                                Send notifications of <span class="post_notifybold">all applications</span> to this email address
                              </div>
                              <div class="post_notifybox">
                                 <input id="notify2" name="notification_type" type="radio" value="3">
                                    Only send notifications of <span class="post_notifybold">all qualified applications, including foreign applicants</span>
                              </div>
                              <div class="post_notifybox">
                                 <input id="notify3" name="notification_type" type="radio" value="2">
                                    Only send notifications of qualified applications, <span class="post_notifybold">NOT including foreign applicants</span>
                              </div>
                              <div class="post_notifybox">
                                 <input id="notify4" name="notification_type" type="radio" value="1">
                                    <span class="post_notifybold">Do not</span> send any notifications to this email address
                              </div>
                        </div>
                        <div class="post_notificationlabel">
                           <input type="radio" name="application_receive_mode" id="courl" value="url">
                           Direct applicants to an external site to apply
                           <span class="post_companynote">* required if selected</span>
                        </div>
                        <div id="co_url">
                           <input class="post_text" placeholder="External URL e.g. http://www.company.com" id="company_url" style="margin-bottom: -10px; opacity: 0.5;" name="company_url" type="text" value="" readonly="" disabled="">
                        </div>
                        
	          		</div> 
              -->
	                <div class="signup_boxleft" style="width:100%; text-align: center;">
	                  <input name="external_listing" type="hidden" value="0">               
	                   <div class="post_hiddenbox">
	                      <input id="hidden-logo" class="post_text" name="logo_url" type="hidden" value="">
	                      <input id="hidden-banner" class="post_text" name="banner_url" type="hidden" value="">
	                      <input name="salary_period" type="hidden" value="2">
	                   </div>
	                   <div class="post_button_box">	  
                        <input id="draftList" name="draftList" type="hidden" value="">                                                                 
                        <a href="javascript:{}" onclick="$('#draftList').val('YES'); document.getElementById('form-save-post').submit(); return false;" class="button icon fa-paper-plane-o btn btn-medium">Save</a>

                        <input id="formsave" name="preview" type="submit" value="Preview & Post">
                         
	                         <div class="post_cancel">
	                            <a href="{{URL::to('/employer/main')}}" class="btn_link"> Cancel </a>
	                         </div>                      
	                   </div>
	                </div>
		        </div>	
		        <div class="4u 12u(medium)">
		        	<div class="post_info">											        
		              	<select name="company_list" class="signup_select" id="company_list">
		                <option disabled="disabled" style="color: rgb(136, 136, 136);">Select company name to post as</option>
		                <option value="FBI" class="current" selected="selected" id="0" style="color: rgb(136, 136, 136);">{{$employerprofiles->name}}</option>
		                <option value="Confidential" class="confidentialname" id="-1" style="color: rgb(136, 136, 136);">Post as Confidential</option>
		              	<!-- <option value="-2" class="new_profile" style="color: rgb(136, 136, 136);">‐ Create new profile –</option> -->
		              	</select>													
			              <div id="company_first" class="post_info_main" style="display: block;">
			                <div class="company_profile_box">
			                   <div class="company_logo">
			                      <img src="">
			                   </div>
			                   <div class="company_name">
			                      {{$employerprofiles->name}}
			                   </div>
			                   <div class="company_owner">
			                      
			                   </div>
			                   <a href="" target="_blank">
			                      <div class="company_profile">
			                         View company profile
			                      </div>
			                   </a>
			                   <div class="company_email">
			                      {{$employerprofiles->contact_email}}
			                   </div>
			                   <div class="company_phone">
			                     {{$employerprofiles->contact_number}}
			                   </div>
			                   <div class="company_location">
			                     {{$employerprofiles->state}}
			                   </div>
			                   <div class="company_description">
			                      {{$employerprofiles->description}}
			                   </div>
			                </div>
			             </div>						

						</div>
		        </div>	        
		    </div>
	    </form>
	</div>
</div>	        
<!--
<div class="employer_container">
   <div class="main_container">      
      <div class="post_info">
         <select name="company_list" class="post_select_company" id="company_list">
            <option disabled="disabled" style="color: rgb(136, 136, 136);">Select company name to post as</option>
            <option value="FBI" class="current" selected="selected" id="0" style="color: rgb(136, 136, 136);">FBI</option>
            <option value="Confidential" class="confidentialname" id="-1" style="color: rgb(136, 136, 136);">Post as Confidential</option>
            <option value="-2" class="new_profile" style="color: rgb(136, 136, 136);">‐ Create new profile –</option>
         </select>
         <div id="company_first" class="main" style="display: block;">
            <div class="company_profile_box">
               <div class="company_logo">
                  <img src="">
               </div>
               <div class="company_name">
                  FBI
               </div>
               <div class="company_owner">
                  whatever – blah
               </div>
               <a href="https://www.jobstore.com/company/346731-0/fbi" target="_blank">
                  <div class="company_profile">
                     View company profile
                  </div>
               </a>
               <div class="company_email">
                  ninja@ninja.com
               </div>
               <div class="company_phone">
                  01122359641
               </div>
               <div class="company_location">
                  PJ MY
               </div>
               <div class="company_description">
                  water is good for society
               </div>
            </div>
         </div>
         <div id="company_confidential" class="confidential" style="display: none;">
            – &nbsp; No company information &nbsp; –
         </div>
         <script>
            $(document).ready(function(){
            
            	$('.main').show();
            	$('.alias').hide();
            
            	$('#company_list').on('change', function () {
            		
            		var id = $(this).find('option:selected').prop('id');
            		var val = $(this).val();
            		
            		if(id == 0){
            			$('#company_first').fadeIn();
            			$('.confidential').hide();
            			$('.alias').hide();
            
            			$('#hidden_company').val("FBI").prop('readonly',false).removeClass('post_company');
            			$('#hidden_company').addClass('post_text');
            			$('#hidden_aliasid').val('0');
            			
            			$('#checkmap').prop('checked',true).prop('disabled',false);
            			$('#hidden_map').val('1');
            			$('.post_mapnote').css({'font-weight':'600','opacity':'1.0'});
            			
            		}
            		
            		else if(id > 0){
            			$('.alias').hide();
            			$('#company_view'+$(this).find('option:selected').prop('id')).fadeIn();
            			$('#company_first').hide();
            			$('.confidential').hide();
            
            			$('#hidden_company').val(val).prop('readonly',false).removeClass('post_company');
            			$('#hidden_company').addClass('post_text');
            			$('#hidden_aliasid').val(id);
            			
            			$('#checkmap').prop('checked',true).prop('disabled',false);
            			$('#hidden_map').val('1');
            			$('.post_mapnote').css({'font-weight':'600','opacity':'1.0'});
            			
            		}
            		
            		else if(id == -1){
            			$('#company_confidential').fadeIn();
            			$('.main').hide();
            			$('.alias').hide();
            
            			$('#hidden_company').val('Confidential').prop('readonly',true).removeClass('post_text');
            			$('#hidden_company').addClass('post_company');
            			$('#hidden_aliasid').val('0');
            
            			$("#selectprofile option:selected").text("Confidential");
            			$('#checkmap').prop('checked',false).prop('disabled',true);
            			$('#hidden_map').val('0');
            			$('.post_mapnote').css({'font-weight':'400','opacity':'0.6'});
            			
            			
            		}
            		
            		else if (id < -1){
            			window.open("https://www.jobstore.com/employer/alias/create", '_blank');
            		}
            		return false;
            	});
            });
         </script>
      </div>

   </div>
</div>

-->
@stop

@section('scripts')
<script type="text/javascript">
  function onlySave(){
    alert('sun');
    $('#draftList').val('YES');
    $('#formsave').trigger('click');
  }

</script>
@stop