@extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="{{asset('css/custom-css/my-profile.css')}}">
    <h1>YOUR PROFILE</h1>

    <div class="container">
        <div class="row alert alert-dark">
            <div class="col-md-4"> <img src='{{url("storage/profile/$user->photo")}}'></div>
            <div class="col-md-4">
                <div class="alert alert-success second-div">
                    <h4>Account Information</h4>
                    Name:&nbsp;{{Auth::user()->first_name}} &nbsp; {{Auth::user()->last_name}}<br><br>
                Gender:&nbsp;{{Auth::user()->gender}}<br><br>
                    Nationality:&nbsp;{{Auth::user()->nationality}}<br><br>
                    Email:&nbsp;{{Auth::user()->email}}<br><br>
                    Account Created On:&nbsp;{{Auth::user()->created_at}}<br><br>
                    Last Update:&nbsp;{{Auth::user()->updated_at}}<br><br>
                    <div class="alert alert-primary">Thank you for being part of us</div>
                    <a href='{{url("/edit-my-profile/{$user->id}")}}'><button class="btn btn-primary">Edit Your Profile</button></a>

                </div>
            </div>

        </div>


    </div>



    @endsection