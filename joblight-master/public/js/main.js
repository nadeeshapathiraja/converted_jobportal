/*
	Verti by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
*/

function checkemail(email, type){
      var url = '<?php echo URL::to("/ajaxcheckemail");?>';      
      var data = {};    
      data.email = email; 
      data.account_type = type;
      data._token = '<?php echo csrf_field(); ?>';
      $.ajax({
           type: 'POST',
           data: data,
           dataType: 'json',
           url: url,
           beforeSend: function() {               
           },
           success: function(data) {     
            if(data.allow == 'yes'){
               $('#save_btn').prop('disabled', false);
            }else{
               $('#email_errmsg').html(data.msg);
               $('#email').addClass('form_required').focus();               
               $('#save_btn').prop('disabled', true);
               this.value='Continue';
            }

           },
           error: function(error) {
               
           }
       });
}
function downloadresume(url, cand_id, account_id, job_id, obj){    
  data = {"candidate_profile_id" : cand_id, "candidate_account_id" : account_id, "download_source":"job_applicant", "job_post_id": job_id};  
    $.ajax({url: url, type: 'POST', data: data,success: function(result){
      if(result == 'true'){
          $(obj).find('div').text('Resume Downloaded');              
          $(obj).contents().unwrap();
      }    
      else
          document.write(result); 

  }});   
}

function confirmAction(delUrl, msg) {
  if (confirm("Are you sure you want to "+ msg +"?")) {
    document.location = delUrl;
  }
}

// Step 1: Create reusable jQuery plugin
// =====================================

$.fancyConfirm = function( opts ) {
  opts  = $.extend( true, {    
    src : '<div></div>',
    callback  : $.noop
  }, opts || {} );

  $.fancybox.open({
    type : 'html',
    src  : opts.src,    
    opts : {
      animationDuration : 350,
      animationEffect   : 'material',
      modal : true,
      baseTpl :
      '<div class="fancybox-container fc-container" role="dialog" tabindex="-1">' +
      '<div class="fancybox-bg"></div>' +
      '<div class="fancybox-inner">' +
      '<div class="fancybox-stage"></div>' +
      '</div>' +
      '</div>',
      afterClose : function( instance, current, e ) {
        var button = e ? e.target || e.currentTarget : null;
        var value  = button ? $(button).data('value') : 0;

        opts.callback( value );
      }
    }
  });
}




function sansAccent(str){
    var accent = [
        /[\300-\306]/g, /[\340-\346]/g, // A, a
        /[\310-\313]/g, /[\350-\353]/g, // E, e
        /[\314-\317]/g, /[\354-\357]/g, // I, i
        /[\322-\330]/g, /[\362-\370]/g, // O, o
        /[\331-\334]/g, /[\371-\374]/g, // U, u
        /[\321]/g, /[\361]/g, // N, n
        /[\307]/g, /[\347]/g // C, c
    ];
    var noaccent = ['A','a','E','e','I','i','O','o','U','u','N','n','C','c'];
    for(var i = 0; i < accent.length; i++){
        str = str.replace(accent[i], noaccent[i]);
    }
    return str;
}

(function($) {

	skel.breakpoints({
		xlarge: '(max-width: 1680px)',
		large: '(max-width: 1280px)',
		medium: '(max-width: 980px)',
		small: '(max-width: 736px)'
	});

	$(function() {

		var	$window = $(window),
			$body = $('body');

		// Disable animations/transitions until the page has loaded.
			$body.addClass('is-loading');

			$window.on('load', function() {
				$body.removeClass('is-loading');
			});

		// Fix: Placeholder polyfill.
			$('form').placeholder();

		// Prioritize "important" elements on medium.
			skel.on('+medium -medium', function() {
				$.prioritize(
					'.important\\28 medium\\29',
					skel.breakpoint('medium').active
				);
			});

		// Dropdowns.
			$('#nav > ul').dropotron({
				mode: 'fade',
				noOpenerFade: true,
				speed: 300
			});

		// Off-Canvas Navigation.

			// Navigation Toggle.
				$(
					'<div id="navToggle">' +
						'<a href="#navPanel" class="toggle"></a>' +
					'</div>'
				)
					.appendTo($body);

			// Navigation Panel.
				$(
					'<div id="navPanel">' +
						'<nav>' +
							$('#nav').navList() +
						'</nav>' +
					'</div>'
				)
					.appendTo($body)
					.panel({
						delay: 500,
						hideOnClick: true,
						hideOnSwipe: true,
						resetScroll: true,
						resetForms: true,
						side: 'left',
						target: $body,
						visibleClass: 'navPanel-visible'
					});

			// Fix: Remove navPanel transitions on WP<10 (poor/buggy performance).
				if (skel.vars.os == 'wp' && skel.vars.osVersion < 10)
					$('#navToggle, #navPanel, #page-wrapper')
						.css('transition', 'none');

	});

})(jQuery);

