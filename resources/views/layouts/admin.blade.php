<!DOCTYPE html>
<html lang="en">

<head>
    <title>Administration-Blessing Learning Center</title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{asset('css/admin/images/blc1.jpg')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('css/admin/images/blc1.jpg')}}" type="image/x-icon">

    <!-- Font Awesome -->
    <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">


    <!-- iconfont -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/icon/icofont/css/icofont.css')}}">

    <!-- simple line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/icon/simple-line-icons/css/simple-line-icons.css')}}">

    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/plugins/bootstrap/css/bootstrap.min.css')}}">

    <!-- Weather css -->
    <link href="{{asset('css/admin/css/svg-weather.css')}}" rel="stylesheet">

    <!-- Echart js -->
    <script src="{{asset('css/admin/plugins/charts/echarts/js/echarts-all.js')}}"></script>

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/css/main.css')}}">

    <!-- Responsive.css-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/css/responsive.css')}}">

    <!--color css-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/css/color/color-1.min.css')}}" id="color"/>

</head>
<body class="sidebar-mini fixed">
<div class="loader-bg">
    <div class="loader-bar">
    </div>
</div>
<div class="wrapper">

    <style>
        .main-header-top{
            background-color: #1b1e21;
        }

    </style>
    <header class="main-header-top hidden-print">
        <a href="" class="logo"><img class="img-fluid able-logo" src="assets/images/logo1.png" alt="Blessing L Center"></a>
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button--><a href="#!" data-toggle="offcanvas" class="sidebar-toggle"></a>
            <!-- Navbar Right Menu-->
            <div class="navbar-custom-menu f-right">

                <ul class="top-nav">
                    <!--Notification Menu-->

                    <li class="dropdown pc-rheader-submenu message-notification search-toggle">
                        <a href="#!" id="morphsearch-search" class="drop icon-circle txt-white">
                            <i class="icofont icofont-search-alt-1"></i>
                        </a>
                    </li>
                    <li class="dropdown notification-menu">
                        <a href="#!" data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">
                            <i class="icon-bell"></i>
                            <span class="badge badge-danger header-badge">0</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="not-head">You have <b class="text-primary">...</b> new notifications.</li>
                            <li class="bell-notification">
                                <a href="javascript:;" class="media">
                                <span class="media-left media-icon">
                                    <img class="img-circle" src="profile_pictures/{{Auth::user()->photo}}" alt="User Image">
                                </span>
                                    <div class="media-body"><span class="block">Sponsorship Notification from {{Auth::user()->first_name}}</span><span class="text-muted block-time">2min ago</span></div></a>
                            </li>

                            <li class="not-footer">
                                <a href="#!">See all notifications.</a>
                            </li>
                        </ul>
                    </li>
                    <!-- chat dropdown -->
                    <li class="pc-rheader-submenu ">
                        <a href="#!" class="drop icon-circle displayChatbox">
                            <i class="icon-bubbles"></i>
                            <span class="badge badge-danger header-badge blink">5</span>
                        </a>

                    </li>
                    <!-- window screen -->
                    <li class="pc-rheader-submenu">
                        <a href="#!" class="drop icon-circle" onclick="javascript:toggleFullScreen()">
                            <i class="icon-size-fullscreen"></i>
                        </a>

                    </li>
                    <!-- User Menu-->
                    <li class="dropdown">
                        <a href="#!" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle drop icon-circle drop-image">
                            <span><img class="img-circle " src="/profile_pictures/{{Auth::user()->photo}}" style="width:40px;" alt="User Image"></span>
                            <span>{{Auth::user()->first_name}}&nbsp;<b>{{Auth::user()->last_name}}</b> <i class=" icofont icofont-simple-down"></i></span>

                        </a>
                        <ul class="dropdown-menu settings-menu">
                            <li><a href="#!"><i class="icon-settings"></i> Settings</a></li>
                            <li><a href="#"><i class="icon-user"></i> Profile</a></li>
                            <li><a href="#"><i class="icon-envelope-open"></i> My Messages</a></li>
                            <li class="p-0">
                                <div class="dropdown-divider m-0"></div>
                            </li>
                            <li><a href="#"><i class="icon-lock"></i> Lock Screen</a></li>
                            <li> <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form></li>

                        </ul>
                    </li>
                </ul>
{{--
                <!-- search -->
                <div id="morphsearch" class="morphsearch">
                    <form class="morphsearch-form">

                        <input class="morphsearch-input" type="search" placeholder="Search..."/>

                        <button class="morphsearch-submit" type="submit">Search</button>

                    </form>
                    <div class="morphsearch-content">
                        <div class="dummy-column">
                            <h2>People</h2>
                            <a class="dummy-media-object" href="#!">
                                <img class="round" src="http://0.gravatar.com/avatar/81b58502541f9445253f30497e53c280?s=50&d=identicon&r=G" alt="Sara Soueidan"/>
                                <h3>Sara Soueidan</h3>
                            </a>

                            <a class="dummy-media-object" href="#!">
                                <img class="round" src="http://1.gravatar.com/avatar/9bc7250110c667cd35c0826059b81b75?s=50&d=identicon&r=G" alt="Shaun Dona"/>
                                <h3>Shaun Dona</h3>
                            </a>
                        </div>
                        <div class="dummy-column">
                            <h2>Popular</h2>
                            <a class="dummy-media-object" href="#!">
                                <img src="assets/images/avatar-1.png" alt="PagePreloadingEffect"/>
                                <h3>Page Preloading Effect</h3>
                            </a>

                            <a class="dummy-media-object" href="#!">
                                <img src="assets/images/avatar-1.png" alt="DraggableDualViewSlideshow"/>
                                <h3>Draggable Dual-View Slideshow</h3>
                            </a>
                        </div>
                        <div class="dummy-column">
                            <h2>Recent</h2>
                            <a class="dummy-media-object" href="#!">
                                <img src="assets/images/avatar-1.png" alt="TooltipStylesInspiration"/>
                                <h3>Tooltip Styles Inspiration</h3>
                            </a>
                            <a class="dummy-media-object" href="#!">
                                <img src="assets/images/avatar-1.png" alt="NotificationStyles"/>
                                <h3>Notification Styles Inspiration</h3>
                            </a>
                        </div>
                    </div><!-- /morphsearch-content -->
                    <span class="morphsearch-close"><i class="icofont icofont-search-alt-1"></i></span>
                </div>
                --}}
                <!-- search end -->
            </div>
        </nav>
    </header>
    <!-- Side-Nav-->
    <aside class="main-sidebar hidden-print " >
        <section class="sidebar" id="sidebar-scroll">

            <div class="user-panel">
                <div class="f-left image"><img src="/profile_pictures/{{Auth::user()->photo}}" alt="User Image" class="img-circle"></div>
                <div class="f-left info">
                    <p>{{Auth::user()->first_name.' '.Auth::user()->last_name}}</p>
                    <p class="designation">Administrator<i class="icofont icofont-caret-down m-l-5"></i></p>
                </div>
            </div>
            <!-- sidebar profile Menu-->
            <ul class="nav sidebar-menu extra-profile-list">
                <li>
                    <a class="waves-effect waves-dark" href="profile.html">
                        <i class="icon-user"></i>
                        <span class="menu-text">View Profile</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="javascript:void(0)">
                        <i class="icon-settings"></i>
                        <span class="menu-text">Settings</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="javascript:void(0)">
                        <i class="icon-logout"></i>
                        <span class="menu-text">Logout</span>
                        <span class="selected"></span>
                    </a>
                </li>
            </ul>
            <!-- Sidebar Menu-->
            <ul class="sidebar-menu">
                <li class="nav-level">GENERAL</li>
                <li class="active treeview">
                    <a class="waves-effect waves-dark" href="{{route('Admin.index')}}">
                        <i class="fa fa-home"></i><span> Home</span>
                    </a>
                </li>
                <li class="nav-level"><i class="fa fa-wrench"></i>&nbsp;&nbsp;COMPONENTS</li>

                <!-- start of staff link-->

                <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-briefcase"></i><span> Staff</span><i class="icon-arrow-down"></i></a>
                    <ul class="treeview-menu">
                        <li><a class="waves-effect waves-dark" href="{{route('Admin.viewStaff')}}"><i class="icon-arrow-right"></i> View Staff</a></li>
                        <li><a class="waves-effect waves-dark" href="{{route('Admin.addStaff')}}"><i class="icon-arrow-right"></i> Add New Member</a></li>
                    </ul>
                </li>

                <!--End of staff link-->

                <!--Start of Children link-->

                <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-chart"></i><span> Children </span><span class="label label-success menu-caption">Children</span><i class="icon-arrow-down"></i></a>
                    <ul class="treeview-menu">
                        <li><a class="waves-effect waves-dark" href="{{route('Admin.viewChild')}}"><i class="icon-arrow-right"></i> View Children List</a></li>
                        <li><a class="waves-effect waves-dark" href="{{route('Admin.addChild')}}"><i class="icon-arrow-right"></i> Add New Child</a></li>
                        {{--<li><a class="waves-effect waves-dark" href="{{route('Admin.editChild')}}"><i class="icon-arrow-right"></i>  Edit/Update Child Information</a></li>--}}
                        {{--<li><a class="waves-effect waves-dark" href="{{route('Admin.deleteChild')}}"><i class="icon-arrow-right"></i> Remove Child</a></li>--}}
                    </ul>
                </li>

                <!--End of Children link-->

                <!--Start of Sponsorships link-->

                <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-book-open"></i><span> Sponsorships</span><i class="icon-arrow-down"></i></a>
                    <ul class="treeview-menu">
                        <li><a class="waves-effect waves-dark" href="{{route('active')}}"><i class="icon-arrow-right"></i> Active Sponsorships</a></li>
                        <li><a class="waves-effect waves-dark" href="{{route('basic_plan')}}"><i class="icon-arrow-right"></i>Basic Plan I($.30) Sponsorships</a></li>
                        <li><a class="waves-effect waves-dark" href="{{route('basic_plan_II')}}"><i class="icon-arrow-right"></i>Basic Plan II($.50) Sponsorships</a></li>
                        <li><a class="waves-effect waves-dark" href="{{route('annual_plan')}}"><i class="icon-arrow-right"></i> Annual Plan ($.600) Sponsorships</a></li>
                        <li><a class="waves-effect waves-dark" href="{{route('inactive')}}"><i class="icon-arrow-right"></i> Inactive Sponsorships</a></li>
                        <li><a class="waves-effect waves-dark" href="{{route('cancelled')}}"><i class="icon-arrow-right"></i> Cancelled Sponsorships</a></li>
                        <li><a class="waves-effect waves-dark" href="{{route('sponsored-children')}}"><i class="icon-arrow-right"></i> Sponsored Children</a></li>
                        <li><a class="waves-effect waves-dark" href="{{route('terminate')}}"><i class="icon-arrow-right"></i> Terminate Sponsorship</a></li>
                    </ul>
                </li>

                <!--End of Sponsorships link-->

                <!--Start of Payments link-->

                <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="fa fa-money"></i><span> Payments</span><i class="icon-arrow-down"></i></a>
                    <ul class="treeview-menu">
                        <li><a class="waves-effect waves-dark" href="{{route('view_payment')}}"><i class="icon-arrow-right"></i>Sponsorship Payments</a></li>
                        <li><a class="waves-effect waves-dark" href="{{url('/update-sponsorship-payments')}}"><i class="icon-arrow-right"></i> Update Sponsorship Payments</a></li>
                        <li><a class="waves-effect waves-dark" href="#"><i class="icon-arrow-right"></i> Update Events Amount</a></li>
                        <li><a class="waves-effect waves-dark" href="#"><i class="icon-arrow-right"></i> Update Project Amount</a></li>
                    </ul>
                </li>

                <!--End of Payments link-->

                <!--Start of Projects link-->

                <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="fa fa-laptop"></i><span> Projects</span><i class="icon-arrow-down"></i></a>
                    <ul class="treeview-menu">
                        <li><a class="waves-effect waves-dark" href="{{route('view_projects')}}"><i class="icon-arrow-right"></i> View Projects</a></li>
                        <li><a class="waves-effect waves-dark" href="{{route('add_project')}}"><i class="icon-arrow-right"></i> Add New Project</a></li>
                    </ul>
                </li>

                <!--End of Projects link-->

                <!--Start of Events link-->

                <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="fa fa-clone"></i><span> Events</span><i class="icon-arrow-down"></i></a>
                    <ul class="treeview-menu">
                        <li><a class="waves-effect waves-dark" href="{{route('view_events')}}"><i class="icon-arrow-right"></i> View Events</a></li>
                        <li><a class="waves-effect waves-dark" href="{{route('add_event')}}"><i class="icon-arrow-right"></i>  Add Event</a></li>
                    </ul>
                </li>

                <!--End of Events link-->


                <li class="nav-level"><i class="fa fa-windows"></i>&nbsp;&nbsp;EXTRAS</li>

                <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-calendar"></i><span>Calendar</span></a>
                <li class="treeview"><a class="waves-effect waves-dark" href="#!"><i class="icon-calendar"></i><span>Charts</span></a>

                </li>





            </ul>
        </section>
    </aside>
    <!-- Sidebar chat start -->
    <div id="sidebar" class="p-fixed header-users showChat">
        <div class="had-container">
            <div class="card card_main header-users-main">
                <div class="card-content user-box">

                    <div class="md-group-add-on p-20">
                           <span class="md-add-on">
                            <i class="icofont icofont-search-alt-2 chat-search"></i>
                        </span>
                        <div class="md-input-wrapper">
                            <input type="text" class="md-form-control"  name="username" id="search-friends">
                            <label>Search</label>
                        </div>

                    </div>
                    <div class="media friendlist-main">

                        <h6>Friend List</h6>

                    </div>
                    <div class="main-friend-list">
                        <div class="media friendlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">

                            <a class="media-left" href="#!">
                                <img class="media-object img-circle" src="assets/images/avatar-1.png" alt="Generic placeholder image">
                                <div class="live-status bg-success"></div>
                            </a>
                            <div class="media-body">
                                <div class="friend-header">Josephin Doe</div>
                                <span>20min ago</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="showChat_inner">
        <div class="media chat-inner-header">
            <a class="back_chatBox">
                <i class="icofont icofont-rounded-left"></i> Josephin Doe
            </a>
        </div>
        <div class="media chat-messages">
            <a class="media-left photo-table" href="#!">
                <img class="media-object img-circle m-t-5" src="assets/images/avatar-1.png" alt="Generic placeholder image">
                <div class="live-status bg-success"></div>
            </a>
            <div class="media-body chat-menu-content">
                <div class="">
                    <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                    <p class="chat-time">8:20 a.m.</p>
                </div>
            </div>
        </div>

        <div class="media chat-reply-box">
            <div class="md-input-wrapper">
                <input type="text" class="md-form-control" id="inputEmail" name="inputEmail" >
                <label>Share your thoughts</label>
                <span class="highlight"></span>
                <span class="bar"></span>  <button type="button" class="chat-send waves-effect waves-light">
                    <i class="icofont icofont-location-arrow f-20 "></i>
                </button>

                <button type="button" class="chat-send waves-effect waves-light">
                    <i class="icofont icofont-location-arrow f-20 "></i>
                </button>
            </div>

        </div>
    </div>
    <!-- Sidebar chat end-->
    <div class="content-wrapper">

        <!-- Container-fluid starts -->
        <!-- Main content starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="main-header">
                    <h4>Admin Dashboard</h4>
                </div>
            </div>
            <!-- 4-blocks row start -->
            <div class="row m-b-30 dashboard-header">

                <!--Dashboard items-->
                <style>
                    .dashboard-product{
                        height: 110px;
                    }
                </style>
                <div class="col-lg-2 col-sm-6">
                    <div class="col-sm-12 card dashboard-product">
                        <span>Total Users</span>
                        <h2 class="dashboard-total-products counter">{{$users}}</h2>
                        <div class="side-box bg-warning">
                            <i class="fa fa-user"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-6">
                    <div class="col-sm-12 card dashboard-product">
                        <span>Total Children</span>
                        <h2 class="dashboard-total-products counter">{{$children}}</h2>
                        <div class="side-box bg-primary">
                            <i class="icon-social-soundcloud"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="col-sm-12 card dashboard-product">
                        <span>Total Projects</span>
                        <h2 class="dashboard-total-products">
                            <span class="counter">{{$projects}}</span></h2>
                        <div class="side-box bg-success">
                            <i class="icon-bubbles"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-6">
                    <div class="col-sm-12 card dashboard-product">
                        <span>Total Events</span>
                        <h2 class="dashboard-total-products"><span class="counter">{{$events}}</span></h2>
                        <div class="side-box bg-danger">
                            <i class="icon-bubbles"></i>
                        </div>
                    </div>
                </div>


                <div class="col-lg-2 col-sm-6">
                    <div class="col-sm-12 card dashboard-product">
                        <span> Sponsorships</span>
                        <h2 class="dashboard-total-products"><span class="counter">{{$activeSponsorship}}</span></h2>
                        <div class="side-box bg-danger">
                            <i class="icon-bubbles"></i>
                        </div>
                    </div>
                </div>


                <div class="col-lg-2 col-sm-6">
                    <div class="col-sm-12 card dashboard-product">
                        <span>Staff Members</span>
                        <h2 class="dashboard-total-products"><span class="counter">nan</span></h2>
                        <div class="side-box bg-success">
                            <i class="icon-bubbles"></i>
                        </div>
                    </div>
                </div>

            </div>
            <!-- 4-blocks row end -->
            <!-- 1-3-block row start -->
            <div class="row">
                <div class="col-lg-10 col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="row m-b-10 dashboard-total-income">
                                <div class="col-sm-11 text-center">
                                    <div class="counter-txt">
                                        <h6>@yield('header')</h6>
                                        <hr>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    @yield('page-icon')

                                </div>
                            </div>
                        </div>
                        <div class="card-block row">
                            @include('flash::message')
                            @include('partials.success')
                            @include('partials.errors')
                            <div class="col-sm-12">
                                <div id="content-area">@yield('content')</div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-lg-2 col-md-6">

                </div>
                <div class="col-lg-2 col-md-6">

                </div>
            </div>
            <!-- 1-3-block row end -->


            <!-- 2-1 block start -->
            <div class="row">


                <div class="col-xl-4 col-lg-12">
                    <div class="card">


                    </div>
                </div>
            </div>
            <!-- 2-1 block end -->
            <div class="fixed-button">
                <a href="#" class="btn btn-md btn-primary">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Blessing Learning Center
                </a>
            </div>
        </div>


        <!-- Main content ends -->
        <!-- Container-fluid ends -->

    </div>
</div>


<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 9]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->

<!-- Required Jqurey -->
<script src="{{asset('css/admin/plugins/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('css/admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('css/admin/plugins/tether/dist/js/tether.min.js')}}"></script>

<!-- Required Fremwork -->
<script src="{{asset('css/admin/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- waves effects.js -->
<script src="{{asset('css/admin/plugins/Waves/waves.min.js')}}"></script>

<!-- Scrollbar JS-->
<script src="{{asset('css/admin/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
<script src="{{asset('css/admin/plugins/jquery.nicescroll/jquery.nicescroll.min.js')}}"></script>

<!--classic JS-->
<script src="{{asset('css/admin/plugins/classie/classie.js')}}"></script>

<!-- notification -->
<script src="{{asset('css/admin/plugins/notification/js/bootstrap-growl.min.js')}}"></script>

<!-- Rickshaw Chart js -->
<script src="{{asset('css/admin/plugins/d3/d3.js')}}"></script>
<script src="{{asset('css/admin/plugins/rickshaw/rickshaw.js')}}"></script>

<!-- Sparkline charts -->
<script src="{{asset('css/admin/plugins/jquery-sparkline/dist/jquery.sparkline.js')}}"></script>

<!-- Counter js  -->
<script src="{{asset('css/admin/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('css/admin/plugins/countdown/js/jquery.counterup.js')}}"></script>

<!-- custom js -->
<script type="text/javascript" src="{{asset('js/admin/js/main.min.js')}}"></script>
<script type="text/javascript" src="{{asset('css/admin/pages/dashboard.js')}}"></script>
<script type="text/javascript" src="{{asset('css/admin/pages/elements.js')}}"></script>
<script src="{{asset('js/admin/js/menu.min.js')}}"></script>

<script>
    var $window = $(window);
    var nav = $('.fixed-button');
    $window.scroll(function(){
        if ($window.scrollTop() >= 200) {
            nav.addClass('active');
        }
        else {
            nav.removeClass('active');
        }
    });
</script>
</body>

</html>
