<!DOCTYPE html>
    <head>
        <title>@yield('title') | {{ trans('common/globaltext.sitename') }}</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->     
        {!! HTML::style('css/main.css') !!}
        {!! HTML::style('css/skin.min.css') !!}
        {!! HTML::style('css/tokeninput.css') !!}
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />        
    </head>

  <body class="homepage">
    <div id="page-wrapper">
        <div id="header-wrapper" class="employer_header">
            <header id='header' class="container">                                
                @yield('header')                
            </header>
        </div>    
            @yield('topactionbar')
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
            {!! HTML::script('js/jquery.tokeninput.js') !!}  
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    @yield('scripts')

  </body>
</html>