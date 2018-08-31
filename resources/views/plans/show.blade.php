@extends('layouts.main')

@section('content')
    <style>
.pay{
    margin-top: 5%;
    margin-bottom: 20%;
}
    </style>
    <div class="container pay">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card card-default">
                    <div class="card-header" style="text-align: center; font-weight: bold; font-size: 30px">{{ $plan->name }} at $.{{$plan->cost}}&nbsp;(Ksh.{{$plan->cost}}00)</div>
                    <div class="card-body">
                        <form action="{{url('/subscribe')}}" method="post">
                            <div id="dropin-container"></div>
                            <input type="hidden" name="plan" value="{{ $plan->id }}">
                            {{csrf_field()}}
                            <hr>

                            <button id="payment-button" class="btn btn-primary btn-flat hidden" type="submit">Pay now</button>
                        </form><br>

                    </div>
                    <div class="card-footer">
                        <a href='{{url("pay-through-bank/{$plan->slug}")}}'><button class="btn btn-success btn-lg">Pay Through Bank</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('braintree')
    <script src="https://js.braintreegateway.com/js/braintree-2.30.0.min.js"></script>
        <script>
        braintree.setup('{{ Braintree_ClientToken::generate() }}', 'dropin', {
            container: 'dropin-container',
            onReady:function () {
               $('#payment-button').removeClass('hidden');
            }
        });
    </script>
   {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="dropin-container"></div>
                <button id="submit-button">Request payment method</button>
            </div>
        </div>
    </div>
    <script>
        var button = document.querySelector('#submit-button');

        braintree.dropin.create({
            authorization: "{{ Braintree_ClientToken::generate() }}",
            container: '#dropin-container'
        }, function (createErr, instance) {
            button.addEventListener('click', function () {
                instance.requestPaymentMethod(function (err, payload) {
                    $.get('{{ url('/plans') }}', {payload}, function (response) {
                        if (response.success) {
                            alert('Payment successfull!');
                        } else {
                            alert('Payment failed');
                        }
                    }, 'json');
                });
            });
        });
    </script>
    --}}

@endsection