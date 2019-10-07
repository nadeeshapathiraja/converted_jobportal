<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Welcome to JobKonner.com</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
    <meta name="author" content="CreativeLayers">


    <!-- Styles -->
	<link rel="stylesheet" href="/new/css/bootstrap-grid.css"/>
	<link rel="stylesheet" href="/new/css/icons.css"/>
	<link rel="stylesheet" href="/new/css/animate.min.css"/>
	<link rel="stylesheet" href="/new/css/style.css"/>
	<link rel="stylesheet" href="/new/css/responsive.css"/>
	<link rel="stylesheet" href="/new/css/chosen.css"/>
	<link rel="stylesheet" href="/new/css/colors.css"/>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />



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




<script type="text/javascript" src="new/js/jquery.min.js"></script>
<script type="text/javascript" src="new/js/modernizr.js"></script>
<script type="text/javascript" src="new/js/script.js"></script>
<script type="text/javascript" src="new/js/wow.min.js"></script>
<script type="text/javascript" src="new/js/slick.min.js"></script>
<script type="text/javascript" src="new/js/parallax.js"></script>

<script type="text/javascript" src="new/js/select-chosen.js"></script>
<script type="text/javascript" src="new/js/jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="new/js/circle-progress.min.js"></script>
<script type="text/javascript" src="new/js/usage.js"></script>
<script type="text/javascript" src="js/geolocation.js"></script>


{
@yield('main-scripts')
@yield('scripts')
</body>
</html>

