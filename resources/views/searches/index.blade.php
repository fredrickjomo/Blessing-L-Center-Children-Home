<title>Search Results-{{$keyword}}</title>
@extends('layouts.main')
@section('content')
    <style>
    .search{
    margin-bottom: 20%;
    }
    </style>
    <div class="container search">
    <div class="card-default col-md-8">
        <div class="card-header text-center" style="background-color: #0b97c4"><h6>Search Results for "{{$keyword}}"</h6></div>
        <div class="card-body">
            <table class="table table-stripped">
                <thead>
                <th>No:</th>
                <th>Name</th>
                <th>Age</th>
                <th>Education</th>
                <th>Vunerability</th>
                <th>Sponsorship</th>
                </thead>
                <tbody>
                @foreach($child as $child_search)
                <tr>
                    <td>{{$count++}}</td>
                    <td>{{$child_search->full_name}}</td>
                    <td>{{$child_search->age}}</td>
                    <td>{{$child_search->education_level}}</td>
                    <td>{{$child_search->vulnerability}}</td>

                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
        <div class="row text-center" style="margin-left: 23%">
            <div class="col-lg-12">
                <ul class="pagination">
                    {!! $child->links() !!}
                </ul>
            </div>
        </div>
    </div>

    @endsection