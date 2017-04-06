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
				<div class="panel-heading">Special Needs</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ URL::action('ChildSpecialNeedController@store',[$child->id])}}">
                        {!! csrf_field() !!}


                        <div class="row">
                            <div class="col-md-4">
                                <h5>Does your child have any special needs? <span class="text-danger">*</span></h5>
                            </div>
                            <div class="col-md-2">                                
                                <div class="form-group{{ $errors->has('has_specialneeds') ? ' has-error' : '' }}">
                                    <div class="radio col-md-6">
                                        <input type="radio" name="has_specialneeds" id="has_specialneeds" value="no" {{ session('special_need.has_specialneeds')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                        No
                                    </div>
                                    <div class="radio col-md-6">
                                        <input type="radio" name="has_specialneeds" id="has_specialneeds" value="yes" {{ session('special_need.has_specialneeds')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                        Yes
                                    </div>
                                
                                @if ($errors->has('has_specialneeds'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('has_specialneeds') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('diagnosis') ? ' has-error' : '' }}">
                                    <label for="diagnosis" class="col-md-7 control-label">Diagnosis or Special Need(s):</label>
                                    <div class="col-md-5">
                                        <input id="diagnosis" type="text" class="form-control" name="diagnosis" value="{{session('special_need.diagnosis')}}">
                                    </div>

                                    @if ($errors->has('diagnosis'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('diagnosis') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Special Needs -->
                        <div class="panel-group" id="accordion">
                            <!-- 1. Mobility -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        1. Mobility
                                        <a class="pull-right" data-toggle="collapse" data-parent="#accordion" href="#Mobility">
                                        <i class="glyphicon glyphicon-triangle-bottom"></i>
                                        </a>
                                    </h3>
                                </div>
                                <div id="Mobility" class="panel-collapse in">
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5>Is your child risk at falling? <span class="text-danger">*</span></h5>
                                                <h6>(e.g. your child has fallen in the last three (3) months as a result of diagnosis - poor balance, dizziness, etc.)</h6>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group{{ $errors->has('risk_of_falling') ? ' has-error' : '' }}">

                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="risk_of_falling" id="risk_of_falling" value="no" {{ session('special_need.risk_of_falling')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                        No
                                                    </div>
                                                
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="risk_of_falling" id="risk_of_falling" value="yes" {{ session('special_need.risk_of_falling')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                        Yes
                                                    </div>

                                                    @if ($errors->has('risk_of_falling'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('risk_of_falling') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group{{ $errors->has('mobility_support') ? ' has-error' : '' }}">
                                            <label class="col-md-5 control-label">My child: <span class="text-danger">*</span></label>

                                            <div class="col-md-6">
                                                <select name="mobility_support" class="form-control">
                                                    <option value="None" {{ session('special_need.mobility_support')=="None" ? 'selected='.'"'.'selected'.'"' : '' }}>None</option>
                                                  <option value="Requires support when walking" {{ session('special_need.mobility_support')=="Requires support when walking" ? 'selected='.'"'.'selected'.'"' : '' }}>Requires support when walking</option>
                                                  <option value="Uses a walker" {{ session('special_need.mobility_support')=="Uses a walker" ? 'selected='.'"'.'selected'.'"' : '' }}>Uses a walker</option>
                                                  <option value="Uses a manual wheelchair" {{ session('special_need.mobility_support')=="Uses a manual wheelchair" ? 'selected='.'"'.'selected'.'"' : '' }} >Uses a manual wheelchair</option>
                                                  <option value="Uses an electric wheelchair" {{ session('special_need.mobility_support')=="Uses an electric wheelchair" ? 'selected='.'"'.'selected'.'"' : '' }}>Uses a electric wheelchair</option>
                                                  <option value="Requires an assistive device for lifts and transfers (e.g Hoyer lift, sling, etc)" {{ session('special_need.mobility_support')=="Requires an assistive device for lifts and transfers (e.g Hoyer lift, sling, etc)" ? 'selected='.'"'.'selected'.'"' : '' }}>Requires an assistive device for lifts and transfers (e.g Hoyer lift, sling, etc)</option>
                                                </select>
                                               
                                                @if ($errors->has('mobility_support'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('mobility_support') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('need_splints_orthotics') ? ' has-error' : '' }}">
                                            <label class="col-md-5 control-label">My child uses Splints/Orthotics: <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <select name="need_splints_orthotics" class="form-control">
                                                  <option value="no" {{ session('special_need.need_splints_orthotics')=="no" ? 'selected='.'"'.'selected'.'"' : '' }}>No</option>
                                                  <option value="yes" {{ session('special_need.need_splints_orthotics')=="yes" ? 'selected='.'"'.'selected'.'"' : '' }}>Yes</option>
                                                </select>
                                               
                                                @if ($errors->has('need_splints_orthotics'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('need_splints_orthotics') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('orthotics_when') ? ' has-error' : '' }}">
                                            <h5 class="col-md-8 control-label">If yes, orthotics are used when:</h5>
                                            <div class="col-md-3">
                                                <input id="orthotics_when" type="text" class="form-control" name="orthotics_when" value="{{session('special_need.orthotics_when')}}">
                                  
                                               
                                                @if ($errors->has('orthotics_when'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('orthotics_when') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('need_hand_over_hand') ? ' has-error' : '' }}">
                                            <label class="col-md-5 control-label">Does your child need hand-over-hand assistance? <span class="text-danger">*</span></label>
                                          <div class="col-md-2"> 
                                                <!-- old select box <select name="need_hand_over_hand" class="form-control">
                                                  <option value="no">No</option>
                                                  <option value="yes">Yes</option>
                                                </select> -->
                                                <div class="radio col-md-6">
                                                        <input type="radio" name="need_hand_over_hand" id="need_hand_over_hand" value="no" {{ session('special_need.need_hand_over_hand')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                        No
                                                    </div>
                                                
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="need_hand_over_hand" id="need_hand_over_hand" value="yes" {{ session('special_need.need_hand_over_hand')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                        Yes
                                                    </div>
                                               
                                                @if ($errors->has('need_hand_over_hand'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('need_hand_over_hand') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <hr>
                                        <!-- <a class="btn btn-primary pull-right" data-toggle="collapse" data-parent="#accordion" href="#Toileting">
                                        Save and Go to Next Section <i class="glyphicon glyphicon-arrow-right"></i>
                                        </a> -->

                                    </div>
                                </div><!--div mobility panel body-->
                            </div><!--div mobility panel-->

                            <!-- 2. Toileting -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        2. Toileting
                                        <a class="pull-right" data-toggle="collapse" data-parent="#accordion" href="#Toileting">
                                        <i class="glyphicon glyphicon-triangle-bottom"></i>
                                        </a>
                                    </h3>
                                </div>
                                <div id="Toileting" class="panel-collapse">
                                      <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                    <h5>Child's weight: <span class="text-danger">*</span></h5>
                                            </div>
                                            <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                                                <div class="input-group col-md-2">
                                                    <input id="weight" type="text" class="form-control" name="weight" required value="{{session('special_need.weight')}}"><span class="input-group-addon">kg</span>


                                                    @if ($errors->has('weight'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('weight') }}</strong>
                                                        </span>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Does your child need assistance when toileting? <span class="text-danger">*</span></h5>
                                            </div>
                                            <div class="col-md-2">                                
                                                <div class="form-group{{ $errors->has('need_toiletting_assisstance') ? ' has-error' : '' }}">
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="need_toiletting_assisstance" id="need_toiletting_assisstance" value="no" {{ session('special_need.need_toiletting_assisstance')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                        No
                                                    </div>
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="need_toiletting_assisstance" id="need_toiletting_assisstance" value="yes" {{ session('special_need.need_toiletting_assisstance')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                        Yes
                                                    </div>
                                                
                                                @if ($errors->has('need_toiletting_assisstance'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('need_toiletting_assisstance') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10">
                                                <h5>If Yes, specify toileting routine details (If applicable, please send slings and personal care items with your child): </h5>
                                                <div class="form-group{{ $errors->has('toiletting_details') ? ' has-error' : '' }} col-md-12">
                                                    <textarea class="form-control" rows="3" name="toiletting_details">{{session('special_need.toiletting_details')}}</textarea>

                                                    @if ($errors->has('toiletting_details'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('toiletting_details') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <!-- <a class="btn btn-primary pull-right" data-toggle="collapse" data-parent="#accordion" href="#Eating">
                                        Save and Go to Next Section <i class="glyphicon glyphicon-arrow-right"></i>
                                        </a> -->

                                      </div>
                                </div><!--div toileting panel body-->
                            </div><!--div toileting panel-->

                            <!-- 3. Eating -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        3. Eating
                                        <a class="pull-right" data-toggle="collapse" data-parent="#accordion" href="#Eating">
                                        <i class="glyphicon glyphicon-triangle-bottom"></i>
                                        </a>
                                    </h3>
                                </div>
                                <div id="Eating" class="panel-collapse">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h5>Does your child need assistance eating? <span class="text-danger">*</span></h5>
                                            </div>
                                            <div class="col-md-2">                                
                                                <div class="form-group{{ $errors->has('need_eating_assisstance') ? ' has-error' : '' }}">
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="need_eating_assisstance" id="need_eating_assisstance" value="no" {{ session('special_need.need_eating_assisstance')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                        No
                                                    </div>
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="need_eating_assisstance" id="need_eating_assisstance" value="yes" {{ session('special_need.need_eating_assisstance')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                        Yes
                                                    </div>
                                                
                                                @if ($errors->has('need_eating_assisstance'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('need_eating_assisstance') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10">
                                                <h5>If Yes, type of assistance required (if applicable, please send all food/equipment your child requires): </h5>
                                                <div class="form-group{{ $errors->has('eating_details') ? ' has-error' : '' }} col-md-12">
                                                    <textarea class="form-control" rows="3" name="eating_details">{{session('special_need.eating_details')}}</textarea>

                                                    @if ($errors->has('eating_details'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('eating_details') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <!-- <a class="btn btn-primary pull-right" data-toggle="collapse" data-parent="#accordion" href="#Communication">
                                        Save and Go to Next Section <i class="glyphicon glyphicon-arrow-right"></i>
                                        </a> -->

                                    </div>
                                </div><!-- div eating panel body-->
                            </div><!--div eating panel-->

                            <!-- 4. Communication -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        4. Communication
                                        <a class="pull-right" data-toggle="collapse" data-parent="#accordion" href="#Communication">
                                        <i class="glyphicon glyphicon-triangle-bottom"></i>
                                        </a>
                                    </h3>
                                </div>
                                <div id="Communication" class="panel-collapse">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Does your child need assistance communicating? <span class="text-danger">*</span></h5>
                                            </div>
                                            <div class="col-md-2">                                
                                                <div class="form-group{{ $errors->has('need_communication_assisstance') ? ' has-error' : '' }}">
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="need_communication_assisstance" id="need_communication_assisstance" value="no" {{ session('special_need.need_communication_assisstance')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                        No
                                                    </div>
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="need_communication_assisstance" id="need_communication_assisstance" value="yes" {{ session('special_need.need_communication_assisstance')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                        Yes
                                                    </div>
                                                
                                                @if ($errors->has('need_communication_assisstance'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('need_communication_assisstance') }}</strong>
                                                    </span>
                                                @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5>My child communicates: <span class="text-danger">*</span></h5>
                                            </div>
                                            <div class="col-md-6 ">
                                                <div class="form-group{{ $errors->has('communication_means') ? ' has-error' : '' }}">

                                                    <div class="col-md-4">
                                                        <div class="checkbox">
                                                          <label>
                                                            <input type="checkbox" name="communication_means[]" value="verbally" <?php if(str_contains(session('special_need.communication_means'),'verbally')) echo "checked='checked'" ?> > Verbally
                                                          </label>
                                                        </div>
                                                        <div class="checkbox">
                                                          <label>
                                                            <input type="checkbox" name="communication_means[]"  value="gestures" <?php if(str_contains(session('special_need.communication_means'),'gestures')) echo "checked='checked'" ?> > With gestures
                                                          </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="checkbox">
                                                          <label>
                                                            <input type="checkbox" name="communication_means[]"  value="device" <?php if(str_contains(session('special_need.communication_means'),'device')) echo "checked='checked'" ?> > With an assistive device/book
                                                          </label>
                                                        </div>
                                                        <div class="checkbox">
                                                          <label>
                                                            <input type="checkbox" name="communication_means[]"  value="pictures" <?php if(str_contains(session('special_need.communication_means'),'pictures')) echo "checked='checked'" ?> > With pictures
                                                          </label>
                                                        </div>
                                                        <!--verbally,gestures,device,pictures-->
                                                        @if ($errors->has('communication_means'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('communication_means') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h5>My child communicates "yes" by: <span class="text-danger">*</span></h5>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('communicates_yes') ? ' has-error' : '' }}">
                                                    
                                                     <input type="text" class="form-control" name="communicates_yes" value="{{ session('special_need.communicates_yes') }}">

                                                    @if ($errors->has('communicates_yes'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('communicates_yes') }}</strong>
                                                        </span>
                                                    @endif
                                                   
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-5">
                                                <h5>My child communicates "no" by: <span class="text-danger">*</span></h5>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('communicates_no') ? ' has-error' : '' }}">
                                                    
                                                     <input type="text" class="form-control" name="communicates_no" value="{{ session('special_need.communicates_no') }}">

                                                    @if ($errors->has('communicates_no'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('communicates_no') }}</strong>
                                                        </span>
                                                    @endif
                                                
                                                </div>
                                            </div>
                                        </div>

                                        <h5 style="color:red">*Please send appropriate communication devices, books and aids with your child.</h5>

                                        <hr>
                                       <!--  <a class="btn btn-primary pull-right" data-toggle="collapse" data-parent="#accordion" href="#Behavior">
                                        Save and Go to Next Section <i class="glyphicon glyphicon-arrow-right"></i>
                                        </a> -->
                                    </div>
                                </div><!--div communiation panel body-->
                            </div><!--div communication panel-->

                            <!-- 5. Behavior -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        5. Behavior
                                        <a class="pull-right" data-toggle="collapse" data-parent="#accordion" href="#Behavior">
                                        <i class="glyphicon glyphicon-triangle-bottom"></i>
                                        </a>
                                    </h3>
                                </div>
                                <div id="Behavior" class="panel-collapse">
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-md-5">
                                                <h5><b>While in a program, could your child: <span class="text-danger">*</span></b></h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-md-9">
                                                    <h5>Get overwhelmed by loud/sudden noises? </h5>
                                                </div> 
                                                <div class="col-md-3">                               
                                                    <div class=" form-group{{ $errors->has('overwhelm_noise') ? ' has-error' : '' }}">
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="overwhelm_noise" value="no" {{ session('special_need.overwhelm_noise')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                            No
                                                        </div>
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="overwhelm_noise" value="yes" {{ session('special_need.overwhelm_noise')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                            Yes
                                                        </div>
                                                    
                                                    @if ($errors->has('overwhelm_noise'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('overwhelm_noise') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="col-md-9">
                                                    <h5>Harm someone else? </h5>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group{{ $errors->has('harm_others') ? ' has-error' : '' }}">
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="harm_others" value="no" {{ session('special_need.harm_others')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                            No
                                                        </div>
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="harm_others" value="yes" {{ session('special_need.harm_others')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                            Yes
                                                        </div>
                                                    
                                                    @if ($errors->has('harm_others'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('harm_others') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-md-9">
                                                    <h5>Get overwhelmed by large groups of people? </h5>
                                                </div>  
                                                <div class="col-md-3">                              
                                                    <div class="form-group{{ $errors->has('overwhelm_people') ? ' has-error' : '' }}">
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="overwhelm_people" value="no" {{ session('special_need.overwhelm_people')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                            No
                                                        </div>
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="overwhelm_people" value="yes" {{ session('special_need.overwhelm_people')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                            Yes
                                                        </div>
                                                    
                                                    @if ($errors->has('overwhelm_people'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('overwhelm_people') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="col-md-9">
                                                    <h5>Harm themselves? </h5>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group{{ $errors->has('harm_self') ? ' has-error' : '' }}">
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="harm_self" value="no" {{ session('special_need.harm_self')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                            No
                                                        </div>
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="harm_self" value="yes" {{ session('special_need.harm_self')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                            Yes
                                                        </div>
                                                    
                                                    @if ($errors->has('harm_self'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('harm_self') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-md-9">
                                                    <h5>Try to run away or leave the group/activity? </h5>
                                                </div>  
                                                <div class="col-md-3">                            
                                                    <div class="form-group{{ $errors->has('leaves_group') ? ' has-error' : '' }}">
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="leaves_group" value="no" {{ session('special_need.leaves_group')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                            No
                                                        </div>
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="leaves_group" value="yes" {{ session('special_need.leaves_group')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                            Yes
                                                        </div>
                                                    
                                                    @if ($errors->has('leaves_group'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('leaves_group') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="col-md-9">
                                                    <h5>Participate successfully in a group? </h5>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group{{ $errors->has('successful_participation') ? ' has-error' : '' }}">
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="successful_participation" value="no" {{ session('special_need.successful_participation')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                            No
                                                        </div>
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="successful_participation" value="yes" {{ session('special_need.successful_participation')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                                            Yes
                                                        </div>
                                                    
                                                    @if ($errors->has('successful_participation'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('successful_participation') }}</strong>
                                                        </span>
                                                    @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <h5>Please briefly describe any triggers of your child's behavior and what we can do to help. </h5>
                                                <div class="form-group{{ $errors->has('trigger') ? ' has-error' : '' }} col-md-12">
                                                    <textarea class="form-control" rows="4" name="trigger">{{session('special_need.trigger')}}</textarea>

                                                    @if ($errors->has('trigger'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('trigger') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-10">
                                                <h5>Have there been any recent and major changes in your child's life? </h5>
                                                <div class="form-group{{ $errors->has('major_change') ? ' has-error' : '' }} col-md-12">
                                                    <textarea class="form-control" rows="4" name="major_change">{{session('special_need.major_change')}}</textarea>

                                                    @if ($errors->has('major_change'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('major_change') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-10">
                                                <h5>What types of activities does your child like doing? </h5>
                                                <div class="form-group{{ $errors->has('activities') ? ' has-error' : '' }} col-md-12">
                                                    <textarea class="form-control" rows="4" name="activities">{{session('special_need.activities')}}</textarea>

                                                    @if ($errors->has('activities'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('activities') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--div behavior panel body-->
                            </div><!--div behavior panel-->

                        </div> <!--div panel group-->

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary center-block">
                                Add Special Needs Info and Next
                            </button>
                        </div>
                    </form>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection