<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Welcome to JobKonner.com</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="CreativeLayers">

	{{-- <!-- Styles -->
    {!! HTML::style('new/css/bootstrap-grid.css') !!}
	{!! HTML::style('new/css/icons.css') !!}
	{!! HTML::style('new/css/animate.min.css') !!}
	{!! HTML::style('new/css/style.css') !!}
	{!! HTML::style('new/css/responsive.css') !!}
	{!! HTML::style('new/css/chosen.css') !!}
	{!! HTML::style('new/css/colors/colors.css') !!}
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" /> --}}

</head>
<body>
<div class="page-loading">
	<img src="{{ URL::asset('new/images/loader.gif') }} " alt="" />
	<span>Skip Loader</span>
</div>

<div class="theme-layout" id="scrollup">

	@yield('header')
	<section class="overlape">
		<div class="block no-padding">
			<div data-velocity="-.1" style="background: url(http://placehold.it/1600x800) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="inner-header">
							<h3></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@yield('warnings')

	@yield('main')

	@yield('footer')

</div>
@yield('side-bar')
@yield('popups')

{{-- {!! HTML::script('new/js/jquery.min.js') !!}
{!! HTML::script('new/js/modernizr.js') !!}
{!! HTML::script('new/js/script.js') !!}
{!! HTML::script('new/js/wow.min.js') !!}
{!! HTML::script('new/js/slick.min.js') !!}
{!! HTML::script('new/js/parallax.js') !!}

{!! HTML::script('new/js/select-chosen.js') !!}
{!! HTML::script('new/js/jquery.scrollbar.min.js') !!}
{!! HTML::script('new/js/circle-progress.min.js') !!}
{!! HTML::script('new/js/usage.js') !!}
{!! HTML::script('js/geolocation.js') !!} --}}

@yield('main-scripts')
@yield('scripts')
</body>
</html>

