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
				<div class="panel-heading">Sezuires and Pain Management</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ URL::action('ChildPainManagementController@store',[$child->id])}}">
                        {!! csrf_field() !!}

                        <div class="panel-group" id="accordion">
                            <!-- 1. Seizures -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        1. Seizures
                                        <a class="pull-right" data-toggle="collapse" data-parent="#accordion" href="#Seizures">
                                        <i class="glyphicon glyphicon-triangle-bottom"></i>
                                        </a>
                                    </h3>
                                </div>
                                <div id="Seizures" class="panel-collapse">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Will your child have seizure medication with them in the program? <span class="text-danger">*</span></h5>
                                            </div>
                                            <div class="col-md-2">                                
                                                <div class="form-group{{ $errors->has('seizure_medication') ? ' has-error' : '' }}">
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="seizure_medication"  value="no" {{ session('pain_management.seizure_medication')=="no" ? 'checked='.'"'.'checked'.'"' : '' }} >
                                                        No
                                                    </div>
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="seizure_medication" value="yes" {{ session('pain_management.seizure_medication')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                        Yes
                                                    </div>
                                                
                                                @if ($errors->has('seizure_medication'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('seizure_medication') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Has your child encountered seizures previously? <span class="text-danger">*</span></h5>
                                            </div>
                                            <div class="col-md-2">                                
                                                <div class="form-group{{ $errors->has('experiences_seizures') ? ' has-error' : '' }}">
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="experiences_seizures"  value="no" {{ session('pain_management.experiences_seizures')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                        No
                                                    </div>
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="experiences_seizures" value="yes" {{ session('pain_management.experiences_seizures')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                        Yes
                                                    </div>
                                                
                                                @if ($errors->has('experiences_seizures'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('experiences_seizures') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">

                                                <p class="col-md-offset-1">If yes, please answer the following seizure related questions: </p>

                                                <div class="col-md-3 col-md-offset-1">
                                                    <h5>Date of last seizure: </h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group{{ $errors->has('last_seizure') ? ' has-error' : '' }}">
                                                        <input type="date" class="form-control" name="last_seizure" min="1900-01-01" max="{{date("Y-m-d")}}" value="{{ session('pain_management.last_seizure') }}"/>

                                                        @if ($errors->has('last_seizure'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('last_seizure') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-11 col-md-offset-1">
                                                    <h5>What does a seizure look like (type, frequency, triggers, etc.?</h5>
                                                </div>
                                                <div class="col-md-8 col-md-offset-1">

                                                    <div class="form-group{{ $errors->has('seizure_details') ? ' has-error' : '' }}">
                                                        <textarea class="form-control" rows="3" name="seizure_details">{{session('pain_management.seizure_details')}}</textarea>

                                                        @if ($errors->has('seizure_details'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('seizure_details') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <hr>
                                       <!--  <a class="btn btn-primary pull-right" data-toggle="collapse" data-parent="#accordion" href="#Pain">
                                        Save and Go to Next Section <i class="glyphicon glyphicon-arrow-right"></i>
                                        </a> -->

                                    </div>
                                </div><!--div seizures panel body-->
                            </div><!--div seizures panel-->

                            <!-- 2. Pain -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        2. Pain
                                        <a class="pull-right" data-toggle="collapse" data-parent="#accordion" href="#Pain">
                                        <i class="glyphicon glyphicon-triangle-bottom"></i>
                                        </a>
                                    </h3>
                                </div>
                                <div id="Pain" class="panel-collapse">
                                      <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <h5>How does your child indicate pain? <span class="text-danger">*</span></h5>
                                                <div class="form-group{{ $errors->has('pain_indication') ? ' has-error' : '' }} col-md-12">
                                                    <textarea class="form-control" rows="4" name="pain_indication">{{ session('pain_management.pain_indication') }}</textarea>

                                                    @if ($errors->has('pain_indication'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('pain_indication') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10">
                                                <h5>How can we alleviate your child's pain? <span class="text-danger">*</span></h5>
                                                <div class="form-group{{ $errors->has('pain_alleviation') ? ' has-error' : '' }} col-md-12">
                                                    <textarea class="form-control" rows="4" name="pain_alleviation">{{ session('pain_management.pain_alleviation') }}</textarea>

                                                    @if ($errors->has('pain_alleviation'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('pain_alleviation') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <!-- <a class="btn btn-primary pull-right" data-toggle="collapse" data-parent="#accordion" href="#OtherInformation">
                                        Save and Go to Next Section <i class="glyphicon glyphicon-arrow-right"></i>
                                        </a> -->

                                      </div>
                                </div><!--div pain panel body-->
                            </div>

                            <!-- 3. Other Information -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        3. Other Information
                                        <a class="pull-right" data-toggle="collapse" data-parent="#accordion" href="#OtherInformation">
                                        <i class="glyphicon glyphicon-triangle-bottom"></i>
                                        </a>
                                    </h3>
                                </div>
                                <div id="OtherInformation" class="panel-collapse">
                                      <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h5>Does your child require: <span class="text-danger">*</span></h5>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('pain_requirements') ? ' has-error' : '' }}">
                                            <div class="col-md-6">
                                            
                                            <div class="checkbox">
                                              <label>
                                                <input type="checkbox" name="pain_requirements[]" value="none"> None
                                              </label>
                                            </div>
                                            <div class="checkbox">
                                              <label>
                                                <input type="checkbox" name="pain_requirements[]" value="suctioning-tip"> Suctioning (Tip)
                                              </label>
                                            </div>
                                            <div class="checkbox">
                                              <label>
                                                <input type="checkbox" name="pain_requirements[]"  value="suctioning-deep"> Suctioning (Deep)
                                              </label>
                                            </div>
                                            <div class="checkbox">
                                              <label>
                                                <input type="checkbox" name="pain_requirements[]"  value="physical-restraints"> Physical restraints e.g.: elbow splints, mitts
                                              </label>
                                            </div>
                                            <div class="checkbox">
                                              <label>
                                                <input type="checkbox" name="pain_requirements[]"  value="helmet"> Helmet
                                              </label>
                                            </div>
                                            <div class="checkbox-inline">
                                              
                                                <input type="checkbox" name="pain_requirements[]"  value="other"> Other, please describe: 
                                              
                                                <div class="form-group{{ $errors->has('requirement_other_details') ? ' has-error' : '' }}">
                                                    <input class="form-control" type="text" name="requirement_other_details" value="{{session('pain_management.requirement_other_details')}}">
                                                    @if ($errors->has('requirement_other_details'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('requirement_other_details') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            

                                            @if ($errors->has('pain_requirements'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('pain_requirements') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                      </div>
                                </div><!--div other information panel body-->
                            </div>

                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary center-block">
                                Save and Finish
                            </button>
                        </div>


                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection