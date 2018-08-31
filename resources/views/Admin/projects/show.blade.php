@extends('layouts.admin')
@section('header')
    Current Institution projects
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
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th></th>
                    <th></th>
                    </thead>
                    <tbody>
                    @foreach($project as $project_details)
                        <tr>
                            <td>{{$t_count++}}</td>
                            <td><img src='{{url("storage/projects/{$project_details->photo}")}}' height="100px"></td>
                            <td>{{$project_details->name}}</td>
                            <td>{{$project_details->purpose}}</td>
                            <td>{{date('j-M-Y',strtotime( $project_details->start_date))}}</td>
                            <td>{{$project_details->duration}} &nbsp; i.e {{date('j-M-Y',strtotime( $project_details->end_date))}}</td>
                            <td><a href='{{url("/edit-projects-information/{$project_details->id}")}}' class="btn btn-success"
                                   onclick="return confirm('You are about to edit information for {{$project_details->name}}..Proceed?')">Edit</a> </td>
                            <td><a href='{{url("/remove-projects/{$project_details->id}")}}' class="btn btn-danger"
                                   onclick="return confirm('You are about to delete this project permanently, Are you sure you want to delete this projects?')"
                                >Delete</a> </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection