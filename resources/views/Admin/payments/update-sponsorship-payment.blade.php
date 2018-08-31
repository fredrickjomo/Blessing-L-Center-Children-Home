@extends('layouts.admin')
@section('header')
    Update Sponsorship Payment
    @endsection
@section('page-icon')
    <i class="fa fa-payments"></i>
    @endsection
@section('content')
    <style>
        .payment{
            font-family: Garamond;
        }
        table th{
            color: #0b97c4;

        }
    </style>
    <style>
        label{
            color: red;
        }

    </style>
    <form method="post" action="{{route('sponsorship_payment')}}" enctype="multipart/form-data">
    {{csrf_field()}} <!--laravel inbuilt function to ensure laravel forms work-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="year">Year<span class="required">*</span> </label>
                    <input  placeholder="Year" id="year" autocomplete="off" required name="year" spellcheck="false" class="form-control date-picker-year" />
                    @if ($errors->has('year'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                    @endif

                </div>
                <script src="{{asset('js/jquery-3.2.1.js')}}"></script>
                <script>
                    $(function() {
                        $('#year').datepicker( {
                            changeMonth: true,
                            changeYear: true,
                            showButtonPanel: true,
                            dateFormat: 'yy',
                            onClose: function(dateText, inst) {
                                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                $(this).datepicker('setDate', new Date(year, month, 1));
                            }
                        });
                    });
                </script>
                <style>
                    .ui-datepicker-calendar {
                        display: none;
                    }
                </style>


                <div class="form-group">
                    <label for="month">Month<span class="required">*</span> </label>
                    <input placeholder="Month" id="month" autocomplete="off" required name="month" spellcheck="false" class="form-control" />
                    @if ($errors->has('month'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('month') }}</strong>
                                    </span>
                    @endif

                </div>
                <script>
                    $(function() {
                        $('#month').datepicker( {
                            changeMonth: true,
                            changeYear: true,
                            showButtonPanel: true,
                            dateFormat: 'MM',
                            onClose: function(dateText, inst) {
                                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                                $(this).datepicker('setDate', new Date(year, month, 1));
                            }
                        });
                    });
                </script>
                <div class="form-group">
                    <label for="sponsor">Sponsor<span class="required">*</span></label>
                    <select id="sponsor" class="form-control" name="sponsor" required>
                        <option value="" selected="selected">---Select Sponsor---</option>
                        @foreach($sponsor as $sponsor_details)
                        <option value="{{$sponsor_details->user_id}}">{{$sponsor_details->first_name}}&nbsp;{{$sponsor_details->last_name}}</option>
                            @endforeach
                    </select>
                    @if ($errors->has('sponsor'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('sponsor') }}</strong>
                        </span>
                    @endif

                </div>
                <div class="form-group">
                    <label for="gender">Child<span class="required">*</span></label>
                    <select id="child"  class="form-control " name="child" readonly="readonly" required>
                        <option value="" selected="selected">---Select Child---</option>
                    </select>
            <script>
            $(document).ready(function () {
                $('select[name="sponsor"]').on('change',function () {
                    var sponsorId=$(this).val();
                    if (sponsorId){
                        $.ajax({
                            url:'/child/get/'+sponsorId,
                            type:"GET",
                            dataType:"json",
                            beforeSend:function () {
                                $('#loader').css("visibility","visible");
                            },
                            success:function (data) {
                                $('select[name="child"]').empty();
                                $.each(data,function (key,value) {
                                    $('select[name="child"]').append('<option value="'+key+'">'+value+'</option>');
                                });
                            },
                            complete:function () {
                                $('#loader').css("visibility","hidden");
                            }

                        });
                    }else {
                        $('select[name="child"]').empty();
                    }
                });
            });
            </script>
                    @if ($errors->has('child'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('child') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="plan">Sponsorship Plan<span class="required">*</span></label>
                    <select id="plan" class="form-control" name="plan" readonly="readonly" required>
                        <option value="" selected="selected">---Select Plan---</option>


                    </select>
                    <div class="col-md-2"><span id="loader"><i class="fa fa-spinner fa-3x fa-spin"></i></span></div>
                    @if ($errors->has('plan'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('plan') }}</strong>
                        </span>
                    @endif

                </div>

            </div>
            <div class="col-md-6 right">
                <script>
                    $(document).ready(function () {
                        $('select[name="sponsor"]').on('change',function () {
                            var childId=$(this).val();
                            if (childId){
                                $.ajax({
                                    url:'/plan/get/'+childId,
                                    type:"GET",
                                    dataType:"json",
                                    beforeSend:function () {
                                        $('#loader').css("visibility","visible");
                                    },
                                    success:function (data) {
                                        $('select[name="plan"]').empty();
                                        $.each(data,function (key,value) {
                                            $('select[name="plan"]').append('<option value="'+key+'">'+value+'</option>');
                                        });
                                    },
                                    complete:function () {
                                        $('#loader').css("visibility","hidden");
                                    }

                                });
                            }else {
                                $('select[name="plan"]').empty();
                            }
                        });
                    });

                </script>



                <div class="form-group">
                    <label for="pay">Pay<span class="required">*</span> (Kshs.) </label>
                    <input placeholder="Enter amount paid" id="pay" type="number" required name="pay" spellcheck="false" class="form-control" />
                    @if ($errors->has('pay'))
                        <span class="invalid-feedback" id="error-pay">
                                        <strong>{{ $errors->first('pay') }}</strong>
                                    </span>
                    @endif

                </div>

                <div class="form-group">
                    <label for="deficient">Deficient<span class="required">*</span> (Kshs.)</label>
                    <input placeholder="amount deficient" readonly="readonly" type="number" id="deficient" required name="deficient" spellcheck="false" class="form-control" />
                    @if ($errors->has('deficient'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('deficient') }}</strong>
                                    </span>
                    @endif

                </div>
                <script>
                    $(document).ready(function () {
                        $('input[name="pay"]').on('change',function () {
                            var payAmount=$(this).val();
                            if (payAmount){
                                $.ajax({
                                    url:'/payment/get/'+payAmount,
                                    type:"GET",
                                    dataType:"json",
                                    beforeSend:function () {
                                        $('#loader').css("visibility","visible");
                                    },
                                    success:function (data) {
                                        var plan=$('#plan').val();
                                        if(payAmount<=0){
                                            alert('Negative or 0 Payment is not accepted..Please re-enter the amount again');
                                            $('#pay').val('');
                                            $('#deficient').removeAttr('value');
                                        }
                                        if(plan=='Basic_Plan_I'){
                                            if(payAmount>3000){
                                                alert('Maximum Pay for Basic Plan I is Kshs.3000..Please re-enter the amount again');
                                                $('#pay').val('');

                                            }else{
                                                $('#deficient').val('3000'-$('#pay').val());
                                            }

                                        }else if(plan=='Basic_Plan_II'){
                                            if(payAmount>5000){
                                                alert('Maximum Pay for Basic Plan II is Kshs.5000..Please re-enter the amount again');
                                                $('#pay').val('');

                                            }else{
                                                $('#deficient').val('5000'-$('#pay').val());
                                            }

                                        }
                                        else if(plan=='Premium'){
                                            if(payAmount>60000){
                                                alert('Maximum Pay for Premium Plan is Kshs.60000 for a year..Please re-enter the amount again');
                                                $('#pay').val('');

                                            }else{
                                                $('#deficient').val('60000'-$('#pay').val());
                                            }

                                        }


                                    },
                                    complete:function () {
                                        $('#loader').css("visibility","hidden");
                                    }

                                });
                            }else {
                                $('select[name="plan"]').empty();
                            }
                        });
                    });

                </script>
                <div class="form-group">
                    <label for="transaction_id">Transaction id<span class="required">*</span> </label>
                    <input placeholder="Enter transaction id" id="transaction_id" type="text" required name="transaction_id" spellcheck="false" class="form-control" />
                    @if ($errors->has('transaction_id'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('transaction_id') }}</strong>
                                    </span>
                    @endif

                </div>
                <div class="form-group">
                    <label for="photo">Receipt<span class="required" style="color: black;">&nbsp;(optional)</span></label>
                    <input type="file" class="form-control" name="receipt">
                </div>


            </div>
        </div>


        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-lg col-md-5" value="Update Payment"/>
        </div>




    </form>
    @endsection