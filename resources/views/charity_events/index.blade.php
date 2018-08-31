@extends('layouts.main')
@section('content')
    <style>
        .charity_events{
            margin-bottom: 25%;
        }
    </style>
<div class="container charity_events">
    <div class="dynamic-row">
        <div class="col-md-8">
            <div class="card-default">
                <div class="card-header text-center">
                    <h4>We have the following events in our institution</h4>
                </div>
                <div class="card-body">

                        <table class="table table-hover">
                            <thead>
                            <th>
                                No
                            </th>
                            <th>
                                View
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Date
                            </th>
                            <th>
                                Action
                            </th>
                            </thead>
                            <tbody>
                            @foreach($event as $events)
                            <tr>
                                <td>{{$t_count++}}</td>
                                <td><img src='{{url("storage/charity_events/{$events->photo}")}}' height="100px"></td>
                                <td><strong>{{$events->name}}</strong></td>
                                <td> {{date('j-M-Y',strtotime( $events->date_of_event))}}</td>
                                <td><a href='{{url("/charity-events/read-more/{$events->id}")}}' class="btn btn-success">Read Details </a> </td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>

                </div>
            </div>
        </div>
    </div>
</div>
    @endsection