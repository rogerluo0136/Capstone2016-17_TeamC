@extends('layouts.app')

@section('content')
<div class="container">

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			
			<h1 class="text-center">Registrant Information</h1>
			<h3 class="text-center">Emergency Contact</h3>
			
			<div class="panel panel-default">
				<div class="panel-heading">Child Emergency Contact</div>
				<div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ URL::action('ChildEmergencyContactController@store',[$child->id])}}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Contact Name <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('relationship') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Relationship <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="relationship" value="{{ old('relationship') }}" required>

                                @if ($errors->has('relationship'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('relationship') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Contact Email <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('street_address') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Street Address <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="street_address" value="{{ old('street_address') }}" required>

                                @if ($errors->has('street_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('street_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">City <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="city" value="{{ old('city') }}" required>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('province') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Province <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="province" value="{{ old('province') }}" required>

                                @if ($errors->has('province'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('province') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Postal Code <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="postal_code" value="{{ old('postal_code') }}" required>

                                @if ($errors->has('postal_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cell_phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Cell Phone <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" name="cell_phone" value="{{ old('cell_phone') }}" required>

                                @if ($errors->has('cell_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cell_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('home_phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Home Phone</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" name="home_phone" value="{{ old('home_phone') }}" >

                                @if ($errors->has('home_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('home_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('work_phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Work Phone</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" name="work_phone" value="{{ old('work_phone') }}" >

                                @if ($errors->has('work_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('work_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary pull-right">
                                    Add Emergency Contact
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