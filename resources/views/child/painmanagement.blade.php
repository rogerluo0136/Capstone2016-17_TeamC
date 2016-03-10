@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h1 class="text-center">Registrant Information</h1>
			<h3 class="text-center">Pain Management</h3>

			<div class="panel panel-default">
				<div class="panel-heading">Sezuires and Pain</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ URL::action('ChildPainManagementController@store',[$child->id])}}">
                        {!! csrf_field() !!}

                        <h3>Seozures</h3>
                        <div class="form-group{{ $errors->has('experiences_seizures') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Does your child encountered seizures previously? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                
								  <label>
								    <input type="radio" name="experiences_seizures" value="yes"> yes
								  </label>
								
								
								  <label>
								    <input type="radio" name="experiences_seizures"  value="no"> no
								  </label>
								

                                @if ($errors->has('experiences_seizures'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('experiences_seizures') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <p> &nbsp;&nbsp;&nbsp;&nbsp; if yes, answer the following seizure related questions</p>
                        <hr>
                        <div class="form-group{{ $errors->has('last_seizure') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">When was the last seizure encounter </label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="last_seizure" value="{{ old('last_seizure') }}"/>

                                @if ($errors->has('last_seizure'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_seizure') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('seizure_frequency') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Specify seizure frequency </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="seizure_frequency" value="{{ old('seizure_frequency') }}"/>

                                @if ($errors->has('seizure_frequency'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('seizure_frequency') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('seizure_trigger') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">What triggers the seizure </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="seizure_trigger" value="{{ old('seizure_trigger') }}"/>

                                @if ($errors->has('seizure_trigger'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('seizure_trigger') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('seizure_medication') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">List any medication taken for seizures</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="seizure_medication" value="{{ old('seizure_medication') }}"/>

                                @if ($errors->has('seizure_medication'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('seizure_medication') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <h3>Pain Management</h3>
                        <div class="form-group{{ $errors->has('pain_indication') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">How does your child indicate pain</label>

                            <div class="col-md-6">
                                <textarea row="4" class="form-control" name="pain_indication" value="{{ old('pain_indication') }}"/></textarea>

                                @if ($errors->has('pain_indication'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pain_indication') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('pain_alleviation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">How can we alleviate your child's pain</label>

                            <div class="col-md-6">
                                <textarea row="4" class="form-control" name="pain_alleviation" value="{{ old('pain_alleviation') }}"/></textarea>

                                @if ($errors->has('pain_alleviation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pain_alleviation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pain_requirements') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Possible child requirements </label>

                            <div class="col-md-6">
                                <div class="checkbox">
								  <label>
								    <input type="checkbox" name="pain_requirements" value="suctioning-tip"> Suctioning (Tip)
								  </label>
								</div>
								<div class="checkbox">
								  <label>
								    <input type="checkbox" name="pain_requirements"  value="suctioning-deep"> Suctioning (Deep)
								  </label>
								</div>
								<div class="checkbox">
								  <label>
								    <input type="checkbox" name="pain_requirements"  value="physical-restraints"> Physical restraints e.g.: elbow splints, mitts
								  </label>
								</div>
								<div class="checkbox">
								  <label>
								    <input type="checkbox" name="pain_requirements"  value="helmet"> Helmet
								  </label>
								</div>

                                @if ($errors->has('pain_requirements'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pain_requirements') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary pull-right">
                                    Finish
                                </button>
                            </div>
                        </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection