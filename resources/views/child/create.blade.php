@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			
			<h1 class="text-center">Registrant Information</h1>
			<h3 class="text-center">General Information</h3>
			
			<div class="panel panel-default">
				<div class="panel-heading">Add child to your account</div>
				<div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ URL::action('UserChildController@store',[Auth::user()->id])}}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Name <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Date of Birth <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="dob" value="{{ old('dob') }}" required>

                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">gender <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select name="gender" class="form-control">
                                  <option value="male">male</option>
                                  <option value="female">female</option>
                                </select>
                               
                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('languages') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Languages Spoken <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="languages" value="{{ old('languages') }}" required>

                                @if ($errors->has('languages'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('languages') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lives_with') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Lives with: <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select name="lives_with" class="form-control">
                                  <option value="both parents">both parents</option>
                                  <option value="father">father</option>
                                  <option value="mother">mother</option>
                                  <option value="guardian">guardian</option>
                                  <option value="independent">independent</option>
                                  <option value="other">other</option>
                                </select>
                               
                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('health_card') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Health Card Number</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" name="health_card" value="{{ old('health_card') }}">

                                @if ($errors->has('health_card'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('health_card') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('fam_physician_name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Family Physician Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="fam_physician_name" value="{{ old('fam_physician_name') }}">

                                @if ($errors->has('fam_physician_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fam_physician_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('fam_physician_phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Family Physician Phone Number</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" name="fam_physician_phone" value="{{ old('fam_physician_phone') }}">

                                @if ($errors->has('fam_physician_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fam_physician_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-btn fa-user"></i>Add Child
                                </button>
                            </div>
                        </div>

               		</form>
           		</div>
			</div>
		</div>
	</div>
</div>
@endsection