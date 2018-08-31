@extends('layouts.admin')

@section('header')
    Terminate Sponsorship
@endsection
@section('page-icon')
    <i class="fa fa-handshake-o"></i>
    <i class="fa fa-trash"></i>
    @endsection

@section('content')
    <style>
        .sponsorship-list{
            font-family: Garamond;
        }
        table th{
            color: #0b97c4;

        }
    </style>
    <div class="sponsorship-list">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>
                    N0:
                </th>
                <th>
                    Photo
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
                    Sponsorship Ends On:
                </th>
                <th>Action</th>



            </tr>
            </thead>
            <tbody>
            @foreach($sponsorship as $sponsor)

                <tr>
                    <td>{{$count++}}</td>
                    <td><img src="/children_photo/{{$sponsor->photo}}" height="70px" width="70px" style="border-radius: 50%;" ></td>
                    <td>{{$sponsor->child_name}}</td>
                    <td>{{$sponsor->first_name}}&nbsp;{{$sponsor->last_name}}<br>-{{$sponsor->nationality}}</td>
                    <td>{{$sponsor->braintree_plan}}&nbsp;&#64;&nbsp;&#36. {{$sponsor->cost}}</td>

                    <td>{{date('j-M-Y',strtotime( $sponsor->created_at))}} at {{date('g:ia' ,strtotime($sponsor->created_at))}}</td>

                    <td>{{date('j-M-Y',strtotime( $sponsor->ends_at))}} at {{date('g:ia' ,strtotime($sponsor->ends_at))}}</td>
                    <td><a href='{{url("/terminateSponsorship/{$sponsor->braintree_id}")}}'><button class="btn btn-success">Terminate</button></a></td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

@endsection
