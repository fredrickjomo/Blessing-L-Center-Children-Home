@extends('layouts.admin')

@section('header')
    Children Currently In The Institution:

@endsection
@section('page-icon')
    <i class="fa fa-list"></i>
    @endsection

@section('content')

    <style>
        * {
            box-sizing: border-box;
        }

        form.example input[type=text] {
            padding: 10px;
            font-size: 17px;
            border: 1px solid grey;
            float: left;
            width: 20%;
            background: #f1f1f1;
        }

        form.example button {
            float: left;
            width: 5%;
            height: 43px;
            padding: 10px;
            background-color: #0a2b1d;
            color: white;
            font-size: 17px;
            border: 1px solid grey;
            border-left: none;
            cursor: pointer;
        }

        .table form.example button:hover {
            background: #0b7dda;
        }

        form.example::after {
            content: "";
            clear: both;
            display: table;
        }
        .profile{
            height: 80px;
            width: 80px;
            padding: 0;
        }
        .profile img{
            height: 80px;
            width: 80px;
            padding: 0;
        }

        .children{
            font-family: Garamond;
            font-size: 15px;
        }
        table th {
            color: #0b97c4;
        }

    </style>
    <div class="children">
    <table class="col-12 table table-striped table-bordered">

        <form  action="{{url('search_child')}}">
            <div class="inner-addon right-addon">
                <button class="fa fa-search" type="submit"></button>

            <input type="search" autocomplete="off" placeholder="search child">
            {{--<input autocomplete="off" type="text" class="form-control mr-sm-2 col-md-2" placeholder="Search.." name="keyword">
            <button type="submit" class="form-control mr-sm-2"><i class="fa fa-search "></i></button>
            --}}
            </div>
        </form>

        <thead>
        <tr>
            <th>No:</th>
            <th>Photo</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Vulnerability</th>
            <th>Education Level</th>
            <th></th>
            <th></th>

        </tr>
        </thead>
        <tbody>

        @foreach($children_details as $child)
            <tr>

                <td>{{$t_count++}}</td>
                <td class="profile"><img src='{{url("storage/children/{$child->photo}")}}' alt="Photo" style="border-radius: 50%;"></td>
                <td>{{$child->full_name}}</td>
                <td>{{$child->gender}}</td>
                <td>{{now()->year-$child->year_of_birth}} years</td>
                <td>{{$child->vulnerability}}</td>
                <td>{{$child->education_level}}</td>
                <td><a href="{{route('children.edit',$child->id)}}" class="btn btn-success" onclick="return confirm('Edit {{$child->full_name}} information?')">Edit</a> </td>
                <td><a href='{{url("admin/child-delete/{$child->id}")}}' class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this child?. This action cannot be undone.')">Delete</a> </td>

            </tr>
        @endforeach

        </tbody>
    </table>
        <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
               {!! $children_details->links(); !!}
            </li>

        </ul>

    </div>
@endsection