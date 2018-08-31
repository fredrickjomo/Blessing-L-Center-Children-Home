@extends('layouts.main')
@section('content')
    <style>
.subscriptions{
    margin-top: 5%;
    margin-bottom: 20%;
}
    </style>
    <div class="container subscriptions">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card card-default">
                    <div class="card-header text-center"><strong>Manage Subscriptions</strong></div>

                    <div class="card-body">
                    @if (Auth::user()->subscription('main')->cancelled())
                        <!-- Will create the form to resume a subscription later -->
                            <p>Your current subscription ends on <strong>{{ Auth::user()->subscription('main')->ends_at->format('dS M Y') }}</strong></p>
                            <form action="{{ url('subscription/resume') }}" method="post">
                                <button type="submit" class="btn btn-default">Resume subscription</button>
                                {{ csrf_field() }}
                            </form>
                        @else
                            <p>You are currently subscribed to <strong>{{ Auth::user()->subscription('main')->braintree_plan }} </strong>plan</p>
                            <form action="{{ url('subscription/cancel') }}" method="post">
                                <button type="submit" class="btn btn-danger">Cancel subscription</button>
                                {{ csrf_field() }}
                            </form>
                        <br>
                            <form action="{{ url('/plans') }}">
                                <button type="submit" class="btn btn-success">Swap/Change Plan</button>
                                {{ csrf_field() }}
                            </form>
                        @endif

                        ...
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection