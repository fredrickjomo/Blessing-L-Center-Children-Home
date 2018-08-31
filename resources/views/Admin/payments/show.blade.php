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
Updated Payments
    @endsection
@section('page-icon')

    @endsection

@section('content')
    <div class="sponsorship-list">
       {{--<form class="form-group">
        <input type="search" placeholder="search sponsor" class="float-right form-control">
            <div class="loading">
                <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i><br/>
                <span>Loading</span>
            </div>
        </form>
--}}
        <form method="GET" class="form-group">
            <input type="text" name="name" style="border-radius: 7px"><a href="" class="btn btn-success">Search</a>
        </form>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>
                    N0:
                </th>

                <th>
                    Sponsor Name
                </th>

                <th>
                    Child Name
                </th>

                <th>
                    Amount Paid (Kshs.)
                </th>

                <th>
                    Balance (Kshs.)
                </th>

                <th>
                    Payment Month
                </th>

                <th>
                    Year
                </th>

                <th>
                    Date Of Payment
                </th>

                <th>
                    Transaction Id
                </th>
                <th>
                    Reports
                </th>


            </tr>
            </thead>
            <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{$t_count++}}</td>
                    <td>{{$payment->first_name}}&nbsp;{{$payment->last_name}}</td>
                    <td>{{$payment->full_name}}</td>
                    <td>{{$payment->pay}}</td>
                    <td>{{$payment->amount_lack}}</td>
                    <td>{{$payment->month}}</td>
                    <td>{{$payment->year}}</td>
                    <td>{{$payment->created_at}}</td>
                    <td>
                    @if($payment->receipt==null)
                            {{$payment->transaction_id}}
                        @else
                        {{$payment->transaction_id}}<br>
                        <a href='{{url("payments/view-receipts/{$payment->id}")}}' target="_blank">view Receipt</a>
                        @endif
                    </td>
                    <td>
                        <a href='{{url("generate_report/{$payment->id}")}}' target="_blank"><i class="fa fa-file-pdf-o btn btn-danger"></i>Generate Report</a>
                    </td>

                </tr>
                @endforeach


            </tbody>
        </table>
        {{$payments->links()}}
    </div>

    @endsection