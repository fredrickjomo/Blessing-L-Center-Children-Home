@extends('layouts.main')
@section('content')
    <style>
        .projects {
            margin-bottom: 20%;
        }
        .projects .row .col-md-12 .card{
            padding: 0;
        }
    </style>
    <div class="container-fluid projects">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h2 class="text-center" style="color: black">Our Projects</h2>
                    </div>
                    <div class="card-body">

                        <div id="slideIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#slideIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#slideIndicators" data-slide-to="1"></li>
                                <li data-target="#slideIndicators" data-slide-to="2"></li>
                            </ol>

                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src='{{url("storage/projects/hands-of-hope.png")}}' height="500px" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h4 style="color: black">Scroll through to view our projects</h4>
                                        <p style="color: black">Support any of our projects</p>
                                    </div>
                                </div>
                                @foreach($projects as $project)
                                <div class="carousel-item">
                                    <img class="d-block w-100" src='{{url("storage/projects/{$project->photo}")}}' height="500px" alt="Project image">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h4>{{$project->name}} ({{date('j-M-Y',strtotime( $project->start_date))}} to {{date('j-M-Y',strtotime( $project->end_date))}})</h4>
                                        <h4>Purpose: {{$project->purpose}}</h4>
                                        <p><a href='{{url("/support/project/{$project->id}")}}' class="btn btn-success" target="_blank">Support this Project</a></p>
                                    </div>
                                </div>
                                    @endforeach

                            </div>

                            <a class="carousel-control-prev" href="#slideIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#slideIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection