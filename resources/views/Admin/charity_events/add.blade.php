@extends('layouts.admin')
@section('header')
Add Charity Event
    @endsection
@section('page-icon')
<i class="fa fa-user"></i>
    @endsection
@section('content')

    <style>
        label{
            color: red;
        }

    </style>
    <form method="post" action="{{url('/save-event')}}" enctype="multipart/form-data">
    {{csrf_field()}} <!--laravel inbuilt function to ensure laravel forms work-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Event Name<span class="required">*</span> </label>
                    <input placeholder="Enter Event Name" id="name" required name="name" spellcheck="false" class="form-control" />

                </div>
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
                <div class="form-group">
                    <label for="purpose">Purpose of Event<span class="required">*</span> </label>
                    <textarea placeholder="Enter Purpose " id="purpose" required name="purpose" spellcheck="false" class="form-control" cols="8" rows="6" >
                    </textarea>

                </div>
                @if ($errors->has('purpose'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('purpose') }}</strong>
                                    </span>
                @endif


                <div class="form-group">
                    <label for="date">Date Of Event<span class="required">*</span></label>
                    <input type="date" id="date" placeholder="Enter Date" name="date" spellcheck="false" required class="form-control"/>
                </div>
                @if ($errors->has('date'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                @endif

            </div>
            <div class="col-md-6 right">
                <div class="form-group">
                    <label for="venue">Venue<span class="required">*</span></label>
                    <input type="text" id="venue" placeholder="Enter Venue" name="venue" spellcheck="false" required class="form-control"/>
                </div>
                @if ($errors->has('venue'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('venue') }}</strong>
                                    </span>
                @endif
                <div class="form-group">
                    <label for="photo">Photo caption<span class="required">*</span></label>
                    <input type="file" id="photo" name="photo" spellcheck="false" required class="form-control" accept="image/*"/>
                </div>
                @if ($errors->has('photo'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                @endif


            </div>
        </div>


        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-lg col-md-5" value="Save"/>
        </div>




    </form>

@endsection