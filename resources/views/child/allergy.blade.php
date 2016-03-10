@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<h1 class="text-center">Registrant Information</h1>
			<h3 class="text-center">Allergy & Medical Information</h3>

			<div class="panel panel-default">
				<div class="panel-heading">Enter Child Allergies & Medication</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ URL::action('ChildAllergyController@store',[$child->id])}}">
                        {!! csrf_field() !!}

                        <h3 class="text-center">Does your child suffer from any allergies?</h3>
                        <div class="text-center">
                        	<label class="radio-inline">
							  <input type="radio" name="is_allergic"  value="yes">yes
							</label>
							<label class="radio-inline">
							  <input type="radio" name="is_allergic" value="no">no
							</label>
                        </div>
                        <br>
                        <p class="text-center">If you answered yes, please complete the section below.</p>
                        <hr>
                        
                        
                        <div class="form-group{{ $errors->has('allergy') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Allergies <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" placeholder="List all allergies of child" class="form-control" name="allergy" value="{{ old('allergy') }}">

                                @if ($errors->has('allergy'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('allergy') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('symptoms') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Allergy Symptoms<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" placeholder="Describe the symptoms of the allergies" class="form-control" name="symptoms" value="{{ old('symptoms') }}">

                                @if ($errors->has('symptoms'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('symptoms') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('treatment') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Allergy Treatment<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" placeholder="Detail information needed for allergy treatment" class="form-control" name="treatment" value="{{ old('treatment') }}">

                                @if ($errors->has('treatment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('treatment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('medication') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Medication</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="medication" placeholder="List all medications the child may need" value="{{ old('medication') }}">

                                @if ($errors->has('medication'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('medication') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary pull-right">
                                    Add Allergy Info
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
