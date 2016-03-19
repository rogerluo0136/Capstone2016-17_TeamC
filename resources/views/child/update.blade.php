<div class="panel panel-default">
	<!--include name-->
	<div class="panel-heading">
  		<h4 class="panel-title"> {{ $child->name }}</h4>
	</div>
	
		<div class="panel-body">
		<!--GENERAL INFORMATION-->
		<div class="panel panel-default">
			<div class="panel-heading">
				<a data-toggle="collapse" href="#general-info-{{$child->id}}" aria-expanded="false" aria-controls="general-info-{{$child->id}}">
						General Info
				</a> 
			</div>
			<div class="panel-collapse collapse in" id="general-info-{{$child->id}}">
				<div class="panel-body" >
                    <form class="form-horizontal updatePanel"  role="form" method="POST" action="{{ URL::action('UserChildController@update',[Auth::user()->id,$child->id])}}">
                       
                        <input type="hidden" name="name" value="{{ $child->name }}">
                        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Date of Birth <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="dob" value="{{ $child->dob }}" required>

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
                                  <option value="male" {{ $child->gender=='male' ? ' selected' : ''}}>male</option>
                                  <option value="female" {{ $child->gender=='female' ? ' selected' : ''}} >female</option>
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
                                <input type="text" class="form-control" name="languages" value="{{ $child->languages }}" required>

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
                                  <option value="both parents" {{ $child->lives_with=="both parents" ? 'selected' : '' }}>both parents</option>
                                  <option value="father" {{ $child->lives_with=="father" ? 'selected' : '' }}>father</option>
                                  <option value="mother" {{ $child->lives_with=="mother" ? 'selected' : '' }}>mother</option>
                                  <option value="guardian" {{ $child->lives_with=="guardian" ? 'selected' : '' }}>guardian</option>
                                  <option value="independent" {{ $child->lives_with=="independent" ? 'selected' : '' }}>independent</option>
                                  <option value="other" {{ $child->lives_with=="other" ? 'selected' : '' }}>other</option>
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
                                <input type="number" class="form-control" name="health_card" value="{{ $child->health_card }}">

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
                                <input type="text" class="form-control" name="fam_physician_name" value="{{ $child->fam_physician_name }}">

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
                                <input type="number" class="form-control" name="fam_physician_phone" value="{{ $child->fam_physician_phone }}">

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
                                    <i class="fa fa-btn fa-user"></i>Update General Information
                                </button>
                            </div>
                        </div>

               		</form>
           		</div>
			</div>
			
		</div>

		<!--EMERGENCY CONTACT INFO-->
		<?php $contact=$child->emergencyContact;?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<a  data-toggle="collapse" href="#emergency-contact-{{$child->id}}" aria-expanded="false" aria-controls="emergency-contact-{{$child->id}}">
						Child Emergency Contact
				</a>
				<small class="">(click to expand)</small>
			</div>

			<div class="panel-collapse collapse" id="emergency-contact-{{$child->id}}">
				<div class="panel-body" >
                    <form class="form-horizontal updatePanel" role="form" method="POST" action="{{ URL::action('ChildEmergencyContactController@update',[$child->id,$contact->id])}}">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Contact Name <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $contact->name }}" required>

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
                                <input type="text" class="form-control" name="relationship" value="{{ $contact->relationship }}" required>

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
                                <input type="email" class="form-control" name="email" value="{{ $contact->email }}" required>

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
                                <input type="text" class="form-control" name="street_address" value="{{ $contact->street_address }}" required>

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
                                <input type="text" class="form-control" name="city" value="{{ $contact->city }}" required>

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
                                <input type="text" class="form-control" name="province" value="{{ $contact->province }}" required>

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
                                <input type="text" class="form-control" name="postal_code" value="{{ $contact->postal_code }}" required>

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
                                <input type="number" class="form-control" name="cell_phone" value="{{ $contact->cell_phone }}" required>

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
                                <input type="number" class="form-control" name="home_phone" value="{{ $contact->home_phone }}" >

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
                                <input type="number" class="form-control" name="work_phone" value="{{ $contact->work_phone }}" >

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
                                    Update Emergency Contact
                                </button>
                            </div>
                        </div>
               		</form>
           		</div>
			</div>
			
		</div>


		<!--CHILD ALLERGY-->
		<?php $allergy=$child->allergy;?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<a  data-toggle="collapse" href="#allergy-medication-{{$child->id}}" aria-expanded="false" aria-controls="allergy-medication-{{$child->id}}">
						Child Allergies & Medication
				</a>
				<small class="">(click to expand)</small>
			</div>
			<div class="panel-collapse collapse" id="allergy-medication-{{$child->id}}">
				<div class="panel-body">
					<form class="form-horizontal updatePanel" role="form" method="POST" action="{{ URL::action('ChildAllergyController@update',[$child->id,$allergy->id])}}">

                        <h3 class="text-center">Does your child suffer from any allergies?</h3>
                        <div class="text-center">
                        	<label class="radio-inline">
							  <input type="radio" name="is_allergic" value="yes" {{ $allergy->is_allergic=="yes" ? ' checked' : "" }}>yes
							</label>
							<label class="radio-inline">
							  <input type="radio" name="is_allergic" value="no" {{$allergy->is_allergic=="no" ? ' checked' : "" }}>no
							</label>
                        </div>
                        <br>
                        <p class="text-center">If you answered yes, please complete the section below.</p>
                        <hr>
                        
                        
                        <div class="form-group{{ $errors->has('allergy') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Allergies <span class="text-danger">*</span></label>

                            <div class="col-md-6">

                                <input type="text" placeholder="List all allergies of child" class="form-control" name="allergy" value="{{ $allergy->is_allergic=="yes" ? $allergy->allergy : '' }}">

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
                                <input type="text" placeholder="Describe the symptoms of the allergies" class="form-control" name="symptoms" value="{{ $allergy->is_allergic=="yes" ? $allergy->symptoms : '' }}">

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
                                <input type="text" placeholder="Detail information needed for allergy treatment" class="form-control" name="treatment" value="{{ $allergy->is_allergic=="yes" ? $allergy->treatment : '' }}">

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
                                <input type="text" class="form-control" name="medication" placeholder="List all medications the child may need" value="{{ $allergy->is_allergic=="yes" ? $allergy->medication : '' }}">

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
                                    Update Allergy Info
                                </button>
                            </div>
                        </div>
                    </form>
				</div>
			</div>
			
		</div>

		<!--Special Needs-->
		<?php $sn=$child->specialNeed;?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<a  data-toggle="collapse" href="#special-needs-{{$child->id}}" aria-expanded="false" aria-controls="special-needs-{{$child->id}}">
						Special Needs
				</a>
				<small class="">(click to expand)</small>
			</div>

			<div class="panel-collapse collapse" id="special-needs-{{$child->id}}">
				<div class="panel-body" >
					<form class="form-horizontal updatePanel" role="form" method="POST" action="{{ URL::action('ChildSpecialNeedController@update',[$child->id,$sn->id])}}">
                        

                        <h3>Mobility</h3>
                        <div class="form-group{{ $errors->has('risk_of_falling') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Is Your Child at risk of Falling? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="radio">
								  <label>
								    <input type="radio" name="risk_of_falling" value="yes" {{ $sn->risk_of_falling=='yes' ? ' checked' : ''}} > yes
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="risk_of_falling"  value="no" {{ $sn->risk_of_falling=='no' ? ' checked' : ''}} > no
								  </label>
								</div>

                                @if ($errors->has('risk_of_falling'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('risk_of_falling') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobility_support') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">My child: <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="radio">
								  <label>
								    <input type="radio" name="mobility_support" value="Does not require support when walking" {{ $sn->mobility_support=='Does not require support when walking' ? ' checked' : ''}}>
								    Does not require support when walking
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="mobility_support"  value="Requires support when walking" {{ $sn->mobility_support=='Requires support when walking' ? ' checked' : ''}} >
								    Requires support when walking
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="mobility_support"  value="Uses a walker" {{ $sn->mobility_support=='Uses a walker' ? ' checked' : ''}}>
								    Uses a Walker
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="mobility_support"  value="Uses a wheelchair" {{ $sn->mobility_support=='Uses a wheelchair' ? ' checked' : ''}}>
								    Uses a wheelchair
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="mobility_support"  value="Uses an electric wheelchair" {{ $sn->mobility_support=='Uses an electric wheelchair' ? ' checked' : ''}}>
								    Uses an electric wheelchair
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="mobility_support"  value="Requires an assistive device for lifts and transfers (e.g. Hoyer lift, sling, etc.)"{{ $sn->mobility_support=='Requires an assistive device for lifts and transfers (e.g. Hoyer lift, sling, etc.)' ? ' checked' : ''}}>
								    Requires an assistive device for lifts and transfers (e.g. Hoyer lift, sling, etc.)
								  </label>
								</div>

                                @if ($errors->has('mobility_support'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobility_support') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('requires_orthotics') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Does your child use splint/orthotics? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="radio">
								  <label>
								    <input type="radio" name="requires_orthotics" value="yes" {{ $sn->requires_orthotics=='yes' ? ' checked' : ''}}> yes
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="requires_orthotics"  value="no" {{ $sn->requires_orthotics=='no' ? ' checked' : ''}}> no
								  </label>
								</div>

                                @if ($errors->has('requires_orthotics'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('requires_orthotics') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('orthotics_when') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">If yes, orthotics are used when </label>

                            <div class="col-md-6">
                                <textarea name="orthotics_when" class="form-control" rows="3">{{ $sn->orthotics_when }}</textarea>

                                @if ($errors->has('orthotics_when'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('orthotics_when') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('hand_over_hand_assisstance') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Does your child need hand-over-hand assisstance? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="radio">
								  <label>
								    <input type="radio" name="hand_over_hand_assisstance" value="yes" {{ $sn->hand_over_hand_assisstance=='yes' ? ' checked' : '' }} > yes
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="hand_over_hand_assisstance"  value="no" {{ $sn->hand_over_hand_assisstance=='no' ? ' checked' : '' }} > no
								  </label>
								</div>

                                @if ($errors->has('hand_over_hand_assisstance'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hand_over_hand_assisstance') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <h3>Toileting</h3>
                        <div class="form-group{{ $errors->has('toiletting_assisstance') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Does your child need toileting assisstance? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="radio">
								  <label>
								    <input type="radio" name="toiletting_assisstance" value="yes" {{ $sn->toiletting_assisstance="yes" ? ' checked' : '' }}> yes
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="toiletting_assisstance"  value="no" {{ $sn->toiletting_assisstance="no" ? ' checked' : '' }}> no
								  </label>
								</div>

                                @if ($errors->has('toiletting_assisstance'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('toiletting_assisstance') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('toiletting_details') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">If yes, specify toileting routine details </label>

                            <div class="col-md-6">
                                <textarea name="toiletting_details" class="form-control" rows="3"> {{ $sn->toiletting_details }}</textarea>

                                @if ($errors->has('toiletting_details'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('toiletting_details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">weight (lb) <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                 <input type="number" class="form-control" name="weight" value="{{ $sn->weight }}" required>

                                @if ($errors->has('weight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <h3>Eating</h3>
                        <div class="form-group{{ $errors->has('eating_assisstance') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Does your child need assisstance with eating? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="radio">
								  <label>
								    <input type="radio" name="eating_assisstance" value="yes"{{$sn->eating_assisstance=='yes' ? ' checked' : ''}}> yes
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="eating_assisstance"  value="no"{{$sn->eating_assisstance=='no' ? ' checked' : ''}}> no
								  </label>
								</div>

                                @if ($errors->has('eating_assisstance'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('eating_assisstance') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('eating_details') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">If yes, type of assisstance required </label>

                            <div class="col-md-6">
                                <textarea name="eating_details" class="form-control" rows="3">{{$sn->eating_details}}</textarea>

                                @if ($errors->has('eating_details'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('eating_details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <h3>Communication</h3>
                        <div class="form-group{{ $errors->has('communication_assisstance') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Does your child need assisstance communicating? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="radio">
								  <label>
								    <input type="radio" name="communication_assisstance" value="yes" {{ $sn->communication_assisstance=='yes' ? ' checked': '' }}> yes
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="communication_assisstance"  value="no"{{ $sn->communication_assisstance=='no' ? ' checked': '' }}> no
								  </label>
								</div>

                                @if ($errors->has('communication_assisstance'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('communication_assisstance') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('communication_means') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">My Child Communicates <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="radio">
								  <label>
								    <input type="radio" name="communication_means" value="verbally"{{ $sn->communication_means=='verbally' ? ' checked' : ''}}> Verbally
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="communication_means"  value="gestures"{{ $sn->communication_means=='gestures' ? ' checked' : ''}}> With gestures
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="communication_means"  value="device"{{ $sn->communication_means=='device' ? ' checked' : ''}}> With an assistive device/book
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="communication_means"  value="pictures"{{ $sn->communication_means=='pictures' ? ' checked' : ''}}> With pictures
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

                        <div class="form-group{{ $errors->has('communicates_yes') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Child Communicates Yes by <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                 <input type="text" class="form-control" name="communicates_yes" value="{{ $sn->communicates_yes }}" required>

                                @if ($errors->has('communicates_yes'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('communicates_yes') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('communicates_no') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Child Communicates No by <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                 <input type="text" class="form-control" name="communicates_no" value="{{ $sn->communicates_no }}" required>

                                @if ($errors->has('communicates_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('communicates_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <h3>Behavior</h3>
                        <div class="form-group{{ $errors->has('overwhelm_noise') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Is your child overwhelmed by loud noise? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="overwhelm_noise" value="yes" {{$sn->overwhelm_noise=='yes' ? ' checked' : '' }}> yes
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="overwhelm_noise"  value="no"{{$sn->overwhelm_noise=='no' ? ' checked' : '' }}> no
                                  </label>
                                </div>

                                @if ($errors->has('overwhelm_noise'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('overwhelm_noise') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('overwhelm_people') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Is your child overwhelmed in a large group? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="overwhelm_people" value="yes" {{ $sn->overwhelm_people=='yes' ? ' checked' : '' }}> yes
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="overwhelm_people"  value="no"{{ $sn->overwhelm_people=='no' ? ' checked' : '' }}> no
                                  </label>
                                </div>

                                @if ($errors->has('overwhelm_people'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('overwhelm_people') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('leaves_group') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Does your child run away from a group activities? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="leaves_group" value="yes" {{ $sn->leaves_group=='yes' ? ' checked' : ''}}> yes
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="leaves_group"  value="no"{{ $sn->leaves_group=='no' ? ' checked' : ''}}> no
                                  </label>
                                </div>

                                @if ($errors->has('leaves_group'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('leaves_group') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('harm_others') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Would your child harm others? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="harm_others" value="yes"{{ $sn->harm_others=='yes' ? ' checked' : ''}}> yes
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="harm_others"  value="no"{{ $sn->harm_others=='no' ? ' checked' : ''}}> no
                                  </label>
                                </div>

                                @if ($errors->has('harm_others'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('harm_others') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('harm_self') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Would your child harm him/herself? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="harm_self" value="yes" {{ $sn->harm_self=='yes' ? ' checked' : ''}}> yes
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="harm_self"  value="no" {{ $sn->harm_self=='no' ? ' checked' : ''}}> no
                                  </label>
                                </div>

                                @if ($errors->has('harm_self'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('harm_self') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('successful_participation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Does your child successfully participate in a group? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="successful_participation" value="yes" {{ $sn->successful_participation=='yes' ? ' checked' : ''}}> yes
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="successful_participation"  value="no" {{ $sn->successful_participation=='no' ? ' checked' : ''}}> no
                                  </label>
                                </div>

                                @if ($errors->has('successful_participation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('successful_participation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('trigger') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Please briefly describe any triggers of your child's behavior and what we can do to help. <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <textarea name="trigger" class="form-control" rows="4">{{ $sn->trigger }}</textarea>

                                @if ($errors->has('trigger'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('trigger') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('major_change') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Have there been any recent and major changes in your child's life? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <textarea name="major_change" class="form-control" rows="4">{{ $sn->major_change }}</textarea>

                                @if ($errors->has('major_change'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('major_change') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('activities') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">What types of activities does your child like doing? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <textarea name="activities" class="form-control" rows="4">{{ $sn->activities }}</textarea>

                                @if ($errors->has('activities'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('activities') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>





                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary pull-right">
                                    Update Special Needs
                                </button>
                            </div>
                        </div>
                    </form>
				</div>
			</div>
			
		</div>

		<!--Pain Management-->
		<?php $pain=$child->painManagement; ?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<a  data-toggle="collapse" href="#pain-management-{{$child->id}}" aria-expanded="false" aria-controls="pain-management-{{$child->id}}">
						Sezuires and Pain
				</a>
				<small class="">(click to expand)</small>
			</div>
			<div class="panel-collapse collapse" id="pain-management-{{$child->id}}">
				<div class="panel-body" >
					<form class="form-horizontal updatePanel" role="form" method="POST" action="{{ URL::action('ChildPainManagementController@update',[$child->id,$pain->id])}}">
                        

                        <h3>Seizures</h3>
                        <div class="form-group{{ $errors->has('experiences_seizures') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Does your child encountered seizures previously? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                
								  <label>
								    <input type="radio" name="experiences_seizures" value="yes"{{ $pain->experiences_seizures=='yes' ? ' checked' : ''}}> yes
								  </label>
								
								
								  <label>
								    <input type="radio" name="experiences_seizures"  value="no" {{ $pain->experiences_seizures=='no' ? ' checked' : ''}}> no
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
                                <input type="date" class="form-control" name="last_seizure" value="{{ $pain->last_seizure }}"/>

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
                                <input type="text" class="form-control" name="seizure_frequency" value="{{ $pain->seizure_frequency }}"/>

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
                                <input type="text" class="form-control" name="seizure_trigger" value="{{ $pain->seizure_trigger }}"/>

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
                                <input type="text" class="form-control" name="seizure_medication" value="{{ $pain->sezure_medication }}"/>

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
                            <label class="col-md-4 control-label">How does your child indicate pain <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <textarea row="4" class="form-control" name="pain_indication" >{{ $pain->pain_indication }}</textarea>

                                @if ($errors->has('pain_indication'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pain_indication') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('pain_alleviation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">How can we alleviate your child's pain <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <textarea row="4" class="form-control" name="pain_alleviation" >{{ $pain->pain_alleviation }}</textarea>

                                @if ($errors->has('pain_alleviation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pain_alleviation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pain_requirements') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Possible child requirements <span class="text-danger">*</span></label>

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
                                    Update Pain & Seizures
                                </button>
                            </div>
                        </div>
                    </form>
				</div>
			</div><!--pain managementend-->
			

		</div>

		</div>
	
</div>