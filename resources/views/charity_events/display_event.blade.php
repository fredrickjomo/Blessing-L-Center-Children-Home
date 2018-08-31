@extends('layouts.main')
@section('content')
    <style>
        .charity_events{
            margin-bottom: 25%;
        }
    </style>
    <div class="container charity_events">
        <div class="dynamic-row">
            <div class="col-md-12">
                <div class="card-default">
                    <div class="card-header text-center">
                        <h4>{{$event->name}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6" style="padding: 0;">
                                <img src='{{url("storage/charity_events/{$event->photo}")}}' height="300px">
                            </div>
                            <div class="col-md-6">
                               <h4 style="text-decoration: underline;">Purpose of the event:</h4>
                                <p>{{$event->purpose}}.</p>
                                <h4 style="text-decoration: underline;">Scheduled On:</h4>
                                <p>{{date('j-M-Y',strtotime( $event->date_of_event))}}</p>
                                <h4 style="text-decoration: underline;">Venue:</h4>
                                <p>{{$event->venue}}</p>
                                <h4 style="text-decoration: underline;">Support Us Through:</h4>
                                <ul style="list-style-type: decimal; color:green;">
                                    <li><a href=""style=" color:green; font-size: 20px">Financial Assistance</a> </li>
                                    <li><a href=""style=" color:green; font-size: 20px" onclick="
                                    equipmentAssistance()">Equipment Assistance</a></li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <script>
            function equipmentAssistance() {
                window.open('{{url("/support-with-equipment")}}',"_blank","toolbar=yes,scrollbars=yes,resizable=yes,top=150,left=500,width=650,height=550");
            }
        </script>

    @endsection