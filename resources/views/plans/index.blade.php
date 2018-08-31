@extends('layouts.main')
@section('content')
    <style>
        .plans{
            margin-top: 7%;
            font-family: Garamond;
            margin-bottom: 10%;
        }
    </style>
    <div class="container plans">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card card-default">
                    <div class="card-header text-center" style="font-weight: bold; font-size:25px;">Our Sponsorship Plans</div>

                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($plans as $plan)
                                <li class="list-group-item clearfix">
                                    <div class="float-left">
                                        <h4>{{ $plan->name }}</h4>
                                        <h4>${{ number_format($plan->cost, 2) }}&nbsp;(Ksh.{{$plan->cost}}00)</h4>
                                        @if ($plan->description)
                                            <p>{{ $plan->description }}</p>
                                        @endif
                                    </div>
                                        @if(!Auth::user()->subscribedToPlan($plan->braintree_plan,'main'))
                                    <a href="{{ url('/plan', $plan->id) }}" class="btn btn-default float-right">Choose Plan</a>
                                            @else
                                        <a href="" class="btn btn-default float-right" disabled><button class="btn btn-success" disabled>Subscribed</button></a>
                                            @endif

                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection