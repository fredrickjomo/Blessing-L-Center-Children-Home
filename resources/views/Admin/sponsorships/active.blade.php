@extends('layouts.admin')
<style>
    .sponsorship-list{
        font-family: Garamond;
    }
    table th{
        color: #0b97c4;

    }
</style>

@section('header')
    Active Sponsorships
@endsection
@section('page-icon')
    <i class="fa fa-handshake-o"></i>
    @endsection
@section('content')
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

            <td>{{date('j-M-Y',strtotime(Carbon\Carbon::parse($sponsor->created_at)->addYears($sponsor->period)))}} at
                {{date('g:ia',strtotime(Carbon\Carbon::parse($sponsor->created_at)->addYears($sponsor->period)))}}
            </td>

        </tr>

@endforeach
        </tbody>
    </table>
</div>
@endsection