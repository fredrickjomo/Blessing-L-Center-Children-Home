@extends('layouts.main')
@section('content')
    <style>
        .visacard{
            margin-bottom: 10%;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

    <div class="container visacard ">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="dropin-container"></div>
                <button id="submit-button" class="btn btn-primary col-md-4">Donate</button>
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
                    $.get('{{ url("visa-card-payment/process/{$amount}") }}', {payload}, function (response) {
                        if (response.success) {
                            alert('Payment successfull!.Thank you for your donation');

                        } else {
                            alert('Payment failed.Try again');
                        }
                    }, 'json');
                });
            });
        });
    </script>
    @endsection