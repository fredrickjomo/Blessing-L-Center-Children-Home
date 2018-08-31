@extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="{{asset('css/custom-css/register.css')}}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card card-default">
                <div class="card-header"><h2>Register</h2></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        {{csrf_field()}}

                        <div class="row">

                <div class="col-md-6">

                    <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                   @if ($errors->has('first_name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>

                        <div class="col-md-6">
                            <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>

                            @if ($errors->has('last_name'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                            @endif

                        </div>
                    </div>

                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>

                                <div class="col-md-6">
                                    <select id="gender" class="form-control" name="gender" required>
                                        <option value="">---Select Gender---</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>

                                    </select>
                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                    <div class="form-group row">
                        <label for="nationality" class="col-md-4 col-form-label text-md-right">Nationality</label>

                        <div class="col-md-6">
                            <select id="nationality" class="form-control" name="nationality" required>
                                <option value="">---Select Nationality---</option>
                                @foreach($countries as $country)
                                <option value="{{$country->name.' ('.$country->code.')'}}"{{old('nationality')==$country ? 'selected':''}}>{{$country->name.' ('.$country->code.')'}}</option>
                                    @endforeach

                            </select>
                        </div>
                    </div>

                    </div>
                            <div class="col-md-5"><!--div two starts here-->


                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="photo" class="col-md-4 col-form-label text-md-right">Photo(optional)</label>

                                    <div class="col-md-6">
                                        <input id="photo" type="file" class="form-control" name="photo" value=""  autofocus>

                                    </div>
                                </div>



                            </div>

                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            <!--insert button here-->
            </div>


    </div>
</div>
</div>
@endsection
