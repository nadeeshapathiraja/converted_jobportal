<!DOCTYPE html>
    <head>
        <title>@yield('title') | {{ trans('common/globaltext.sitename') }}</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->     
        {!! HTML::style('css/main.css') !!}
        {!! HTML::style('css/jquery.tagsinput.css') !!}
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
    </head>

  <body class="homepage">
    <div id="page-wrapper">
        <div id="header-wrapper">
            <header id='header' class="container">                                
                @yield('header')                
            </header>
        </div>    
        
        <main>
            @if(Session::get('user.active') == '0')        
            <div class="emailverify_msg container" id="email_status">
                <h4 class="notify-header" id="email_status_type"> Email Status is Unverified </h4>
                <span id="validate_email"> Please validate your email address <strong>{{Session::get('user.email')}}</strong>. </span>                
            </div>
            @endif
            <div class="middleware_msg">{{Session::get('middleware_msg')}}</div>
            @yield('main')
        </main>
        <div id="footer-wrapper">
        <footer id='footer' class="container">
             @yield('footer')
        </footer>
        </div>
    </div>
    <!-- Scripts -->
            {!! HTML::script('js/jquery.min.js') !!}
            {!! HTML::script('js/jquery.dropotron.min.js') !!}
            {!! HTML::script('js/skel.min.js') !!}
            {!! HTML::script('js/util.js') !!}
            {!! HTML::script('js/main.js') !!}  
            {!! HTML::script('js/jquery.tagsinput.js') !!}  
            {!! HTML::script('js/geolocation.js') !!}              
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>            
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>            
    @yield('scripts')

  </body>
</html>