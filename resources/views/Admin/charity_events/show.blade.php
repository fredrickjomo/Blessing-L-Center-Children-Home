@extends('layouts.admin')
@section('header')
    Current Institution Events
    @endsection
@section('page-icon')
    <i class="fa fa-list"></i>
    @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                    <th>No</th>
                    <th>View</th>
                    <th>Name</th>
                    <th>Purpose/Description</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th></th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($events_list as $event)
                        <tr>
                            <td>{{$t_count++}}</td>
                            <td><img src='{{url("storage/charity_events/{$event->photo}")}}' height="100px"></td>
                            <td>{{$event->name}}</td>
                            <td>{{$event->purpose}}</td>
                            <td>{{$event->date_of_event}}</td>
                            <td>{{$event->venue}}</td>
                            <td><a href='{{url("/edit-event-information/{$event->id}")}}' class="btn btn-success"
                                onclick="return confirm('You are about to edit information for {{$event->name}}..Proceed?')">Edit</a> </td>
                            <td><a href='{{url("/remove-event/{$event->id}")}}' class="btn btn-danger"
                                onclick="return confirm('You are about to delete this event permanently, Are you sure you want to delete this event?')"
                                >Delete</a> </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$events_list->links() }}
            </div>
        </div>
    </div>

    @endsection