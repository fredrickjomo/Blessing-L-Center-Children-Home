<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

</head>
<body>
<div class="container">
    <style>
        .text-danger strong {
            color: #9f181c;
        }
        .receipt-main {
            background: #ffffff none repeat scroll 0 0;
            border-bottom: 12px solid #333333;
            border-top: 12px solid #9f181c;
            margin-top: 50px;
            margin-bottom: 20px;
            padding: 40px 30px !important;
            position: relative;
            box-shadow: 0 1px 21px #acacac;
            color: #333333;
            font-family: open sans;
        }
        .receipt-main p {
            color: #333333;
            font-family: open sans;
            line-height: 1.42857;
        }
        .receipt-footer h1 {
            font-size: 15px;
            font-weight: 400 !important;
            margin: 0 !important;
        }
        .receipt-main::after {
            background: #414143 none repeat scroll 0 0;
            content: "";
            height: 5px;
            left: 0;
            position: absolute;
            right: 0;
            top: -13px;
        }
        .receipt-main thead {
            background: #414143 none repeat scroll 0 0;
        }
        .receipt-main thead th {
            color:#fff;
        }
        .receipt-right h5 {
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 7px 0;
        }
        .receipt-right p {
            font-size: 12px;
            margin: 0px;
        }
        .receipt-right p i {
            text-align: center;
            width: 18px;
        }
        .receipt-main td {
            padding: 9px 20px !important;
        }
        .receipt-main th {
            padding: 13px 20px !important;
        }
        .receipt-main td {
            font-size: 13px;
            font-weight: initial !important;
        }
        .receipt-main td p:last-child {
            margin: 0;
            padding: 0;
        }
        .receipt-main td h2 {
            font-size: 20px;
            font-weight: 900;
            margin: 0;
            text-transform: uppercase;
        }
        .receipt-header-mid .receipt-left h1 {
            font-weight: 100;
            margin: 34px 0 0;
            float: left;
            text-align: left;
            text-align: right;
            text-transform: uppercase;
        }
        .receipt-header-mid {
            margin: 24px 0;
            overflow: hidden;
        }

        #container {
            background-color: #dcdcdc;
        }
        @media print{
            a[href]::after{
                content: none !important;
            }
        }
    </style>
    <div class="container">
        <div class="row">

            <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                <div class="col-xs-6 col-sm-6 col-md-12 text-right">
                    <div class="receipt-right">
                        <h5>S/NO: {{$report->year}}/{{$report->transaction_id}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="receipt-header">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="receipt-left">
                                <img class="img-responsive" alt="Blessing Learning Center" src='C:\xampp\htdocs\BlessingLearningCentre\storage\app\public\logo\logo.png'  width="100px" height="100px" style="border-radius: 50%;">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-12 text-right">
                            <div class="receipt-right">
                                <h5>Blessing Learning Center</h5>
                                <p><b>Contacts: </b>+254720 203 229 <i class="fa fa-phone"></i></p>
                                <p><b>Email: </b>blcenter@gmail.com <i class="fa fa-envelope-o"></i></p>
                                <p><b>Address: </b>P.O BOX 14057-20100 <i class="fa fa-location-arrow"></i></p>
                                <p>Nakuru, Kenya <i class="fa fa-location-arrow"></i></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="receipt-header receipt-header-mid">
                        <div class="col-xs-8 col-sm-8 col-md-12 text-left">
                            <div class="receipt-right">
                                <h5 style="text-decoration: underline">Sponsor Details:</h5>
                                <p><b>Sponsor Name: </b>{{$report->first_name}}&nbsp;{{$report->last_name}}</p>
                                <p><b>Child Name: </b>{{$report->full_name}}</p>
                                <p><b>Sponsorship Plan: </b>{{$report->plan_subscribed}}</p>
                                <p><b>Sponsorship Cost: </b>@if($report->plan_subscribed=='Basic_Plan_I')
                                        Ksh. 3000 per month
                                    @elseif($report->plan_subscribed=='Basic_Plan_II')
                                        Ksh. 5000 per month
                                    @elseif($report->plan_subscribed=='Premium')
                                        Ksh. 60,000 per annum
                                    @endif
                                </p>
                                <p><b>Mobile :</b>{{$report->phone_number}}</p>
                                <p><b>Email :</b> {{$report->email}}</p>
                                <p><b>Country :</b>{{$report->nationality}}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="receipt-left">
                                <h1>Payment Details</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Description</th>
                            <th>Amount (Kshs.)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="col-md-9">Being Payment for: <b>{{$report->month}}&nbsp;{{$report->year}}</b></td>
                        </tr>
                        <tr>
                            <td class="col-md-9">Amount Paid:</td>
                            <td class="col-md-3"><i class="fa "></i> {{$report->pay}}/-</td>
                        </tr>
                        <tr>
                            <td class="col-md-9">Other costs</td>
                            <td class="col-md-3"><i class="fa "></i> 0.00/-</td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                <p>
                                    <strong>Total Amount: </strong>
                                </p>
                                <p>
                                    <strong>Amount Paid: </strong>
                                </p>
                                <p>
                                    <strong>Balance Due: </strong>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <strong><i class="fa "></i> @if($report->plan_subscribed=='Basic_Plan_I')
                                            3000/-
                                        @elseif($report->plan_subscribed=='Basic_Plan_II')
                                            5000/-
                                        @elseif($report->plan_subscribed=='Premium')
                                            60,000/-
                                        @endif
                                    </strong>
                                </p>
                                <p>
                                    <strong><i class="fa "></i> {{$report->pay}}/-</strong>
                                </p>
                                <p>
                                    <strong><i class="fa "></i> {{$report->amount_lack}}/-</strong>
                                </p>
                            </td>
                        </tr>
                        <tr>

                            <td class="text-right"><h2><strong>Total: </strong></h2></td>
                            <td class="text-left text-danger"><h2><strong><i class="fa "></i> {{$report->pay}}/-</strong></h2></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="receipt-header receipt-header-mid receipt-footer">
                        <div class="col-xs-8 col-sm-8 col-md-12 text-left">
                            <div class="receipt-right">
                                <p><b>Payment Date:</b>{{date('j-M-Y',strtotime(Carbon\Carbon::now()))}} at <b>{{date('g:ia' ,strtotime(Carbon\Carbon::now()))}}</b></p>
                                <h5 style="color: rgb(140, 140, 140);">Thank you for your Support!</h5>
                                <div class="receipt-left">
                                    <h1>Signature/Stamp</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <a href='{{url("/downloading_receipt/{$report->id}")}}' class="btn btn-success">Download Receipt</a>
    </div>
</div>

</body>
</html>


