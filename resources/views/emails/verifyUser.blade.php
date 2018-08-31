<title>Welcome Email</title>

<div class="container">
    <div class="card">
        <div class="card-header text-center">
            Welcome To Blessing Learning Center and Children Home :: {{$user['first_name']}}
        </div>
        <div class="card-body">
            Your registered email is :: {{$user['email']}}, Please click on the below link to
            verify your email account<br>
            <a href="{{route('auth.verify',$token)}}">Verify Email</a>
        </div>
    </div>
</div>
