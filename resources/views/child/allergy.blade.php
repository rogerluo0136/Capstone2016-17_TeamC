@extends('layouts.form')

@section('content')
<center>
    <h1>Add Your Child’s Information</h1>
    <p class="lead" style="width:50%">
        Please enter your child’s information to access registration and account information. 
    </p>
</center>
<div class="container">
     @include('child.createinclude')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Allergies and Medications</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ URL::action('ChildAllergyController@store',[$child->id])}}">
                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-md-5">
                                <h4>Does your child have any allergies?</h4>
                            </div>
                            <div class="form-group{{ $errors->has('has_allergy') ? ' has-error' : '' }}">
                                <div class="col-md-1">
                                    <div class="radio">
                                      <label>
                                        <input type="radio" name="has_allergy" id="has_allergy" value="no" {{ session('allergy.has_allergy')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                        No
                                      </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="radio">
                                      <label>
                                        <input type="radio" name="has_allergy" id="has_allergy" value="yes" {{ session('allergy.has_allergy')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                        Yes
                                      </label>
                                    </div>
                                </div>

                                @if ($errors->has('has_allergy'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('has_allergy') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <h5>If Yes, please describe (types and symptoms):</h5>
                                <div class="form-group{{ $errors->has('allergy_type_symptom') ? ' has-error' : '' }} col-md-11">
                                    
                                    <textarea class="form-control" rows="3" autocomplete="on" name="allergy_type_symptom">{{session('allergy.allergy_type_symptom')}}</textarea>

                                    @if ($errors->has('allergy_type_symptom'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('allergy_type_symptom') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5>If yes, what is the treatment for the allergic reaction?</h5>
                                <div class="form-group{{ $errors->has('allergy_explaination') ? ' has-error' : '' }} col-md-11">
                                    <textarea class="form-control" rows="3" autocomplete="on" name="allergy_explaination">{{session('allergy.allergy_explaination')}}</textarea>
                                    @if ($errors->has('allergy_explaination'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('allergy_explaination') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <hr>
                        
                        <div class="row">
                            <div class="col-md-7">
                                <h4>Will your child be taking any medication while in the program?</h4>
                            </div>
                            <div class="form-group{{ $errors->has('has_medication') ? ' has-error' : '' }}">
                                <div class="col-md-1">
                                    <div class="radio">
                                      <label>
                                        <input type="radio" name="has_medication" id="has_medication" value="no" {{ session('allergy.has_medication')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                        No
                                      </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="radio">
                                      <label>
                                        <input type="radio" name="has_medication" id="has_medication" value="yes" {{ session('allergy.has_medication')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                        Yes
                                      </label>
                                    </div>
                                </div>

                                @if ($errors->has('has_medication'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('has_medication') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h5>If yes, you will be contacted for more information and please explain:</h5>
                            <div class="form-group{{ $errors->has('medication_explaination') ? ' has-error' : '' }} col-md-12">
                                <textarea class="form-control" rows="3" name="medication_explaination"> {{session('allergy.medication_explaination')}} </textarea>
                            @if ($errors->has('medication_explaination'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('medication_explaination') }}</strong>
                                </span>
                            @endif
                        </div>

                        
                        <hr>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary center-block">
                                Save Allergy Info and Next
                            </div>
                        </div>

                    </form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
