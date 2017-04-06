<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					Registrant Information: {{$child->first_name}} {{$child->last_name}}
				</div>

				<div class="panel-body">
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
                                <input id="dob" type="date" class="form-control" name="dob" value="{{ $child->dob->toDateString() }}" required>

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
               		<hr>

               		<a  class=" pull-left" href="{{ url('/home') }}" style="">
                        <i class="glyphicon glyphicon-chevron-left"></i> Back to Main Page
                    </a>

                    <a  class=" pull-right" href="{{ url('/user/'.$user->id.'/child/'.$child->id.'/contactedit') }}" style="">
                        View and Edit Contact Information <i class="glyphicon glyphicon-chevron-right"></i>
                    </a>

           		</div><!--panel body-->
			</div><!--panel-->
		</div>