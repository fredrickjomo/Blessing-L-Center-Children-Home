@extends('layouts.main')
@section('content')
    <style>
        .btn-primary{
            align-items: center;
        }
        .container{
            margin-top: 5%;

        }
        .card{
            margin-bottom: 20%;
        }
        .card .card-body{
            align-items: center;
        }
        .card-body .col-md-4{
            margin-left: 10%;

        }
        .card-header{
            text-align: center;
            line-height: 1.5em;
            font-size: large;
            background-color:#090909;
            color: #f8f9fa;
        }
        .btn-primary{
            background-color:#090909;
            margin-left: 33%;
            width: 30%;


        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Child Information</div>
                    <div class="card-body">
                        <form method="post" action="{{route('Children.store')}}" enctype="multipart/form-data">
                        {{csrf_field()}} <!--laravel inbuilt function to ensure laravel forms work-->
                            <div class="row">
                                <div class="col-md-4">
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
                                        <label for="age">Age<span class="required">*</span></label>
                                        <input type="number" id="age" placeholder="Enter age" name="age" spellcheck="false" required class="form-control"/>
                                    </div>

                                </div>
                                <div class="col-md-4 right">
                                    <div class="form-group">
                                        <label for="vulnerability">Vulnerability<span class="required">*</span></label>
                                        <select id="vulnerability" class="form-control" name="vulnerability" required>
                                            <option value="">---Select Vulnerability---</option>
                                            <option value="Total_Orphan">Total Orphan</option>
                                            <option value="Partial_Orphan">Partial Orphan(Single Parent)</option>
                                            <option value="Poor_Background">Poor Background</option>

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
                                            <option value="Lower_Primary">Lower Primary</option>
                                            <option value="Upper_Primary">Upper Primary</option>
                                            <option value="Secondary">Secondary</option>
                                            <option value="Tertiary">Tertiary</option>

                                        </select>
                                        @if ($errors->has('education_level'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('education_level') }}</strong>
                                    </span>
                                        @endif

                                    </div>

                                    <div class="form-group">
                                        <label for="photo">Photo<span class="required">*</span></label>
                                        <input type="file" class="form-control" name="photo" required>
                                    </div>

                                </div>
                            </div>


                            <div class="form-group">
                                <input type="submit" class="btn btn-primary btn-lg " value="Save"/>
                            </div>




                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    @endsection