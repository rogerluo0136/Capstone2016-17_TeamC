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
				<div class="panel-heading">Contact Information</div>
				<div class="panel-body">
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ URL::action('ChildContactController@store',[$child->id])}}">
                        {!! csrf_field() !!}

                        <h4>Parent 1</h4>

                        <!-- Parent1 1st row -->
                        <div class="row">
                            <div class="col-md-6"> 
                                <div class="form-group{{ $errors->has('parent_1_name') ? ' has-error' : '' }}">
                                    <label for="parent_1_name" class="col-md-6 control-label">Full Name <span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input id="parent_1_name" type="text" class="form-control" name="parent_1_name" required value="{{session('contact.parent_1_name')}}">

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
                                        <input id="parent_1_email" type="email" class="form-control" name="parent_1_email" required value="{{session('contact.parent_1_email')}}">

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
                                        <input id="parent_1_address" type="text" class="form-control" name="parent_1_address" required value="{{session('contact.parent_1_address')}}">

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
                                        <input id="parent_1_city" type="text" class="form-control" name="parent_1_city" required value="{{session('contact.parent_1_city')}}">

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
                                        <select name="parent_1_province" class="form-control" >
                                          <option value="" {{ session('contact.parent_1_province')=="" ? 'selected='.'"'.'selected'.'"' : '' }}></option>  
                                          <option value="ON" {{ session('contact.parent_1_province')=="ON" ? 'selected='.'"'.'selected'.'"' : '' }}>ON</option>
                                          <option value="QC" {{ session('contact.parent_1_province')=="QC" ? 'selected='.'"'.'selected'.'"' : '' }}>QC</option>
                                          <option value="NS" {{ session('contact.parent_1_province')=="NS" ? 'selected='.'"'.'selected'.'"' : '' }}>NS</option>
                                          <option value="NB" {{ session('contact.parent_1_province')=="NB" ? 'selected='.'"'.'selected'.'"' : '' }}>NB</option>
                                          <option value="MB" {{ session('contact.parent_1_province')=="MB" ? 'selected='.'"'.'selected'.'"' : '' }}>MB</option>
                                          <option value="BC" {{ session('contact.parent_1_province')=="BC" ? 'selected='.'"'.'selected'.'"' : '' }}>BC</option>
                                          <option value="PE" {{ session('contact.parent_1_province')=="PE" ? 'selected='.'"'.'selected'.'"' : '' }}>PE</option>
                                          <option value="SK" {{ session('contact.parent_1_province')=="SK" ? 'selected='.'"'.'selected'.'"' : '' }}>SK</option>
                                          <option value="AB" {{ session('contact.parent_1_province')=="AB" ? 'selected='.'"'.'selected'.'"' : '' }}>AB</option>
                                          <option value="NL" {{ session('contact.parent_1_province')=="NL" ? 'selected='.'"'.'selected'.'"' : '' }}>NL</option>
                                        </select>
                                       
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
                                        <input id="parent_1_postal" type="text" class="form-control" name="parent_1_postal" required value="{{session('contact.parent_1_postal')}}">

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
                                        <input id="parent_1_home_tel" type="tel" class="form-control" name="parent_1_home_tel" maxlength="10" value="{{session('contact.parent_1_home_tel')}}">

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
                                        <input id="parent_1_work_tel" type="tel" class="form-control" name="parent_1_work_tel" maxlength="10" value="{{session('contact.parent_1_work_tel')}}">

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
                                        <input id="parent_1_cell_phone" type="tel" class="form-control" name="parent_1_cell_phone" required maxlength="10" value="{{session('contact.parent_1_cell_phone')}}">

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
                                        <input id="parent_2_name" type="text" class="form-control" name="parent_2_name" value="{{session('contact.parent_2_name')}}">

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
                                        <input id="parent_2_email" type="email" class="form-control" name="parent_2_email" value="{{session('contact.parent_2_email')}}">

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
                                        <input id="parent_2_address" type="text" class="form-control" name="parent_2_address" value="{{session('contact.parent_2_address')}}">

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
                                        <input id="parent_2_city" type="text" class="form-control" name="parent_2_city" value="{{session('contact.parent_2_city')}}">

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
                                        <select name="parent_2_province" class="form-control" >
                                          <option value="" {{ session('contact.parent_2_province')=="" ? 'selected='.'"'.'selected'.'"' : '' }}></option>  
                                          <option value="ON" {{ session('contact.parent_2_province')=="ON" ? 'selected='.'"'.'selected'.'"' : '' }}>ON</option>
                                          <option value="QC" {{ session('contact.parent_2_province')=="QC" ? 'selected='.'"'.'selected'.'"' : '' }}>QC</option>
                                          <option value="NS" {{ session('contact.parent_2_province')=="NS" ? 'selected='.'"'.'selected'.'"' : '' }}>NS</option>
                                          <option value="NB" {{ session('contact.parent_2_province')=="NB" ? 'selected='.'"'.'selected'.'"' : '' }}>NB</option>
                                          <option value="MB" {{ session('contact.parent_2_province')=="MB" ? 'selected='.'"'.'selected'.'"' : '' }}>MB</option>
                                          <option value="BC" {{ session('contact.parent_2_province')=="BC" ? 'selected='.'"'.'selected'.'"' : '' }}>BC</option>
                                          <option value="PE" {{ session('contact.parent_2_province')=="PE" ? 'selected='.'"'.'selected'.'"' : '' }}>PE</option>
                                          <option value="SK" {{ session('contact.parent_2_province')=="SK" ? 'selected='.'"'.'selected'.'"' : '' }}>SK</option>
                                          <option value="AB" {{ session('contact.parent_2_province')=="AB" ? 'selected='.'"'.'selected'.'"' : '' }}>AB</option>
                                          <option value="NL" {{ session('contact.parent_2_province')=="NL" ? 'selected='.'"'.'selected'.'"' : '' }}>NL</option>
                                        </select>
                                       
                                        @if ($errors->has('parent_2_province'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_2_province') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-6"> 
                                <div class="form-group{{ $errors->has('parent_2_province') ? ' has-error' : '' }}">
                                    <label for="parent_2_province" class="col-md-6 control-label">Province</label>
                                    <div class="col-md-6">
                                        <input id="parent_2_province" type="text" class="form-control" name="parent_2_province" value="{{session('contact.parent_2_province')}}">

                                        @if ($errors->has('parent_2_province'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_2_province') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> 
                            </div>   -->

                            <div class="col-md-6"> 
                                <div class="form-group{{ $errors->has('parent_2_postal') ? ' has-error' : '' }}">
                                    <label for="parent_2_postal" class="col-md-3 control-label">Postal Code</label>
                                    <div class="col-md-6">
                                        <input id="parent_2_postal" type="text" class="form-control" name="parent_2_postal" value="{{session('contact.parent_2_postal')}}">

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
                                        <input id="parent_2_home_tel" type="tel" class="form-control" name="parent_2_home_tel" maxlength="10" value="{{session('contact.parent_2_home_tel')}}">

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
                                        <input id="parent_2_work_tel" type="tel" class="form-control" name="parent_2_work_tel" maxlength="10" value="{{session('contact.parent_2_work_tel')}}">

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
                                        <input id="parent_2_cell_phone" type="tel" class="form-control" name="parent_2_cell_phone" maxlength="10" value="{{session('contact.parent_2_cell_phone')}}">

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
                                <select name="lives_with" class="form-control" >
                                  <option value="both parents" {{ session('contact.lives_with')=="both parents" ? 'selected='.'"'.'selected'.'"' : '' }}>both parents</option>
                                  <option value="parent1" {{ session('contact.lives_with')=="parent1" ? 'selected='.'"'.'selected'.'"' : '' }}>parent 1</option>
                                  <option value="parent2" {{ session('contact.lives_with')=="parent2" ? 'selected='.'"'.'selected'.'"' : '' }}>parent 2</option>
                                  <option value="guardian" {{ session('contact.lives_with')=="guardian" ? 'selected='.'"'.'selected'.'"' : '' }}>guardian</option>
                                  <option value="independent" {{ session('contact.lives_with')=="independent" ? 'selected='.'"'.'selected'.'"' : '' }}>independent</option>
                                  <option value="other" {{ session('contact.lives_with')=="other" ? 'selected='.'"'.'selected'.'"' : '' }}>other</option>
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
                                <input id="language" type="text" class="form-control" name="language" required value="{{session('contact.language')}}">

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
                                <input id="emerg_contact" type="text" class="form-control" name="emerg_contact" required value="{{session('contact.emerg_contact')}}">

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
                                <input id="emerg_contact_phone" type="tel" class="form-control" name="emerg_contact_phone" required value="{{session('contact.emerg_contact_phone')}}" maxlength="10">

                                @if ($errors->has('emerg_contact_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('emerg_contact_phone') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary center-block">
                                Save Contact Information and Next
                            </button>
                        </div>

               		</form>

           		</div>
			</div>
		</div>
	</div>
</div>
@endsection