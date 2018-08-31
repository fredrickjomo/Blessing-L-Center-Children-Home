@extends('layouts.main')
@section('content')
    <style>
        .container{
            margin-top:3%;
            //margin-bottom: 20%;
        }
        .container table{
            margin-bottom: 20%;
        }
        .container h2{
            padding-bottom: 10px;
            color: #1b1e21;
        }
        .container img{
            height: 80px;
            width: 80px;
            border-radius: 10px;
        }
        table tr{
            padding: 0;
            margin: 0 auto;
        }
        .container .profile{
        height: 80px;
            width: 80px;
        }
        .col-12 h2{
            font-size: 17px;
        }

    </style>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-10 col-lg-10">
            <h2 style="font-weight: bold">Unsponsored Children Currently In Our Institution:</h2>
            <table class="col-12 table table-dark table-bordered table-hover">
                <thead>
                <tr>
                    <th>No:</th>
                    <th>Photo</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Vulnerability</th>
                    <th>Education Level</th>


                </tr>
                </thead>
                <tbody>

                    @foreach($children as $child)
                        <tr>

                    <td>{{$users++}}</td>
                    <td class="profile"><img src="/children_photo/{{$child->photo}}" alt="Photo"></td>
                    <td>{{$child->full_name}}</td>
                    <td>{{$child->gender}}</td>
                    <td>{{$child->age}}</td>
                    <td>{{$child->vulnerability}}</td>
                    <td>{{$child->education_level}}</td>
                       {{-- <td><a href='{{url("Sponsor/{$child->id}")}}'>Select</a></td>--}}


                </tr>

                        @endforeach


                </tbody>
            </table>

        </div>

    </div>


</div>


    @endsection