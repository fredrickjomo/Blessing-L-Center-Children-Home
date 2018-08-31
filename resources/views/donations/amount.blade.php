@extends('layouts.main')
@section('content')
    <div class="container" style="margin-bottom: 30%">
        <div class="row">
            <div class="card card-default col-md-5" style="padding: 0;">
                <div class="card-header text-center">
                    <h4 style="font-weight: bold;">Enter Amount to Donate</h4>
                    <form method="post" action="{{route('visa-card')}}" enctype="multipart/form-data">
                    {{csrf_field()}} <!--laravel inbuilt function to ensure laravel forms work-->
                        <div class="form-group">
                            <label for="amount">Amount ($.).<span class="required">*</span> </label>
                            <input placeholder="e.g 100" id="amount" required name="amount" spellcheck="false" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" />
                            @if ($errors->has('amount'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-lg col-md-5" value="Proceed"/>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection