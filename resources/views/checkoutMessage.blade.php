@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Thank you for your application!</div>

                <div class="panel-body">
                    We have received your application, and are in process of reviewing them.
                    Application reviews take 2-4 business days to be reviewed, upon which you shall be contacted by our program coordinator(s).
                </div>
                <a href='{{url("/home")}}'><button type="submit" class="btn btn-primary">Click to go back to Home Page</button></a>
            </div>
        </div>
    </div>
</div>
@endsection
