@extends('layouts.admin')
@section('header')
    Edit {{$staff->first_name}}'s Information
@endsection
@section('page-icon')
    <i class="fa fa-edit"></i>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="post" action='{{url("/update-staff-information/{$staff->id}")}}' enctype="multipart/form-data">

                {{csrf_field()}} <!--laravel inbuilt function to ensure laravel forms work-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">First Name<span class="required">*</span> </label>
                                <input value="{{$staff->first_name}}" id="first_name" required name="first_name" spellcheck="false" class="form-control" />
                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif

                            </div>

                            <div class="form-group">
                                <label for="middle_name">Middle Name<span class="required" style="color: #0f0f0f">&nbsp;(optional)</span> </label>
                                <input value="{{$staff->middle_name}}" id="middle_name" name="middle_name" spellcheck="false" class="form-control" />
                                @if ($errors->has('middle_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('middle_name') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="age">Year of birth<span class="required">*</span></label>
                                <input type="number" id="age" value="{{$staff->year_of_birth}}" name="year_of_birth" spellcheck="false" required class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender<span class="required">*</span></label>
                                <select id="gender"  class="form-control " name="gender" required>
                                    <option value="{{$staff->gender}}">{{$staff->gender}}</option>
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
                        <div class="col-md-6 right">
                            <div class="form-group">
                                <label for="last_name">Last Name<span class="required">*</span> </label>
                                <input value="{{$staff->last_name}}" id="last_name" required name="last_name" spellcheck="false" class="form-control" />
                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif

                            </div>


                            <div class="form-group">
                                <label for="position">Position<span class="required">*</span></label>
                                <select id="position" class="form-control" name="position" required>
                                    <option value="{{$staff->position}}">{{$staff->position}}</option>
                                    <option value="Carer">Carer</option>
                                    <option value="Teacher">Teacher</option>


                                </select>
                                @if ($errors->has('position'))
                                    <span class="invalid-feedback">
                            <strong>{{ $errors->first('position') }}</strong>
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
                                <img src='{{url("storage/staff/{$staff->photo}")}}'><input id="photo" type="file" class="form-control" name="photo" value="{{$staff->photo}}">
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