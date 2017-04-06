@extends('layouts.form')

@section('js')
<script src="{{ asset('/js/update.js') }}"></script>
@endsection

@section('content')
<?php $contact=$child->contact;?>
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
					Contact Information: {{$child->first_name}} {{$child->last_name}}
				</div>

				<div class="panel-body">
						    
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

	                
               		<hr>

               		<a  class=" pull-left" href="{{ url('/home') }}" style="">
                        <i class="glyphicon glyphicon-chevron-left"></i> Back to Main Page
                    </a>

                    <a  class=" pull-right" href="{{ url('/user/'.$user->id.'/child/'.$child->id.'/allergyedit') }}" style="">
                        View and Edit Allergy Information <i class="glyphicon glyphicon-chevron-right"></i>
                    </a>

           		</div><!--panel body-->
			</div><!--panel-->
		</div><!--col-->
	</div><!--row-->
</div><!--container-->
@endsection


