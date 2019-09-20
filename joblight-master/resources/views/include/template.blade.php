<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>@yield('title') | {{ trans('common/globaltext.sitename') }}</title>
		<meta name="description" content="">	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<base target="_parent" />
		@yield('head')

		{!! HTML::style('css/main_front.css') !!}
		{!! HTML::style('css/styles.css') !!}
		{!! HTML::style('css/bootstrap.min.css') !!}
		{!! HTML::style('css/plugins/jquery-ui/jquery-ui.min.css') !!}			
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />        

		
	</head>

  <body>
	<header role="banner">
		<!--<div class="brand">{{ trans('front/site.title') }}</div>
		<div class="address-bar">{{ trans('front/site.sub-title') }}</div>
		<div id="flags" class="text-center"></div> -->
		
		@yield('header')	
	</header>

	<main role="main">
		@yield('main')
	</main>

	{!! HTML::script('js/jquery.min.js') !!}
	<script src="{{ asset('js/geolocation.js') }}"></script>
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
	{!! HTML::script('js/plugins.js') !!}
	{!! HTML::script('js/jquery-ui.js') !!}
	{!! HTML::script('js/jquery.inlineedit.js') !!}	
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	

	<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
	<script>
	/*	 
		(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
		function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
		e=o.createElement(i);r=o.getElementsByTagName(i)[0];
		e.src='//www.google-analytics.com/analytics.js';
		r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
		ga('create','UA-XXXXX-X');ga('send','pageview');
	*/	
	</script>

	@yield('scripts')

  </body>
</html>