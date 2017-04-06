@extends('layouts.app')

@section('content')
<center>
    <h1>Welcome!</h1>
    <p class="lead" style="width:50%">
        Please fill in the following information to get started!
    </p>
</center>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Sign Up</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <input type="text" class="form-control registrateForm" name="username" placeholder="Username" value="{{ old('username') }}">

                                <a href="#"  data-toggle="popover" data-trigger="hover" data-content="No restrictions on usernames">
                                    <span class="glyphicon glyphicon-question-sign"></span></a>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <input type="email" class="form-control registrateForm" name="email" placeholder="E-Mail Address" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <input type="password" class="form-control registrateForm" name="password" placeholder="Password">

                                <a href="#"  data-toggle="popover" data-trigger="hover" data-content="6 digits minimum, no other restrictions">
                                    <span class="glyphicon glyphicon-question-sign"></span></a>


                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="col-md-10 col-md-offset-1">
                                <input type="password" class="form-control registrateForm" name="password_confirmation" placeholder="Confirm Password">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    Already have an account? &nbsp &nbsp<a href="{{ url('/login') }}" class="btn btn-primary" role="button"><i class="fa fa-btn fa-sign-in"></i>Login</a>
                </div>
            </div>      

        </div>
    </div>
</div>
@endsection
