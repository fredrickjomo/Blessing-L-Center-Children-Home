@extends('layouts.admin')

@section('header')
    Add Child Information
@endsection
@section('page-icon')
<i class="fa fa-plus"></i>
    @endsection

@section('content')
    <style>
        label{
            color: red;
        }

    </style>
    <form method="post" action="{{route('children.store')}}" enctype="multipart/form-data">
    {{csrf_field()}} <!--laravel inbuilt function to ensure laravel forms work-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="full_name">Full Name<span class="required">*</span> </label>
                    <input placeholder="Enter Full Name" id="full_name" required name="full_name" spellcheck="false" class="form-control" />

                </div>

                <div class="form-group">
                    <label for="gender">Gender<span class="required">*</span></label>
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
                <div class="form-group">
                    <label for="year_of_birth">Year of birth<span class="required">*</span></label>
                    <input type="number" id="year_of_birth" placeholder="e.g 1995" name="year_of_birth" spellcheck="false" required class="form-control"/>
                    @if ($errors->has('year_of_birth'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('year_of_birth') }}</strong>
                                    </span>
                    @endif
                </div>

            </div>
            <div class="col-md-6 right">
                <div class="form-group">
                    <label for="vulnerability">Vulnerability<span class="required">*</span></label>
                    <select id="vulnerability" class="form-control" name="vulnerability" required>
                        <option value="">---Select Vulnerability---</option>
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
                        <option value="">---Select Education Level---</option>
                        <option value="Lower Primary">Lower Primary</option>
                        <option value="Upper Primary">Upper Primary</option>
                        <option value="Secondary">Secondary</option>
                        <option value="Tertiary">Tertiary</option>

                    </select>


                </div>
                @if ($errors->has('education_level'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('education_level') }}</strong>
                                    </span>
                @endif
                <div class="form-group">
                    <label for="photo">Photo<span class="required" style="color: black;">&nbsp;(optional)</span></label>
                    <input type="file" class="form-control" name="photo"  accept="image/*" >
                </div>

            </div>
        </div>


        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-lg col-md-5" value="Save"/>
        </div>




    </form>

@endsection