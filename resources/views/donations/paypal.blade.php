@extends('layouts.main')
@section('content')
    <div class="container col-md-8">
    <div class="card ">
        <div class="card-header text-center" style="font-family: Garamond;font-size: 20px;">
            Donate Via Paypal
        </div>
        <div class="card-body">
            <div class="col-md-8 col-md-offset-2">

                @if (Session::has('message'))
                    <div class="alert alert-{{ Session::get('code') }}">
                        <p>{{ Session::get('message') }}</p>
                    </div>
                @endif

                <div class="card card-default">
                    <div class="card-heading">Express checkout</div>
                    <div class="card-body">
                        Pay $20 via:
                        <a href="{{ route('expressCheckout') }}" class='btn-info btn'>PayPal</a>
                    </div>
                </div>
                    <hr>

                <div class="card card-default">
                    <div class="card-heading">Recurring payments</div>
                    <div class="card-body">
                        Pay $20/month:
                        <a href="{{ route('expressCheckout', ['recurring' => true]) }}" class='btn-info btn'>PayPal</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>

    @endsection