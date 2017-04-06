@extends('layouts.form')

@section('js')
<script src="{{ asset('/js/update.js') }}"></script>
@endsection

@section('content')
<?php $allergy=$child->allergy;?>
<center>
    <h1>View and Edit Your Child’s Information</h1>
    <p class="lead" style="width:50%">
        You may make any necessary changes to your child's information.
    </p>
</center>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					Allergy Information: {{$child->first_name}} {{$child->last_name}}
				</div>

				<div class="panel-body">
						    
	                <form class="form-horizontal updatePanel" role="form" method="POST" action="{{ URL::action('ChildAllergyController@update',[$child->id,$allergy->id])}}">

                        <div class="row">
                            <div class="col-md-4">
                                <h4>Does your child have any allergies?</h4>
                            </div>
                            <div class="form-group{{ $errors->has('has_allergy') ? ' has-error' : '' }}">
                                <div class="col-md-1">
                                    <div class="radio">
                                      <label>
                                        <input type="radio" name="has_allergy" id="has_allergy" value="no"{{ $allergy->has_allergy=="no" ? ' checked' : "" }}>
                                        No
                                      </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="radio">
                                      <label>
                                        <input type="radio" name="has_allergy" id="has_allergy" value="yes"{{ $allergy->has_allergy=="yes" ? ' checked' : "" }}>
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
                            <div class="col-md-6 ">
                                <h5>If Yes, please describe (types and symptoms):</h5>
                                <div class="form-group{{ $errors->has('allergy_type_symptom') ? ' has-error' : '' }}">
                                    <textarea class="form-control" rows="3" name="allergy_type_symptom" value="{{ !is_null($allergy->allergy_type_symptom) ? $allergy->allergy_type_symptom : '' }}"></textarea>

                                    @if ($errors->has('allergy_type_symptom'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('allergy_type_symptom') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5>If yes, what is the treatment for the allergic reaction?</h5>
                                <div class="form-group{{ $errors->has('allergy_explaination') ? ' has-error' : '' }}">
                                    <textarea class="form-control" rows="3" name="allergy_explaination" value="{{ !is_null($allergy->allergy_explaination) ? $allergy->allergy_explaination : '' }}"></textarea>
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
                                        <input type="radio" name="has_medication" id="has_medication" value="no" {{ $allergy->has_medication=="no" ? ' checked' : "" }}>
                                        No
                                      </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="radio">
                                      <label>
                                        <input type="radio" name="has_medication" id="has_medication" value="yes"{{ $allergy->has_medication=="yes" ? ' checked' : "" }}>
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
                            <div class="form-group{{ $errors->has('medication_explaination') ? ' has-error' : '' }}">
                                <textarea class="form-control" rows="3" name="medication_explaination"></textarea value="{{ !is_null($allergy->medication_explaination) ? $allergy->medication_explaination : '' }}">
                            @if ($errors->has('medication_explaination'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('medication_explaination') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary center-block">
                                Update Allergy Information
                            </button>
                        </div>
                    </form>

	                


           		</div><!--panel body-->
                
                <hr>
                    <a  class=" pull-left" href="{{ url('/home') }}" style="">
                        <i class="glyphicon glyphicon-chevron-left"></i> Back to Main Page
                    </a>

                    <a  class=" pull-right" href="{{ url('/user/'.$user->id.'/child/'.$child->id.'/specialneededit') }}" style="">
                        View and Edit Special Needs Information <i class="glyphicon glyphicon-chevron-right"></i>
                    </a>
			</div><!--panel-->


		</div><!--col-->
	</div><!--row-->
</div><!--container-->
@endsection


