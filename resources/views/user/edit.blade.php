@extends('layouts.main')

@section('content')

    <div class="container">
        <div class="row">
            <div class="card card-default col-md-12">
                <div class="card-header text-center"><h4>{{$user->first_name}}&nbsp;{{$user->last_name}}'s Profile</h4></div>
           <div class="card-body">
               <form method="post" action='{{url("/update-profile/{$user->email}")}}' enctype="multipart/form-data">
               {{csrf_field()}} <!--laravel inbuilt function to ensure laravel forms work-->
                   <div class="row">
                       <div class="col-md-6">
                           <div class="form-group">
                               <label for="first_name">First Name<span class="required">*</span> </label>
                               <input id="first_name" value="{{$user->first_name}}" required name="first_name" spellcheck="false" class="form-control" />
                               @if ($errors->has('first_name'))
                                   <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                               @endif

                           </div>
                           <div class="form-group">
                               <label for="last_name">Last Name<span class="required">*</span> </label>
                               <input id="last_name" value="{{$user->last_name}}" required name="last_name" spellcheck="false" class="form-control" />
                               @if ($errors->has('last_name'))
                                   <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                               @endif

                           </div>

                           <div class="form-group">
                               <label for="gender">Gender<span class="required">*</span></label>
                               <select id="gender" class="form-control" name="gender" required>
                                   <option value="{{$user->gender}}">{{$user->gender}}</option>
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
                               <label for="nationality">Nationality<span class="required">*</span></label>
                               <select id="nationality" class="form-control" name="nationality" required>
                                   <option value="{{$user->nationality}}">{{$user->nationality}}</option>
                                   @foreach($nationality as $country)
                                   <option value="{{$country->name}} ({{$country->code}})">{{$country->name}} ({{$country->code}})</option>
                                       @endforeach


                               </select>
                               @if ($errors->has('nationality'))
                                   <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nationality') }}</strong>
                                    </span>
                               @endif

                           </div>


                           <div class="form-group">
                               <label for="email">Email<span class="required">*</span> </label>
                               <input id="email" value="{{$user->email}}" readonly="readonly" required name="email" spellcheck="false" class="form-control" />
                               @if ($errors->has('email'))
                                   <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
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
                               <img src='{{url("storage/profile/{$user->photo}")}}' id="photo"><input id="photo" type="file" class="form-control" name="photo" value="{{$user->photo}}">
                           </div>

                       </div>
                   </div>


                   <div class="form-group">
                       <input type="submit" class="btn btn-primary btn-lg col-md-5" value="Update Profile"/>
                   </div>




               </form>

           </div>
            </div>
        </div>


    </div>



@endsection