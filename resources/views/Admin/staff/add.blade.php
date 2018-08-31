@extends('layouts.admin')

@section('header')
    Add Staff Information
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
    <form method="post" action="{{route('staff.store')}}" enctype="multipart/form-data">
    {{csrf_field()}} <!--laravel inbuilt function to ensure laravel forms work-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name">First Name<span class="required">*</span> </label>
                    <input placeholder="First Name" id="first_name" required name="first_name" spellcheck="false" class="form-control" />
                    @if ($errors->has('first_name'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                    @endif

                </div>

                <div class="form-group">
                    <label for="middle_name">Middle Name<span class="required" style="color: #0f0f0f">&nbsp;(optional)</span> </label>
                    <input placeholder="Middle Name" id="middle_name"name="middle_name" spellcheck="false" class="form-control" />
                    @if ($errors->has('middle_name'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('middle_name') }}</strong>
                                    </span>
                    @endif

                </div>
                <div class="form-group">
                    <label for="age">Year Of Birth<span class="required">*</span></label>
                    <input type="number" id="age" placeholder="e.g 1994" name="year_of_birth" spellcheck="false" required class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="gender">Gender<span class="required">*</span></label>
                    <select id="gender"  class="form-control " name="gender" required>
                        <option value="">---Selct Gender---</option>
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
                    <input placeholder="Last Name" id="last_name" required name="last_name" spellcheck="false" class="form-control" />
                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                    @endif

                </div>


                <div class="form-group">
                    <label for="position">Position<span class="required">*</span></label>
                    <select id="position" class="form-control" name="position" required>
                        <option value="">---Select Position---</option>
                        <option value="Carer">Carer</option>
                        <option value="Teacher">Teacher</option>


                    </select>
                    @if ($errors->has('position'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('position') }}</strong>
                        </span>
                    @endif

                </div>

                <div class="form-group">
                    <label for="photo">Photo<span class="required" style="color: black;">&nbsp;(optional)</span></label>
                    <input type="file" class="form-control" name="photo">
                </div>

            </div>
        </div>


        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-lg col-md-5" value="Add Member"/>
        </div>




    </form>

@endsection