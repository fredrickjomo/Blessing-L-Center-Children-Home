@extends('layouts.admin')

@section('header')
    Add Project Information
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
    <form method="post" action="{{url('/admin/save-project')}}" enctype="multipart/form-data">
    {{csrf_field()}} <!--laravel inbuilt function to ensure laravel forms work-->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Project Name<span class="required">*</span> </label>
                    <input placeholder="Enter Project Name" id="name" required name="name" spellcheck="false" class="form-control" />

                </div>
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
                <div class="form-group">
                    <label for="purpose">Purpose of Project<span class="required">*</span> </label>
                    <textarea placeholder="Enter Purpose " id="purpose" required name="purpose" spellcheck="false" class="form-control" cols="8" rows="6" >
                    </textarea>

                </div>
                @if ($errors->has('purpose'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('purpose') }}</strong>
                                    </span>
                @endif




            </div>
            <div class="col-md-6 right">
                <div class="form-group">
                    <label for="date">Start Date<span class="required">*</span></label>
                    <input type="date" id="date" placeholder="Enter Start Date" name="start_date" spellcheck="false" required class="form-control"/>
                </div>
                @if ($errors->has('start_date'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                @endif

                <div class="form-group">
                    <label for="end_date">Projected End Date<span class="required">*</span></label>
                    <input type="date" id="end_date" placeholder="Enter End Date" name="end_date" spellcheck="false" required class="form-control"/>
                </div>
                @if ($errors->has('end_date'))
                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('end_date') }}</strong>
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