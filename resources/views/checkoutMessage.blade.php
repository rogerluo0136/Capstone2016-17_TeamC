@extends('layouts.app')

@section('css')
<style type="text/css">
.no-color{
    background-color:inherit;
    color: black;
    border-left: 2px solid #4989bd;
}
p{
    color: white;
}
</style>
@endsection


@section('content')
<center>
    <h1>Music Program Registration </h1>
    <p> Thank you for your application!</p>

    </br>

</center>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="progress">
              <div class="progress-bar progress-bar-active" style="width: 33%; min-width: 2em;">
                Registrant & Program Selection
              </div>
              <div class="progress-bar progress-bar-active" style="width: 33%; min-width: 2em;">
                Verification
              </div>
              <div class="progress-bar progress-bar-acitve" style="width: 33%; min-width: 2em;">
                Finish
              </div>
            </div>
        </div>

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-body">
                    We have received your application, and are in process of reviewing them.
                    Application reviews take 2-4 business days to be reviewed, upon which you shall be contacted by our program coordinator(s).
                </div>
                <a href='{{url("/home")}}'><button type="submit" class="btn btn-primary center-block">Click to go back to Home Page</button></a>
            </div>
        </div>
    </div>
</div>
@endsection
