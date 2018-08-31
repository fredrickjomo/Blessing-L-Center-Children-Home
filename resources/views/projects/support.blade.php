<title>support {{$project->name}}</title>
@extends('layouts.main')
@section('content')
    <style>
        .support {
            margin-bottom: 20%;
        }
    </style>
    <div class="container-fluid support">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h2 class="text-center" style="color: black">Support "{{$project->name}}" Project</h2>
                    </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src='{{url("storage/projects/{$project->photo}")}}' width="100%">
                        </div>
                        <div class="col-md-6">
                            <h4><b>Name:</b> {{$project->name}}</h4><br>
                            <h4><b>Purpose:</b> {{$project->purpose}}</h4><br>
                            <h4><b>Start Date:</b> {{date('j-M-Y',strtotime( $project->start_date))}}</h4><br>
                            <h4><b>End Date:</b> {{$project->duration}}&nbsp;({{date('j-M-Y',strtotime( $project->end_date))}})</h4>
                            <br>
                            <style>
                                .alert-secondary ul li{
                                    list-style-type: decimal;
                                    padding-bottom: 15px;

                                }
                                .alert-secondary ul li a{
                                    color: green;
                                    font-weight: bold;
                                }
                            </style>
                            <div class="alert alert-success">
                                <div class="alert alert-secondary">
                                    <h4>Support this project financially</h4>
                                    <h5>Support Via:</h5>
                                    <ul>
                                        <li>
                                          <a href="">Card (Master Card, Visa Card, etc).</a>
                                        </li>
                                        <li><a href="">PayPal.</a>
                                        <li><a href="" onclick="return bank_support()">Bank Transfer.</a> </li>
                                    </ul>
                                </div>

                            </div>
                            <script>
                                function  bank_support() {
                                    window.open('{{url("/support/project/bank-support/{$project->id}")}}',"_blank","toolbar=yes,scrollbars=yes,resizable=yes,top=150,left=500,width=650,height=550")
                                }
                            </script>

                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection