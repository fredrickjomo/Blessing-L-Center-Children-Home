@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header text-center">
                        <h4>Our Staff</h4>
                    </div>
                    <div class="card-body">
                        @foreach($staff as $staff_member)
                        <div class="row">

                            <div class="col-md-2">
                            {{$number++}}
                            </div>
                            <div class="col-md-4">
                                <img src='{{url("storage/staff/{$staff_member->photo}")}}' width="250px" height="250px" style="border-radius:50%">
                            </div>
                            <style>
                                .col-md-6 h5{
                                    padding-bottom: 20px;
                                }
                            </style>
                            <div class="col-md-6">
                                <h5><b>Name:</b> {{$staff_member->first_name}}&nbsp;{{$staff_member->middle_name}}&nbsp;{{$staff_member->last_name}}</h5>
                                <h5><b>Gender:</b> {{$staff_member->gender}}</h5>
                                <h5><b>Age:</b> {{now()->year-$staff_member->year_of_birth}} years</h5>
                                <h5><b>Position:</b> {{$staff_member->position}}</h5>
                            </div>


                        </div>
                        <br>
                            <hr>
                            <br>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
        {{$staff->links()}}
    </div>

    @endsection