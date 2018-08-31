@extends('layouts.main')
@section('content')
    <style>
        .subscriptions{
            margin-top: 5%;
            margin-bottom: 20%;
        }
    </style>
    <div class="container subscriptions">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card card-default">
                    <div class="card-header text-center"><strong>Manage My Applications</strong></div>

                    <div class="card-body">
                   <table class="table table-stripped">
                       <thead>
                       <th>No:</th>
                       <th>Type</th>
                       <th>Status</th>
                       <th>Payment Method</th>
                       <th>Action</th>
                       </thead>
                       <tbody>
                       @foreach($applications as $application)
                       <tr>
                           <td>{{$number}}</td>
                           <td>Sponsorship</td>
                           <td>{{$application->sponsorship_status}}</td>
                           <td>{{$application->payment_method}}</td>
                           <td><a href="" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this application?')">Remove</a> </td>
                       </tr>
                           @endforeach
                       </tbody>

                   </table>



                        ...
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection