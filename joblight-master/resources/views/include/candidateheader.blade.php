@section('header')
<div class="mobile-navbar-fixed-top hidden-print" id="myjs_header">

    <div class="tbs-new">
        <!-- header starts -->
        <div class="navbar-default navbar-static">
            <!-- check if user login to add full-width class -->
            <div class="container full-width">
                <!-- Mobile Collapse Toggle Btn -->
                <div class="navbar-header" id="mobile_search_bar">
                    <button class="navbar-toggle" id="toggle_button" data-toggle="collapse" data-target=".navbar-collapse" data-canvas="body" type="button" onclick="$('#mobile_search_bar').removeClass('active')" ;="">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <span class="jslogo jslogo-mobile visible-xs"></span>
                    <!--Mobile view search bar toggle btn-->
                    <div class="search-toggle">
                        <a href="#"><i class="icon-search navbar-brand visible-xs" id="mobile_search" onclick="$('#mobile_search_bar_menu').removeClass('in');"></i></a>
                    </div>
                    <!-- Mobile Search Bar Pop Up Menu -->
                    <div class="search-bar toggle">
                        <div class="container visible-xs">
                            <div class="col-xs-12">
                                <form id="frmSearch_mobile" name="frmSearch-mobile" action="{{URL::to('/jobsearch')}}" method="get">
                                    <div class="input-group mobile-search-input">
                                        <input id="hidden_omni_search_method" name="ojs" type="hidden" value="2">
                                        <input class="form-control" id="search_box_keyword_mobile" name="key" type="text" placeholder="Search Jobs By Title, Skills or Keywords...">
                                        <span class="input-group-btn">
															<a class="btn btn-default" id="header_searchbox_btn_mobile" type="button" onclick="_gaq.push(['_trackEvent', 'JSMY Personalized Homepage', 'Search button clicked', 'New Header']);">Search</a>
														</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Collapse Menu-->
                <div class="navbar-collapse collapse navbar-collapse-align" id="mobile_search_bar_menu">
                    <ul class="nav navbar-nav">
                        <li class="active"><a id="header_home_link" href="{{URL::to('/candidate/candidatehome/profile')}}" title="Leading Job Site in Malaysia - Find Jobs in Malaysia">Home</a></li>
                        <li><a id="header_job_link" href="{{URL::to('/jobsearch')}}" title="Search Jobs @ joBKonner">Search Jobs</a></li>                        
                    </ul>
                    <!-- Language Bar -->
                    <ul class="nav navbar-nav navbar-right navbar-align">
                        <!--Right Handed Menu from Name-->
                        <!--Dropdown Menu-->
                        <li class="dropdown">
                            <a class="dropdown-toggle header-login-box" id="header_login_menu" href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                                <span class="header-login-name">{{Session::get('user.firstname')}}</span>&nbsp;
                                <span><b class="caret"></b></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a id="header_logout_link" href="{{URL::to('/logout')}}">Logout</a></li>
                                <li><a class="visible-xs" id="header_change_password_link" href="#">Change Password</a></li>
                                <li><a class="hidden-xs" id="header_help_link" href="#">Help</a></li>
                                <li><a class="language-separator hidden-xs" id="header_update_account" href="{{URL::to('/candidate/candidatehome/profile')}}">My Account</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>      
    </div>
</div>
@stop