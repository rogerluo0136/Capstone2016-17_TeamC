@extends('layouts.form')

@section('content')
<center>
    <h1 class="page-title">Add Your Child’s Information</h1>
    <p class="lead" style="width:50%">
        Please enter your child’s information to access registration and account information. 
    </p>

</center>

 

<div class="container">
    
   
    <?php $user=Auth::user(); ?>
   
    

    <?php 
        $var = ($user->childs->pluck('id'));?>
            
        @if(is_null($var->first())) 
        <a  class="btn btn-warning center-block" href="{{ url('/home') }}" style="width: 25%">Add Child Later </a>
            <br>  
            
        @else
            @include('child.createinclude')
        @endif
        
       
            

	<div class="row" >
		<div class="col-md-10 col-md-offset-1">
           
			<div class="panel panel-default">
				<div class="panel-heading">Registrant Information</div>
				<div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ URL::action('UserChildController@store',[Auth::user()->id])}}">
                        {!! csrf_field() !!}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="first_name" class="control-label col-md-6">Child's First Name<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input id="first_name" type="text" class="form-control" name="first_name" value="{{ session('child.first_name') }}" required>

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
                                    <label for="last_name" class="col-md-4 control-label">Last Name<span class="text-danger">*</span></label>
                                    <div class="col-md-6">
                                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ session('child.last_name') }}" required>

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
                            <label for="dob" class="col-md-3 control-label">Date of Birth<span class="text-danger">*</span></label>
                            <div class="col-md-3">
                                <input id="dob" type="date" class="form-control" name="dob" value="{{session('child.dob')}}" min="1900-01-01" max="{{date("Y-m-d")}}" required>

                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('health_card') ? ' has-error' : '' }}">
                            <label for="health_card" class="col-md-3 control-label">Health Card Number<span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input id="health_card" type="text" class="form-control" name="health_card" maxlength="12" required placeholder="0000000000AA" value="{{session('child.health_card')}}">

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
                                <input id="family_physician" type="text" class="form-control" name="family_physician" value="{{session('child.family_physician')}}">

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
                                        <input type="tel" name="fam_physician_phone" class="form-control" maxlength="10" value="{{session('child.fam_physician_phone')}}"> 
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
                        <hr>

                        <div class="row">
                            <div class="col-md-5">
                                <h5>Are you a client of Holland Bloorview?<span class="text-danger">*</span></h5>
                            </div>

                            
                            <div class="col-md-1">
                                <div class="form-group{{ $errors->has('is_client') ? ' has-error' : '' }}">
                                    <div class="radio">
                                      <label>
                                        <input type="radio" name="is_client" id="is_client" value="no" {{ session('child.is_client')=="no" ? 'checked='.'"'.'checked'.'"' : '' }} >
                                        No
                                      </label>
                                    </div>
                                    <div class="radio">
                                      <label>
                                        <input type="radio" name="is_client" id="is_client" value="yes" {{ session('child.is_client')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }} >
                                        Yes
                                      </label>
                                    </div>

                                    @if ($errors->has('is_client'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_client') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                        <label for="department" class="col-md-5 control-label">If yes, which department</label>
                                        <div class="col-md-6">
                                        <input id="department" type="text" class="form-control" name="department" value="{{session('child.department')}}">

                                        @if ($errors->has('department'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('department') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <h5>Have you been in our programs before?<span class="text-danger">*</span></h5>
                            </div>
                            
                            <div class="col-md-1">
                                <div class="form-group {{ $errors->has('is_first_time') ? ' has-error' : '' }}">
                                    <div class="radio">
                                      <label>
                                        <input type="radio" name="is_first_time" id="is_first_time" value="yes" {{ session('child.is_first_time')=="yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                        No
                                      </label>
                                    </div>
                                    <div class="radio">
                                      <label>
                                        <input type="radio" name="is_first_time" id="is_first_time" value="no" {{ session('child.is_first_time')=="no" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                        Yes
                                      </label>
                                    </div>

                                    @if ($errors->has('is_first_time'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_first_time') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group{{ $errors->has('previous_program') ? ' has-error' : '' }}">
                                        <label for="previous_program" class="col-md-5 control-label">If yes, which programs</label>
                                        <div class="col-md-6">
                                        <input id="previous_program" type="text" class="form-control" name="previous_program" value="{{session('child.previous_program')}}">

                                        @if ($errors->has('previous_program'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('previous_program') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary center-block">
                                Save Registrant Information and Next
                            </button>`
                        </div>
               		</form>
                    
           

                    
           		</div>
			</div>
		</div>
	</div>
</div>
@endsection


