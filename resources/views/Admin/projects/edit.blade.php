@extends('layouts.admin')
@section('header')
    Edit project ({{$project->name}}) Information
@endsection
@section('page-icon')
    <i class="fa fa-edit"></i>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action='{{url("/update-project-information/{$project->id}")}}' enctype="multipart/form-data">

                {{csrf_field()}} <!--laravel inbuilt function to ensure laravel forms work-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Project Name<span class="required">*</span> </label>
                                <input value="{{$project->name}}" id="name" required name="name" spellcheck="false" class="form-control" />

                            </div>

                            <div class="form-group">
                                <label for="purpose">Purpose Of Project<span class="required">*</span></label>
                                <textarea id="purpose" name="purpose" spellcheck="false" required class="form-control" cols="8" rows="6">
                                {{$project->purpose}}
                            </textarea>
                                @if ($errors->has('purpose'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('purpose') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        {{--right hand side div--}}
                        <div class="col-md-6 right">

                            <div class="form-group">
                                <label for="start_date">Start Date<span class="required">*</span></label>
                                <input id="start_date" name="start_date" spellcheck="false" type="date" value="{{$project->start_date}}" required class="form-control"/>
                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="end_date">Projected End Date<span class="required">*</span></label>
                                <input id="date" name="end_date" spellcheck="false" type="date" value="{{$project->end_date}}" required class="form-control"/>
                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('end_date') }}</strong>
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
                                <img src='{{url("storage/projects/{$project->photo}")}}'><input id="photo" type="file" class="form-control" name="photo" value="{{$project->photo}}">
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