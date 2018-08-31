@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header text-center">
                        <h4>Our Children</h4>
                    </div>
                    <div class="card-body">
                        @foreach($children as $child)
                            <div class="row">

                                <div class="col-md-2">
                                    {{$number++}}
                                </div>
                                <div class="col-md-4">
                                    <img src='{{url("storage/children/{$child->photo}")}}' width="250px" height="250px" style="border-radius:50%">
                                </div>
                                <style>
                                    .col-md-6 h5{
                                        padding-bottom: 20px;
                                    }
                                </style>
                                <div class="col-md-6">
                                    <h5><b>Name:</b> {{$child->full_name}}</h5>
                                    <h5><b>Gender:</b> {{$child->gender}}</h5>
                                    <h5><b>Age:</b> {{now()->year-$child->year_of_birth}} years</h5>
                                    <h5><b>Vulnerability:</b> {{$child->vulnerability}}</h5>
                                    <h5><b>Education Level:</b> {{$child->education_level}}</h5>
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
        {{$children->links()}}
    </div>

@endsection