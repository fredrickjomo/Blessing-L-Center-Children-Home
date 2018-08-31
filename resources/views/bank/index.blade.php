<title>Bank Payment</title>
@extends('layouts.main')
@section('content')
    <style>
        .bank-payment{
            margin-bottom: 10%;
        }
    </style>
<div class="container jusitfy-center bank-payment">
<div class="row">
    <div class="col-md-9 col-md-offset-2">
    <div class="card">
        <div class="card-header"style="text-align: center; font-weight: bold; font-size: 30px">Bank Payment</div>
        <div class="card-body" style="font-family:'Times New Roman';">
            <div class="col-md-12">

                <div class="row">
                    @foreach($child_details as $child)
                        <div class="col-md-5"><h6>Child Details</h6>
                    <img src="/children_photo/{{$child->photo}}" height="100px" width="100px" style="border-radius: 50%;"><br>
                            <b>Name:</b>{{$child->full_name}}<br>
                            <b>Reg No:</b>{{$child->id}}<br>
                            <b>Age:</b> {{$child->age}} years<br>
                            <b>Education Level:</b>{{$child->education_level}}<br>
                            <b>Vulnerability:</b>{{$child->vulnerability}}
                    </div>
                    @endforeach
                    <div class="col-md-7"><h6>Please fund your plan through:</h6>
                        <img src="{{asset('images/others/coop.png')}}" height="50px" width="80px"> <b class="alert alert-success">CO-OPERATIVE BANK KENYA</b><br><br><br>
                        <b>Account Name:</b> Blessing Learning Center.<br>
                        <b>Account No:</b>  01109737004500.<br>
                        @foreach($plan as $my_plan)
                        <b>Amount:</b>&nbsp;$.{{$my_plan->cost}}&nbsp;(Ksh.{{$my_plan->cost}}00)
                        @endforeach
                        <p>After payment please post your receipt via our postal address(P.O BOX 14057-20100, Nakuru) or
                            submit it personally to us. Your sponsorship status will be activated once we receive your
                            first payment.
                        your sponsorship.</p>
                        <p>Remember to include child <b>Reg No</b> in the receipt for easy identification.</p>

                        <script>
                          function replaceIt() {
                              $(".button").html('<input type="submit" class="btn btn-primary" id="upload-progress" value="Please wait...">');
                              return true;

                          }
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer" style="font-family: 'Times New Roman';font-size: 20px;">
            @foreach($sponsorship_status as $status)
                <h6 class="text-center">Your sponsorship application status as of {{date('j-M-Y',strtotime(Carbon\Carbon::now()))}} at
                    {{date('g:ia',strtotime(Carbon\Carbon::now()))}} is : <b>{{$status->sponsorship_status}}</b></h6>
            @endforeach
        </div>
    </div>
    </div>
</div>
</div>

@endsection