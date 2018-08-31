@extends('layouts.admin')
@section('header')
    Edit Event ({{$event->name}}) Information
    @endsection
@section('page-icon')
    <i class="fa fa-edit"></i>
    @endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action='{{url("/update-event-information/{$event->id}")}}' enctype="multipart/form-data">

            {{csrf_field()}} <!--laravel inbuilt function to ensure laravel forms work-->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Event Name<span class="required">*</span> </label>
                            <input value="{{$event->name}}" id="name" required name="name" spellcheck="false" class="form-control" />

                        </div>

                        <div class="form-group">
                            <label for="purpose">Purpose<span class="required">*</span></label>
                            <textarea id="purpose" name="purpose" spellcheck="false" required class="form-control" cols="10" rows="8">
                                {{$event->purpose}}
                            </textarea>
                            @if ($errors->has('purpose'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('purpose') }}</strong>
                                    </span>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6 right">



                        <div class="form-group">
                            <label for="date">Date<span class="required">*</span></label>
                            <input id="date" name="date" spellcheck="false" type="date" value="{{$event->date_of_event}}" required class="form-control"/>
                            @if ($errors->has('date'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="venue">Venue<span class="required">*</span></label>
                            <input id="venue" name="venue" spellcheck="false" type="text" value="{{$event->venue}}" required class="form-control"/>
                            @if ($errors->has('venue'))
                                <span class="invalid-feedback">
                                        <strong>{{ $errors->first('venue') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <style>
                            .profile-image img{
                                height: 30px;
                                width: 30px;
                            }

                        </style>

                        <div class="form-group profile-image">
                            <label for="photo">Photo<span class="required">* &nbsp;<i class="fa fa-angle-right" style="color: red;"></i><h9>current</h9></span></label>
                            <img src='{{url("storage/charity_events/{$event->photo}")}}'><input id="photo" type="file" class="form-control" name="photo" value="{{$event->photo}}">
                        </div>

                    </div>
                </div>


                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-lg col-md-5" value="Update"/>
                </div>




            </form>
        </div>
    </div>
</div>
    @endsection