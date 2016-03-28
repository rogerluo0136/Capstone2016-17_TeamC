@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			
			<h1 class="text-center">Registrant Information</h1>
			<h3 class="text-center">Special Needs</h3>
			
			<!--mobility panel-->
			<div class="panel panel-default">
				<div class="panel-heading">Mobility</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ URL::action('ChildSpecialNeedController@store',[$child->id])}}">
                        {!! csrf_field() !!}

                        <h3>Mobility</h3>
                        <div class="form-group{{ $errors->has('risk_of_falling') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Is Your Child at risk of Falling? <span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <div class="radio">
								  <label>
								    <input type="radio" name="risk_of_falling" value="yes"> yes
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="risk_of_falling"  value="no"> no
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
								    <input type="radio" name="mobility_support" value="Does not require support when walking">
								    Does not require support when walking
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="mobility_support"  value="Requires support when walking">
								    Requires support when walking
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="mobility_support"  value="Uses a walker">
								    Uses a Walker
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="mobility_support"  value="Uses a wheelchair">
								    Uses a wheelchair
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="mobility_support"  value="Uses an electric wheelchair">
								    Uses an electric wheelchair
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="mobility_support"  value="Requires an assistive device for lifts and transfers (e.g. Hoyer lift, sling, etc.)">
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
								    <input type="radio" name="requires_orthotics" value="yes"> yes
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="requires_orthotics"  value="no"> no
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
                                <textarea name="orthotics_when" class="form-control" rows="3"></textarea>

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
								    <input type="radio" name="hand_over_hand_assisstance" value="yes"> yes
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="hand_over_hand_assisstance"  value="no"> no
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
								    <input type="radio" name="toiletting_assisstance" value="yes"> yes
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="toiletting_assisstance"  value="no"> no
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
                                <textarea name="toiletting_details" class="form-control" rows="3"></textarea>

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
                                 <input type="number" class="form-control" name="weight" value="{{ old('weight') }}" required>

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
								    <input type="radio" name="eating_assisstance" value="yes"> yes
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="eating_assisstance"  value="no"> no
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
                                <textarea name="eating_details" class="form-control" rows="3"></textarea>

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
								    <input type="radio" name="communication_assisstance" value="yes"> yes
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="communication_assisstance"  value="no"> no
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
								    <input type="radio" name="communication_means" value="verbally"> Verbally
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="communication_means"  value="gestures"> With gestures
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="communication_means"  value="device"> With an assistive device/book
								  </label>
								</div>
								<div class="radio">
								  <label>
								    <input type="radio" name="communication_means"  value="pictures"> With pictures
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
                                 <input type="text" class="form-control" name="communicates_yes" value="{{ old('communicates_yes') }}" required>

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
                                 <input type="text" class="form-control" name="communicates_no" value="{{ old('communicates_no') }}" required>

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
                                    <input type="radio" name="overwhelm_noise" value="yes"> yes
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="overwhelm_noise"  value="no"> no
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
                                    <input type="radio" name="overwhelm_people" value="yes"> yes
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="overwhelm_people"  value="no"> no
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
                                    <input type="radio" name="leaves_group" value="yes"> yes
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="leaves_group"  value="no"> no
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
                                    <input type="radio" name="harm_others" value="yes"> yes
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="harm_others"  value="no"> no
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
                                    <input type="radio" name="harm_self" value="yes"> yes
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="harm_self"  value="no"> no
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
                                    <input type="radio" name="successful_participation" value="yes"> yes
                                  </label>
                                </div>
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="successful_participation"  value="no"> no
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
                                <textarea name="trigger" class="form-control" rows="4"></textarea>

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
                                <textarea name="major_change" class="form-control" rows="4"></textarea>

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
                                <textarea name="activities" class="form-control" rows="4"></textarea>

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
                                    Add Special Needs
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