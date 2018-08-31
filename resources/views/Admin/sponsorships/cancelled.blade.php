@extends('layouts.admin')

@section('header')
   Cancelled Sponsorships
@endsection

@section('page-icon')
    <i class="fa fa-handshake-o"></i>

    @endsection

@section('content')
    <style>
        .inactive-sponsorships{
            font-family: Garamond;
        }
        table th{
            color: #0b97c4;

        }
    </style>
    <div class="inactive-sponsorships">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>
                    N0:
                </th>
                <th>
                    Child Photo
                </th>
                <th>
                    Child Name
                </th>
                <th>
                    Sponsor Name and Country
                </th>
                <th>
                    Sponsorship Plan
                </th>
                <th>
                    Sponsorship Started On:
                </th>
                <th>
                    Sponsorship Cancelled On:
                </th>



            </tr>
            </thead>
            <tbody>
            @foreach($sponsorship as $sponsor)
            <tr>
                <td>{{$count++}}</td>
                <td><img src="/children_photo/{{$sponsor->photo}}" height="70px" width="70px" style="border-radius: 50%;" ></td>
                <td>{{$sponsor->child_name}}</td>
                <td>{{$sponsor->first_name}}&nbsp;{{$sponsor->last_name}}<br>-{{$sponsor->nationality}}</td>
                <td>Null</td>
                <td>Null</td>
                <td>Null</td>
            </tr>
            @endforeach
            </tbody>

        </table>

    </div>

@endsection
