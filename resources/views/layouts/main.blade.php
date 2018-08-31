<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('css/admin/images/blc1.jpg')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom-css/main.css')}}">
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('PaymentFont/css/paymentfont.min.css')}}">

    <title>{{ config('app.name', 'Blessing Learning Centre') }}</title>


</head>
<body><h2 class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark col-12 col-md-12"><a href="{{url('/')}}"> Blessing Learning Centre and Children Home</a></h2>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>Menu
    </button>



    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/AboutUs')}}" style="color: white;"><i class="fa fa-info-circle" aria-hidden="true"></i> About Us</a>
            </li>

            <li class="nav-item dropdown">
                <a style="color: white;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-services" aria-hidden="true"></i>
                    <i class="fa fa-cog"></i> Services
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('Sponsor.index')}}">Sponsorship</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('adoption')}}">Adoption</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('donations.index')}}">Donation</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('charity_events')}}">Charity Event(s)</a>
                </div>

            </li>
            <li class="nav-item">
                <a style="color: white;" class="nav-link" href="/Contact_Us"><i class="fa fa-phone" aria-hidden="true"></i> Contact US</a>
            </li>
            <li class="nav-item">
                <a style="color: white;" class="nav-link" href="donations"><i class="fa fa-heart-o" aria-hidden="true"></i> Donate</a>
            </li>

            @guest
                <li><a style="color: white;" class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
                <li><a style="color: white;" class="nav-link" href="{{ route('register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a></li>
            @else
                <li class="nav-item dropdown">
                    <a style="color: white;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->first_name.' '.Auth::user()->last_name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="profile-image" src='{{url("storage/profile/$user->photo")}}'> <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="{{url('check-my-Applications')}}">
                           <i class="fa fa-cubes" aria-hidden="true"></i> My Applications
                        </a>
                        @if(Auth::user()->subscribed('main'))
                        <a class="dropdown-item" href="{{url('/subscriptions')}}">
                            <i class="fa fa-handshake-o" aria-hidden="true"></i> My Subscriptions
                        </a>
                        @endif
                        <a class="dropdown-item" href=""><i class="fa fa-envelope" aria-hidden="true"></i>
                            Messages
                        </a>
                        <a class="dropdown-item" href="{{url('/changePassword')}}"><i class="fa fa-lock" aria-hidden="true"></i>
                            Change Password
                        </a>
                        <a class="dropdown-item" href="{{url('/check-my-profile')}}">
                            <i class="fa fa-user" aria-hidden="true"></i> My Profile
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
        <form class="form-inline my-2 my-lg-0" action="{{url('/search-child')}}" method="post">
            {{csrf_field()}}
            <input autocomplete="off" id="search" class="form-control mr-sm-2 " type="search" placeholder="Search Child" aria-label="Search" name="keyword" required>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<div class="container-fluid">
    <div class="partials">
        <br>
    @include('partials.errors')
    @include('partials.success')
        @include('flash::message')
    </div>
    @yield('content')
    @yield('braintree')
</div>

<script src="{{asset('js/app.js') }}"></script>
<script src="{{asset('js/jquery-3.2.1.js')}}"></script>
<script src="{{asset('js/typeahead/dist/typeahead.bundle.js')}}"></script>
</body>

<hr>
<footer>
    <div class="container">
        <div class="row">

            <div class="col-6 col-md-4">
                <div class="footer-box">
                    <h3>Services Provided</h3>
                    <ul>

                        <li><a href="{{route('Sponsor.index')}}">Sponsorship</a></li>
                        <li><a href="#">Adoption</a></li>
                        <li><a href="{{route('donations.index')}}">Donation</a></li>

                    </ul>
                </div>
                <div class="footer-box">
                    <h3> Other Services</h3>
                    <ul>
                        <li><a href="{{route('charity_events')}}">Charity Event(s)</a></li>
                    </ul>
                </div>

            </div>

            <div class="col-6 col-md-4">
                <div class="footer-box">
                    <h3>Information</h3>
                    <ul>


                        <li><a href="{{route('our_staff')}}">Our Staff</a></li>
                        <li><a href="{{route('our_children')}}">Our Children</a></li>
                        <li><a href="{{route('projects')}}">Support Our Projects</a></li>


                    </ul>
                </div>

            </div>
            <div class="col-6 col-md-4">
                <div class="footer-box">
                    <h3>Contact Us</h3>
                    <ul>
                        <li><i class="fa fa-phone"> Telephone: +254720 203 229</i></li>
                        <li><i class="fa fa-envelope"> Email: magret_ogol@yahoo.com</i></li>
                    </ul>
                    <div class="social_media">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i> Facebook</a></li>
                            <li><a href="#"><i class="fa fa-youtube-square" aria-hidden="true"></i> You tube</a></li>
                            <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i> Twitter</a></li>
                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> Instagram</a></li>
                        </ul>

                    </div>

                </div>

            </div>





        </div>

    </div>
</footer>
<hr>
<div class="container-fluid " id="copyright">&COPY;2018-Blessing Learning Centre And Children Home</div>
</html>