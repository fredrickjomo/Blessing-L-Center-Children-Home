<html>
<link rel="stylesheet" href="{{asset('css/app.css')}}">
<script src="{{asset('js/app.js')}}"></script>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br>
            <div class="card-default">
                <div class="card-header">
                    <h5 class="text-center">Send your support to the below bank details</h5>
                </div>
                <br>
                <div class="card-body alert alert-success" style="margin-top: 15%">

                    <b>Account Name:</b> Blessing Learning Center.<br>
                    <b>Account No:</b>  01109737004500.<br>
                    <p>Indicate Project Details i.e project name and your corresponding details in your payment.</p>
                    <h5>Project Details</h5>
                    <p>Name: {{$project->name}}</p>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>