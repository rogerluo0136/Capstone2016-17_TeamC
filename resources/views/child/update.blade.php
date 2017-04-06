<div class="panel panel-default">
	<!--include name-->
	<div class="panel-heading text-center">
  		<h4 class="panel-title"> <b>{{ $child->first_name }} {{$child->last_name}}</b></h4>
	</div>
		<div class="panel-body">
		<!--GENERAL INFORMATION-->	
	    
	    @if( Auth::user()->type=='admin')

    		    <form class="form-inline updatePanel" action="{{URL::action('ChildProgramSeasonController@update',[$cps->child->id,$cps->programSeason->id])}}">
                  <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <label for="childStatus">Child Status ({{$cps->programSeason->program->name}} {{$cps->programSeason->season->season}} 
                    {{$cps->programSeason->season->year}}) </label> &nbsp;&nbsp;&nbsp;
                      <select name="status" class="form-control">
                        <option value="inquired" {{ $cps->status=='inquired' ? ' selected' : ''}}>inquired</option>
    	                <option value="invited" {{ $cps->status=='invited' ? ' selected' : ''}}>invited</option>
    	                <option value="enrolled" {{ $cps->status=='enrolled' ? ' selected' : ''}}>enrolled</option> 
                      </select>
                      @if ($errors->has('status'))
    	                  <span class="help-block">
    	                      <strong>{{ $errors->first('status') }}</strong>
    	                  </span>
    	              @endif
                  </div>
                  <button type="submit" class="btn btn-primary pull-right">Update Status</button>
                </form>
                <br>

	    @endif

    <!-- added side tab -->
        <div class="col-md-2">
          <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="#GI" data-toggle="pill">General Info</a></li>
            <li><a href="#EC" data-toggle="pill">Emergency Contact</a></li>
            <li><a href="#AM" data-toggle="pill">Allergies and Medication</a></li>
            <li><a href="#SN" data-toggle="pill">Special Needs</a></li>
            <li><a href="#SP" data-toggle="pill">Sezuires and Pain</a></li>
          </ul>
        </div>
    <!-- end of side tab -->

    <div class="col-md-10">
        <div class="tab-content">
		<div id="GI" class="panel panel-default tab-pane fade in active">
			<div class="panel-heading">
				<a  href="#general-info-{{$child->id}}" aria-expanded="false" aria-controls="general-info-{{$child->id}}">
						<i class="glyphicon glyphicon-menu-down"></i> General Info 
				</a>
			</div>
			<div class="panel" id="general-info-{{$child->id}}">
				<div class="panel-body" >
				    
                    <form class="form-horizontal updatePanel"  role="form" method="POST" action="{{ URL::action('UserChildController@update',[Auth::user()->id,$child->id])}}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="first_name" class="control-label col-md-6">First Name</label>
                                    <div class="col-md-6">
                                        <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $child->first_name }}" required>

                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="last_name" class="col-md-4 control-label">Last Name</label>
                                    <div class="col-md-6">
                                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $child->last_name }}" required>

                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label for="dob" class="col-md-3 control-label">Date of Birth</label>
                            <div class="col-md-3">
                                <input id="dob" type="date" class="form-control" name="dob" value="{{ $child->dob->toDateString() }}" min="1900-01-01" max="{{date("Y-m-d")}}"  required>

                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('health_card') ? ' has-error' : '' }}">
                            <label for="health_card" class="col-md-3 control-label">Health Card Number</label>
                            <div class="col-md-4">
                                <input id="health_card" type="text" class="form-control" name="health_card" maxlength="12" required placeholder="0000000000AA" value="{{ $child->health_card }}">

                                @if ($errors->has('health_card'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('health_card') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('family_physician') ? ' has-error' : '' }}">
                            <label for="family_physician" class="col-md-3 control-label">Family Physician Name</label>
                            <div class="col-md-4">
                                <input id="family_physician" type="text" class="form-control" name="family_physician" value="{{ $child->family_physician }}">

                                @if ($errors->has('family_physician'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('family_physician') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('fam_physician_phone') ? ' has-error' : '' }}">
                                    <label for="fam_physician_phone" class="col-md-3 control-label">Family Physician Phone Number</label>
                                    {{-- <div class="col-md-1">
                                        <input type="tel" name="fam_physician_phone1" class="form-control" size="3" maxlength="3" required placeholder="XXX" id="fam_physician_phone1">
                                    </div>
                                    
                                    <div class="col-md-1">
                                        <input type="tel" name="fam_physician_phone2" class="form-control" size="3" maxlength="3" required placeholder="XXX" id="fam_physician_phone2">
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <input type="tel" name="fam_physician_phone3" class="form-control" size="4" maxlength="4" required placeholder="XXXX" id="fam_physician_phone3">
                                    </div> --}}
                                    <div class="col-md-4">
                                        <input type="tel" name="fam_physician_phone" class="form-control" maxlength="10" value="{{ $child->fam_physician_phone }}"> 
                                    </div>
                                    {{-- <script type="text/javascript">
                                        $document.getElementById('fam_physician_phone').value = 1000;
                                    </script> --}}

                                    @if ($errors->has('fam_physician_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fam_physician_phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- hidden inputs -->
                        <input type="hidden" name="is_client" value="{{ $child->is_client }}">
                        <input type="hidden" name="is_first_time" value="{{ $child->is_first_time }}">
                        <input type="hidden" name="department" value="{{ $child->department }}">
                        <input type="hidden" name="previous_program" value="{{ $child->previous_program }}">

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary center-block">
                                Update Registrant General Information
                            </button>
                        </div>
                    </form>
           		</div>
			</div>
			
		</div>

		<!--EMERGENCY CONTACT INFO-->
		<?php $contact=$child->Contact;?>
        
        
		<div id="EC" class="panel panel-default tab-pane fade">
			<div class="panel-heading">
				<a   href="#emergency-contact-{{$child->id}}" aria-expanded="false" aria-controls="emergency-contact-{{$child->id}}">
						<i class="glyphicon glyphicon-menu-down"></i> Child Emergency Contact
				</a>
			</div>

			<div class="panel" id="emergency-contact-{{$child->id}}">
				<div class="panel-body" >
                    <form class="form-horizontal updatePanel"  role="form" method="POST" action="{{ URL::action('ChildContactController@update',[$child->id,$contact->id])}}">

                        <h4>Parent 1</h4>

                        <!-- Parent1 1st row -->
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="form-group{{ $errors->has('parent_1_name') ? ' has-error' : '' }}">
                                    <label for="parent_1_name" class="col-md-6 control-label">Name <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input id="parent_1_name" type="text" class="form-control" name="parent_1_name" required value="{{ $contact->parent_1_name }}">

                                        @if ($errors->has('parent_1_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_1_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-6"> 
                                <div class="form-group{{ $errors->has('parent_1_email') ? ' has-error' : '' }}">
                                    <label for="parent_1_email" class="col-md-3 control-label">Email Address <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input id="parent_1_email" type="email" class="form-control" name="parent_1_email" required value="{{ $contact->parent_1_email }}">

                                        @if ($errors->has('parent_1_email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_1_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <!-- Parent1 2nd row -->
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="form-group{{ $errors->has('parent_1_address') ? ' has-error' : '' }}">
                                    <label for="parent_1_address" class="col-md-6 control-label">Street Address <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input id="parent_1_address" type="text" class="form-control" name="parent_1_address" required value="{{ $contact->parent_1_address }}">

                                        @if ($errors->has('parent_1_address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_1_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-6"> 
                                <div class="form-group{{ $errors->has('parent_1_city') ? ' has-error' : '' }}">
                                    <label for="parent_1_city" class="col-md-3 control-label">City <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input id="parent_1_city" type="text" class="form-control" name="parent_1_city" required value="{{ $contact->parent_1_city }}">

                                        @if ($errors->has('parent_1_city'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_1_city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <div class="row">

                            <div class="col-md-6"> 
                                <div class="form-group{{ $errors->has('parent_1_province') ? ' has-error' : '' }}">
                                    <label for="parent_1_province" class="col-md-6 control-label">Province <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input id="parent_1_province" type="text" class="form-control" name="parent_1_province" required value="{{ $contact->parent_1_province }}">

                                        @if ($errors->has('parent_1_province'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_1_province') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-6"> 
                                <div class="form-group{{ $errors->has('parent_1_postal') ? ' has-error' : '' }}">
                                    <label for="parent_1_postal" class="col-md-3 control-label">Postal Code <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input id="parent_1_postal" type="text" class="form-control" name="parent_1_postal" required value="{{ $contact->parent_1_postal }}">

                                        @if ($errors->has('parent_1_postal'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_1_postal') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <!-- Parent1 3rd row -->
                        <div class="row">
                            <div class="col-md-4"> 
                                <div class="form-group{{ $errors->has('parent_1_home_tel') ? ' has-error' : '' }}">
                                    <label for="parent_1_home_tel" class="col-md-5 control-label">Home Ph. #</label>
                                    <div class="col-md-7">
                                        <input id="parent_1_home_tel" type="tel" class="form-control" name="parent_1_home_tel" maxlength="10" value="{{ !is_null($contact->parent_1_home_tel) ? $contact->parent_1_home_tel : '' }}">

                                        @if ($errors->has('parent_1_home_tel'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_1_home_tel') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-4"> 
                                <div class="form-group{{ $errors->has('parent_1_work_tel') ? ' has-error' : '' }}">
                                    <label for="parent_1_work_tel" class="col-md-5 control-label">Work Ph. #</label>
                                    <div class="col-md-7">
                                        <input id="parent_1_work_tel" type="tel" class="form-control" name="parent_1_work_tel" maxlength="10" value="{{ !is_null($contact->parent_1_work_tel) ? $contact->parent_1_work_tel : '' }}">

                                        @if ($errors->has('parent_1_work_tel'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_1_work_tel') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-4"> 
                                <div class="form-group{{ $errors->has('parent_1_cell_phone') ? ' has-error' : '' }}">
                                    <label for="parent_1_cell_phone" class="col-md-5 control-label">Cell Ph. # <span class="text-danger">*</span></label>
                                    <div class="col-md-7">
                                        <input id="parent_1_cell_phone" type="tel" class="form-control" name="parent_1_cell_phone" required maxlength="10" value="{{ $contact->parent_1_cell_phone }}">

                                        @if ($errors->has('parent_1_cell_phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_1_cell_phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <hr>

                        <h4>Parent 2</h4>

                        <!-- Parent2 1st row -->
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="form-group{{ $errors->has('parent_2_name') ? ' has-error' : '' }}">
                                    <label for="parent_2_name" class="col-md-6 control-label">Name</label>
                                    <div class="col-md-6">
                                        <input id="parent_2_name" type="text" class="form-control" name="parent_2_name" value="{{ !is_null($contact->parent_2_name) ? $contact->parent_2_name : ''  }}">

                                        @if ($errors->has('parent_2_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_2_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-6"> 
                                <div class="form-group{{ $errors->has('parent_2_email') ? ' has-error' : '' }}">
                                    <label for="parent_2_email" class="col-md-3 control-label">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input id="parent_2_email" type="email" class="form-control" name="parent_2_email" value="{{!is_null($contact->parent_2_email) ? $contact->parent_2_email : ''}}">

                                        @if ($errors->has('parent_2_email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_2_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <!-- Parent2 2nd row -->
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="form-group{{ $errors->has('parent_2_address') ? ' has-error' : '' }}">
                                    <label for="parent_2_address" class="col-md-6 control-label">Street Address</label>
                                    <div class="col-md-6">
                                        <input id="parent_2_address" type="text" class="form-control" name="parent_2_address" value="{{ !is_null($contact->parent_2_address) ? $contact->parent_2_address : '' }}">

                                        @if ($errors->has('parent_2_address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_2_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-6"> 
                                <div class="form-group{{ $errors->has('parent_2_city') ? ' has-error' : '' }}">
                                    <label for="parent_2_city" class="col-md-3 control-label">City</label>
                                    <div class="col-md-6">
                                        <input id="parent_2_city" type="text" class="form-control" name="parent_2_city" value="{{ !is_null($contact->parent_2_city) ? $contact->parent_2_city : '' }}">

                                        @if ($errors->has('parent_2_city'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_2_city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>     

                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="form-group{{ $errors->has('parent_2_province') ? ' has-error' : '' }}">
                                    <label for="parent_2_province" class="col-md-6 control-label">Province</label>
                                    <div class="col-md-6">
                                        <input id="parent_2_province" type="text" class="form-control" name="parent_2_province" value="{{!is_null($contact->parent_2_province) ? $contact->parent_2_province : ''}}">

                                        @if ($errors->has('parent_2_province'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_2_province') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-6"> 
                                <div class="form-group{{ $errors->has('parent_2_postal') ? ' has-error' : '' }}">
                                    <label for="parent_2_postal" class="col-md-3 control-label">Postal Code</label>
                                    <div class="col-md-6">
                                        <input id="parent_2_postal" type="text" class="form-control" name="parent_2_postal" value="{{!is_null($contact->parent_2_postal) ? $contact->parent_2_postal : ''}}">

                                        @if ($errors->has('parent_2_postal'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_2_postal') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <!-- Parent2 3rd row -->
                        <div class="row">
                            <div class="col-md-4"> 
                                <div class="form-group{{ $errors->has('parent_2_home_tel') ? ' has-error' : '' }}">
                                    <label for="parent_2_home_tel" class="col-md-5 control-label">Home Ph. #</label>
                                    <div class="col-md-7">
                                        <input id="parent_2_home_tel" type="tel" class="form-control" name="parent_2_home_tel" value="{{ !is_null($contact->parent_2_home_tel) ? $contact->parent_2_home_tel : '' }}">

                                        @if ($errors->has('parent_2_home_tel'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_2_home_tel') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-4"> 
                                <div class="form-group{{ $errors->has('parent_2_work_tel') ? ' has-error' : '' }}">
                                    <label for="parent_2_work_tel" class="col-md-5 control-label">Work Ph. #</label>
                                    <div class="col-md-7">
                                        <input id="parent_2_work_tel" type="tel" class="form-control" name="parent_2_work_tel" value="{{ !is_null($contact->parent_2_work_tel) ? $contact->parent_2_work_tel : '' }}">

                                        @if ($errors->has('parent_2_work_tel'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_2_work_tel') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 

                            <div class="col-md-4"> 
                                <div class="form-group{{ $errors->has('parent_2_cell_phone') ? ' has-error' : '' }}">
                                    <label for="parent_2_cell_phone" class="col-md-5 control-label">Cell Ph. #</label>
                                    <div class="col-md-7">
                                        <input id="parent_2_cell_phone" type="tel" class="form-control" name="parent_2_cell_phone" value="{{ !is_null($contact->parent_2_cell_phone) ? $contact->parent_2_cell_phone : '' }}">

                                        @if ($errors->has('parent_2_cell_phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_2_cell_phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <hr>

                        <div class="form-group{{ $errors->has('lives_with') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Child lives with: <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select name="lives_with" class="form-control">
                                  <option value="both parents" {{ $contact->lives_with=="both parents" ? 'selected' : '' }}>both parents</option>
                                  <option value="parent1"{{ $contact->lives_with=="parent1" ? 'selected' : '' }}>parent 1</option>
                                  <option value="parent2"{{ $contact->lives_with=="parent2" ? 'selected' : '' }}>parent 2</option>
                                  <option value="guardian"{{ $contact->lives_with=="guardian" ? 'selected' : '' }}>guardian</option>
                                  <option value="independent"{{ $contact->lives_with=="independent" ? 'selected' : '' }}>independent</option>
                                  <option value="other"{{ $contact->lives_with=="other" ? 'selected' : '' }}>other</option>
                                </select>
                               
                                @if ($errors->has('lives_with'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lives_with') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Language spoken at home: <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="language" type="text" class="form-control" name="language" required value="{{ $contact->language }}">

                                @if ($errors->has('language'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('language') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('emerg_contact') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Emgergency Contact: <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="emerg_contact" type="text" class="form-control" name="emerg_contact" required value="{{ $contact->emerg_contact}}">

                                @if ($errors->has('emerg_contact'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('emerg_contact') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('emerg_contact_phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Emgergency Contact Phone #: <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="emerg_contact_phone" type="tel" class="form-control" name="emerg_contact_phone" required value="{{ $contact->emerg_contact_phone}}" maxlength="10">

                                @if ($errors->has('emerg_contact_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('emerg_contact_phone') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary center-block">
                                Update Contact Information
                            </button>
                        </div>
                    </form>
           		</div>
			</div>
			
		</div>


		<!--CHILD ALLERGY-->
		<?php $allergy=$child->allergy;?>

		<div id="AM" class="panel panel-default tab-pane fade">
			<div class="panel-heading">
				<a   href="#allergy-medication-{{$child->id}}" aria-expanded="false" aria-controls="allergy-medication-{{$child->id}}">
						<i class="glyphicon glyphicon-menu-down"></i> Child Allergies & Medication
				</a>
			</div>
			<div class="panel" id="allergy-medication-{{$child->id}}">
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
                                <h5>If Yes, please describe the types and symptoms of allergies:</h5>
                                <div class="form-group{{ $errors->has('allergy_type_symptom') ? ' has-error' : '' }}">
                                    <textarea class="form-control" rows="3" name="allergy_type_symptom" >{{ !is_null($allergy->allergy_type_symptom) ? $allergy->allergy_type_symptom : '' }}</textarea>

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
                                    <textarea class="form-control" rows="3" name="allergy_explaination" >{{ !is_null($allergy->allergy_explaination) ? $allergy->allergy_explaination : '' }}</textarea>
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
                                <textarea class="form-control" rows="3" name="medication_explaination">{{ !is_null($allergy->medication_explaination) ? $allergy->medication_explaination : '' }}</textarea>
                                @if ($errors->has('medication_explaination'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('medication_explaination') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary center-block">
                                Update Allergy Information
                            </button>
                        </div>
                    </form>
				</div>
			</div>
			
		</div>

		<!--Special Needs-->
		<?php $sn=$child->specialNeed;?>
		<div id="SN" class="panel panel-default tab-pane fade">
			<div class="panel-heading">
				<a  href="#special-needs-{{$child->id}}" aria-expanded="false" aria-controls="special-needs-{{$child->id}}">
						<i class="glyphicon glyphicon-menu-down"></i> Special Needs
				</a>
			</div>

			<div class="panel" id="special-needs-{{$child->id}}">
				<div class="panel-body" >
					<form class="form-horizontal updatePanel" role="form" method="POST" action="{{ URL::action('ChildSpecialNeedController@update',[$child->id,$sn->id])}}">


                        <div class="row">
                            <div class="col-md-4">
                                <h5>Does your child have any special needs? <span class="text-danger">*</span></h5>
                            </div>
                            <div class="col-md-2">                                
                                <div class="form-group{{ $errors->has('has_specialneeds') ? ' has-error' : '' }}">
                                    <div class="radio col-md-6">
                                        <input type="radio" name="has_specialneeds" id="has_specialneeds" value="no" {{ $sn->has_specialneeds=="no" ? ' checked' : "" }}>
                                        No
                                    </div>
                                    <div class="radio col-md-6">
                                        <input type="radio" name="has_specialneeds" id="has_specialneeds" value="yes"{{ $sn->has_specialneeds=="yes" ? ' checked' : "" }}>
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
                                        <input id="diagnosis" type="text" class="form-control" name="diagnosis" value="{{ !is_null($sn->diagnosis) ? $sn->diagnosis : '' }}">
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
                                <div id="Mobility" class="panel-collapse collapse in">
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-md-8">
                                                <h5>Is your child risk at falling? <span class="text-danger">*</span></h5>
                                                <h6>(e.g. your child has fallen in the last three (3) months as a result of diagnosis - poor balance, dizziness, etc.)</h6>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group{{ $errors->has('risk_of_falling') ? ' has-error' : '' }}">

                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="risk_of_falling" id="risk_of_falling" value="no" {{ $sn->risk_of_falling=="no" ? ' checked' : "" }}>
                                                        No
                                                    </div>
                                                
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="risk_of_falling" id="risk_of_falling" value="yes"{{ $sn->risk_of_falling=="yes" ? ' checked' : "" }}>
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
                                                    <option value="None" {{ $sn->mobility_support=="None" ? 'selected' : '' }}>None</option>
                                                  <option value="Requires support when walking"{{ $sn->mobility_support=="Requires support when walking" ? 'selected' : '' }}>Requires support when walking</option>
                                                  <option value="Uses a walker"{{ $sn->mobility_support=="Uses a walker" ? 'selected' : '' }}>Uses a walker</option>
                                                  <option value="Uses a manual wheelchair"{{ $sn->mobility_support=="Uses a manual wheelchair" ? 'selected' : '' }}>Uses a manual wheelchair</option>
                                                  <option value="Uses an electric wheelchair"{{ $sn->mobility_support=="Uses an electric wheelchair" ? 'selected' : '' }}>Uses a electric wheelchair</option>
                                                  <option value="Requires an assistive device for lifts and transfers (e.g Hoyer lift, sling, etc)"{{ $sn->mobility_support=="Requires an assistive device for lifts and transfers (e.g Hoyer lift, sling, etc)" ? 'selected' : '' }}>Requires an assistive device for lifts and transfers (e.g Hoyer lift, sling, etc)</option>
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
                                                  <option value="no"{{ $sn->need_splints_orthotics=="no" ? 'selected' : '' }}>No</option>
                                                  <option value="yes"{{ $sn->need_splints_orthotics=="yes" ? 'selected' : '' }}>Yes</option>
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
                                                <input id="orthotics_when" type="text" class="form-control" name="orthotics_when" value="{{ !is_null($sn->orthotics_when) ? $sn->orthotics_when : '' }}">
                                  
                                               
                                                @if ($errors->has('orthotics_when'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('orthotics_when') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('need_hand_over_hand') ? ' has-error' : '' }}">
                                            <label class="col-md-5 control-label">Does your chid need hand-over-hand assistance? <span class="text-danger">*</span></label>
                                            <div class="col-md-6">
                                                <select name="need_hand_over_hand" class="form-control">
                                                  <option value="no" {{ $sn->need_hand_over_hand=="no" ? 'selected' : '' }}>No</option>
                                                  <option value="yes"{{ $sn->need_hand_over_hand=="yes" ? 'selected' : '' }}>Yes</option>
                                                </select>
                                               
                                                @if ($errors->has('need_hand_over_hand'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('need_hand_over_hand') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <hr>
                                        <a class="btn btn-primary pull-right" data-toggle="collapse" data-parent="#accordion" href="#Toileting">
                                        Save and Go to Next Section <i class="glyphicon glyphicon-arrow-right"></i>
                                        </a>

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
                                <div id="Toileting" class="panel-collapse collapse">
                                      <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                    <h5>Child's weight: <span class="text-danger">*</span></h5>
                                            </div>
                                            <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                                                <div class="input-group col-md-2">
                                                    <input id="weight" type="text" class="form-control" name="weight" required value="{{$sn->weight}}"><span class="input-group-addon">kg</span>


                                                    @if ($errors->has('weight'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('weight') }}</strong>
                                                        </span>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-5">
                                                <h5>Does your child need assistance when toileting? <span class="text-danger">*</span></h5>
                                            </div>
                                            <div class="col-md-2">                                
                                                <div class="form-group{{ $errors->has('need_toiletting_assisstance') ? ' has-error' : '' }}">
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="need_toiletting_assisstance" id="need_toiletting_assisstance" value="no" {{ $sn->need_toiletting_assisstance=="no" ? 'checked' : '' }}>
                                                        No
                                                    </div>
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="need_toiletting_assisstance" id="need_toiletting_assisstance" value="yes" {{ $sn->need_toiletting_assisstance=="yes" ? 'checked' : '' }}>
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
                                                    <textarea class="form-control" rows="3" name="toiletting_details" >{{ !is_null($sn->toiletting_details ) ? $sn->toiletting_details : ''  }}</textarea>

                                                    @if ($errors->has('toiletting_details'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('toiletting_details') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <a class="btn btn-primary pull-right" data-toggle="collapse" data-parent="#accordion" href="#Eating">
                                        Save and Go to Next Section <i class="glyphicon glyphicon-arrow-right"></i>
                                        </a>

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
                                <div id="Eating" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5>Does your child need assistance eating? <span class="text-danger">*</span></h5>
                                            </div>
                                            <div class="col-md-2">                                
                                                <div class="form-group{{ $errors->has('need_eating_assisstance') ? ' has-error' : '' }}">
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="need_eating_assisstance" id="need_eating_assisstance" value="no" {{$sn->need_eating_assisstance=="no" ? 'checked' : ''}}>
                                                        No
                                                    </div>
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="need_eating_assisstance" id="need_eating_assisstance" value="yes" {{$sn->need_eating_assisstance=="yes" ? 'checked' : ''}}>
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
                                                    <textarea class="form-control" rows="3" name="eating_details" >{{ !is_null($sn->eating_details ) ? $sn->eating_details : ''  }}</textarea>

                                                    @if ($errors->has('eating_details'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('eating_details') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <a class="btn btn-primary pull-right" data-toggle="collapse" data-parent="#accordion" href="#Communication">
                                        Save and Go to Next Section <i class="glyphicon glyphicon-arrow-right"></i>
                                        </a>

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
                                <div id="Communication" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <h5>Does your child need assistance communicating? <span class="text-danger">*</span></h5>
                                            </div>
                                            <div class="col-md-2">                                
                                                <div class="form-group{{ $errors->has('need_communication_assisstance') ? ' has-error' : '' }}">
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="need_communication_assisstance" id="need_communication_assisstance" value="no" {{$sn->need_communication_assisstance=="no" ? 'checked' : ''}}>
                                                        No
                                                    </div>
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="need_communication_assisstance" id="need_communication_assisstance" value="yes"{{$sn->need_communication_assisstance=="yes" ? 'checked' : ''}}>
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
                                            <div class="col-md-6">
                                                 <div class="form-group{{ $errors->has('communication_means') ? ' has-error' : '' }}">

                                                    <div class="col-md-4">
                                                        <div class="checkbox">
                                                          <label>
                                                            <input type="checkbox" name="communication_means[]" value="verbally" <?php if(str_contains($sn->communication_means,'verbally')) echo "checked='checked'" ?> > Verbally
                                                          </label>
                                                        </div>
                                                        <div class="checkbox">
                                                          <label>
                                                            <input type="checkbox" name="communication_means[]"  value="gestures" <?php if(str_contains($sn->communication_means,'gestures')) echo "checked='checked'" ?> > With gestures
                                                          </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="checkbox">
                                                          <label>
                                                            <input type="checkbox" name="communication_means[]"  value="device" <?php if(str_contains($sn->communication_means,'device')) echo "checked='checked'" ?> > With an assistive device/book
                                                          </label>
                                                        </div>
                                                        <div class="checkbox">
                                                          <label>
                                                            <input type="checkbox" name="communication_means[]"  value="pictures" <?php if(str_contains($sn->communication_means,'pictures')) echo "checked='checked'" ?> > With pictures
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
                                                    
                                                     <input type="text" class="form-control" name="communicates_yes" value="{{ !is_null($sn->communicates_yes) ? $sn->communicates_yes : ''  }}">

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
                                                    
                                                     <input type="text" class="form-control" name="communicates_no" value="{{ !is_null($sn->communicates_no) ? $sn->communicates_no : ''  }}">

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
                                        <a class="btn btn-primary pull-right" data-toggle="collapse" data-parent="#accordion" href="#Behavior">
                                        Save and Go to Next Section <i class="glyphicon glyphicon-arrow-right"></i>
                                        </a>
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
                                <div id="Behavior" class="panel-collapse collapse">
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
                                                            <input type="radio" name="overwhelm_noise" value="no" {{$sn->overwhelm_noise=="no" ? 'checked' : ''}} >
                                                            No
                                                        </div>
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="overwhelm_noise" value="yes" {{$sn->overwhelm_noise=="yes" ? 'checked' : ''}} >
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
                                                            <input type="radio" name="harm_others" value="no" {{$sn->harm_others=="no" ? 'checked' : ''}}>
                                                            No
                                                        </div>
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="harm_others" value="yes"{{$sn->harm_others=="yes" ? 'checked' : ''}}>
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
                                                            <input type="radio" name="overwhelm_people" value="no" {{$sn->overwhelm_people=="no" ? 'checked' : ''}}>
                                                            No
                                                        </div>
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="overwhelm_people" value="yes"{{$sn->overwhelm_people=="yes" ? 'checked' : ''}}>
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
                                                            <input type="radio" name="harm_self" value="no" {{$sn->harm_self=="no" ? 'checked' : ''}}>
                                                            No
                                                        </div>
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="harm_self" value="yes"{{$sn->harm_self=="yes" ? 'checked' : ''}}>
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
                                                            <input type="radio" name="leaves_group" value="no" {{$sn->leaves_group=="no" ? 'checked' : ''}}>
                                                            No
                                                        </div>
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="leaves_group" value="yes"{{$sn->leaves_group=="yes" ? 'checked' : ''}}>
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
                                                            <input type="radio" name="successful_participation" value="no"{{$sn->successful_participation=="no" ? 'checked' : ''}}>
                                                            No
                                                        </div>
                                                        <div class="radio col-md-6">
                                                            <input type="radio" name="successful_participation" value="yes" {{$sn->successful_participation=="yes" ? 'checked' : ''}}>
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
                                                    <textarea class="form-control" rows="4" name="trigger">{{ !is_null($sn->trigger ) ? $sn->trigger : ''  }}</textarea>

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
                                                    <textarea class="form-control" rows="4" name="major_change" >{{ !is_null($sn->major_change ) ? $sn->major_change : ''  }}</textarea>

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
                                                    <textarea class="form-control" rows="4" name="activities">{{ !is_null($sn->activities) ? $sn->activities : ''  }}</textarea>

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
                        </div>
                        

                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary center-block">
                                Update Special Needs Information
                            </button>
                        </div>
                    </form> 
                    
				</div>
			</div>
			
		</div>

		<!--Pain Management-->
		<?php $pain=$child->painManagement; ?>

		<div id="SP" class="panel panel-default tab-pane fade">
			<div class="panel-heading">
				<a   href="#pain-management-{{$child->id}}" aria-expanded="false" aria-controls="pain-management-{{$child->id}}">
						<i class="glyphicon glyphicon-menu-down"></i> Sezuires and Pain
				</a>
			</div>
			<div class="panel" id="pain-management-{{$child->id}}">
				<div class="panel-body" >
					<form class="form-horizontal updatePanel" role="form" method="POST" action="{{ URL::action('ChildPainManagementController@update',[$child->id,$pain->id])}}">


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
                                <div id="Seizures" class="panel-collapse collapse in">
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Will your child have seizure medication with them in the program? <span class="text-danger">*</span></h5>
                                            </div>
                                            <div class="col-md-2">                                
                                                <div class="form-group{{ $errors->has('seizure_medication') ? ' has-error' : '' }}">
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="seizure_medication"  value="no" {{ $pain->seizure_medication=="no" ? ' checked' : "" }}>
                                                        No
                                                    </div>
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="seizure_medication" value="yes"{{ $pain->seizure_medication=="yes" ? ' checked' : "" }}>
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
                                            <div class="col-md-5">
                                                <h5>Has your child encountered seizures previously? <span class="text-danger">*</span></h5>
                                            </div>
                                            <div class="col-md-2">                                
                                                <div class="form-group{{ $errors->has('experiences_seizures') ? ' has-error' : '' }}">
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="experiences_seizures"  value="no" {{ $pain->experiences_seizures=="no" ? ' checked' : "" }}>
                                                        No
                                                    </div>
                                                    <div class="radio col-md-6">
                                                        <input type="radio" name="experiences_seizures" value="yes"{{ $pain->experiences_seizures=="yes" ? ' checked' : "" }}>
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
                                                        <input type="date" class="form-control" name="last_seizure" min="1900-01-01" max="{{date("Y-m-d")}}" value="{{ !is_null($pain->last_seizure) ? $pain->last_seizure : '' }}"/>

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
                                                        <textarea class="form-control" rows="3" name="seizure_details" >{{ !is_null($pain->seizure_details) ? $pain->seizure_details : ''  }}</textarea>

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
                                        <a class="btn btn-primary pull-right" data-toggle="collapse" data-parent="#accordion" href="#Pain">
                                        Save and Go to Next Section <i class="glyphicon glyphicon-arrow-right"></i>
                                        </a>

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
                                <div id="Pain" class="panel-collapse collapse">
                                      <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <h5>How does your child indicate pain? <span class="text-danger">*</span></h5>
                                                <div class="form-group{{ $errors->has('pain_indication') ? ' has-error' : '' }} col-md-12">
                                                    <textarea class="form-control" rows="4" name="pain_indication" >{{ !is_null($pain->pain_indication ) ? $pain->pain_indication : ''  }}</textarea>

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
                                                    <textarea class="form-control" rows="4" name="pain_alleviation" > {{ !is_null($pain->pain_alleviation ) ? $pain->pain_alleviation : ''  }}</textarea>

                                                    @if ($errors->has('pain_alleviation'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('pain_alleviation') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <a class="btn btn-primary pull-right" data-toggle="collapse" data-parent="#accordion" href="#OtherInformation">
                                        Save and Go to Next Section <i class="glyphicon glyphicon-arrow-right"></i>
                                        </a>

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
                                <div id="OtherInformation" class="panel-collapse collapse">
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
                                                <input type="checkbox" name="pain_requirements" value="none" <?php if(str_contains($pain->pain_requirements,'none')) echo "checked='checked'" ?> > None
                                              </label>
                                            </div>
                                            <div class="checkbox">
                                              <label>
                                                <input type="checkbox" name="pain_requirements[]" value="suctioning-tip" <?php if(str_contains($pain->pain_requirements,'suctioning-tip')) echo "checked='checked'" ?> > Suctioning (Tip)
                                              </label>
                                            </div>
                                            <div class="checkbox">
                                              <label>
                                                <input type="checkbox" name="pain_requirements[]"  value="suctioning-deep" <?php if(str_contains($pain->pain_requirements,'uctioning-deep')) echo "checked='checked'" ?> > Suctioning (Deep)
                                              </label>
                                            </div>
                                            <div class="checkbox">
                                              <label>
                                                <input type="checkbox" name="pain_requirements[]"  value="physical-restraints" <?php if(str_contains($pain->pain_requirements,'physical-restraints')) echo "checked='checked'" ?> > Physical restraints e.g.: elbow splints, mitts
                                              </label>
                                            </div>
                                            <div class="checkbox">
                                              <label>
                                                <input type="checkbox" name="pain_requirements[]"  value="helmet" <?php if(str_contains($pain->pain_requirements,'helmet')) echo "checked='checked'" ?> > Helmet
                                              </label>
                                            </div>
                                            <div class="checkbox-inline">
                                              
                                                <input type="checkbox" name="pain_requirements[]"  value="other" <?php if(str_contains($pain->pain_requirements,'other')) echo "checked='checked'" ?> > Other, please describe: 
                                              
                                                <div class="form-group{{ $errors->has('requirement_other_details') ? ' has-error' : '' }}">
                                                    <input class="form-control" type="text" name="requirement_other_details" value="{{!is_null($pain->requirement_other_details) ? $pain->requirement_other_details : '' }}">
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

                        

                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary center-block">
                                Update Sezuires and Pain Management Information
                            </button>
                        </div>
                        </form> 
				</div>
            </div>
		</div><!--pain managementend-->
			

		</div>

		</div>
	
</div>