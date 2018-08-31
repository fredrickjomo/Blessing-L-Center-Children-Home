@extends('layouts.admin')
@section('header')
Edit/Update Child Information
    @endsection
@section('page-icon')
<i class="fa fa-edit"></i>
    @endsection

@section('content')

    <form method="post" action="{{route('children.update',[$child->id])}}" enctype="multipart/form-data">

    {{csrf_field()}} <!--laravel inbuilt function to ensure laravel forms work-->
        <input type="hidden" name="_method" value="put">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="full_name">Full Name<span class="required">*</span> </label>
                    <input value="{{$child->full_name}}" id="full_name" required name="full_name" spellcheck="false" class="form-control" />

                </div>

                <div class="form-group">
                    <label for="gender">Gender<span class="required">*</span></label>
                    <select id="gender" class="form-control" name="gender" required>
                        <option value="{{$child->gender}}">{{$child->gender}}</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>

                    </select>
                    @if ($errors->has('gender'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                    @endif

                </div>
                <div class="form-group">
                    <label for="year_of_birth">Age<span class="required">*</span></label>
                    <input type="number" id="year_of_birth" value="{{$child->year_of_birth}}" name="year_of_birth" spellcheck="false" required class="form-control"/>
                </div>

            </div>
            <div class="col-md-6 right">
                <div class="form-group">
                    <label for="vulnerability">Vulnerability<span class="required">*</span></label>
                    <select id="vulnerability" class="form-control" name="vulnerability" required>
                        <option value="{{$child->vulnerability}}">{{$child->vulnerability}}</option>
                        <option value="Total Orphan">Total Orphan</option>
                        <option value="Partial Orphan">Partial Orphan(Single Parent)</option>
                        <option value="Poor Background">Poor Background</option>

                    </select>
                    @if ($errors->has('vulnerability'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('vulnerability') }}</strong>
                                    </span>
                    @endif

                </div>


                <div class="form-group">
                    <label for="education_level">Education Level<span class="required">*</span></label>
                    <select id="education_level" class="form-control" name="education_level" required>
                        <option value="{{$child->education_level}}">{{$child->education_level}}</option>
                        <option value="Lower Primary">Lower Primary</option>
                        <option value="Upper Primary">Upper Primary</option>
                        <option value="Secondary">Secondary</option>
                        <option value="Tertiary">Tertiary</option>

                    </select>
                    @if ($errors->has('education_level'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('education_level') }}</strong>
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
                    <label for="photo">Photo<span class="required">&nbsp;(optional)<i class="fa fa-angle-right" style="color: red;"></i><h9>current</h9></span></label>
                    <img src='{{url("storage/children/{$child->photo}")}}' id="photo"><input id="photo" type="file" class="form-control" name="photo" value="{{$child->photo}}">
                </div>

            </div>
        </div>


        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-lg col-md-5" value="Save"/>
        </div>




    </form>


@endsection