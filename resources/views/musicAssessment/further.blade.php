@extends('layouts.app')

@section('css')
<style type="text/css">
.no-color{
	background-color:inherit;
	color: black;
	border-left: 2px solid #4989bd;
}
</style>
@endsection

@section('content')
<center>
    <h1>Music Therapy Assessment - Further Registrant Information</h1>
    <p class="lead" style="width:80%; color: white;">
        We require more detailed further registrant information
		Please fill the form below.
    </p>
</center>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="progress">
			  <div class="progress-bar progress-bar-active" style="width: 25%; min-width: 2em;">
			    <span class="sr-only">25%  (active)</span>
			    Registrant Selection
			  </div>
			  <div class="progress-bar progress-bar-active" style="width: 25%; min-width: 2em;">
			    <span class="sr-only">25%  (info)</span>
			    Further Registrant Info
			  </div>
			  <div class="progress-bar no-color" style="width: 25%; min-width: 2em;">
			    <span class="sr-only">25%  (info)</span>
			    Payment
			  </div>
			  <div class="progress-bar no-color" style="width: 25%; min-width: 2em;">
			    <span class="sr-only">25%  (info)</span>
			    Confirmation
			  </div>
			</div>
		</div>
		@include('child.createinclude')
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Further Registrant Information</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ URL::action('UserChildMusicAssessmentController@store', Auth::user()->id)}}">
					{!! csrf_field() !!}
					<input type="hidden" name="child_id" class="form-control" value="{{$child_id}}">
						<div class="row">
							<div class="form-group">
	                            <label for="therapist" class="control-label col-md-3">Preferred therapist/teacher: </label>
	                            <div class="col-md-4">
	                                <select class="form-control" name="preferred_therapist_id">
	                                	@foreach($therapists as $therapist)
	                                		<option value="{{$therapist->id}}">{{$therapist->first_name}} {{$therapist->last_name}}</option>
	                                	@endforeach
	                                </select>
	                            </div>
	                        </div>
                        </div>
                        <div class="row">
							<div class="form-group">
	                            <label class="control-label col-md-3">Preferred instrument:</label>
	                            <div class="col-md-4">
	                                <select class="form-control" name="preferred_instrument">
	                                	<option value="piano">Piano</option>
	                                	<option value="piano">Guitar</option>
	                                	<option value="piano">Violin</option>
	                                	<option value="piano">Bass</option>
	                                </select>
	                            </div>
	                        </div>
                        </div>
                        <div class="row">
                        	<div class="">
                        	<h5 style="color:red">&nbsp;&nbsp;&nbsp;&nbsp;Available Appointment Day/Times: Tues – Fri (3:00-7:00pm), Sat – Sun (8:30am – 3:30pm)</h5>
                        	</div>
                        </div>

                        <!-- first choice-->
                        <div class="row">
							<div class="form-group">
	                            <label class="control-label col-md-3">Preferred Day/Time 1st Choice:</label>
	                            <div class="col-md-2">
	                                <select class="form-control" name="time_first_choice_1">
	                                	<option value="Tuesday">Tuesday</option>
	                                	<option value="Wednesday">Wednesday</option>
	                                	<option value="Thursday">Thursday</option>
	                                	<option value="Friday">Friday</option>
	                                	<option value="Saturday">Saturday</option>
	                                	<option value="Sunday">Sunday</option>
	                                </select>
	                            </div>
	                            <div class="col-md-2">
	                                <select class="form-control" name="time_first_choice_2">
	                                	<option value="3:00">3:00</option>
	                                	<option value="4:00">4:00</option>
	                                	<option value="5:00">5:00</option>
	                                	<option value="6:00">6:00</option>
	                                	<option value="7:00">7:00</option>
	                                	<option value="8:00">8:00</option>
	                                </select>
	                            </div>
	                            <div class="col-md-2">
	                                <select class="form-control" name="time_first_choice_3">
	                                	<option value="a.m">AM</option>
	                                	<option value="p.m">PM</option>
	                                </select>
	                            </div>
	                        </div>
                        </div>


                        <!--second choice-->
                        <div class="row">
							<div class="form-group">
	                            <label class="control-label col-md-3">Preferred Day/Time 2nd Choice:</label>
	                            <div class="col-md-2">
	                                <select class="form-control" name="time_second_choice_1">
	                                	<option value="Tuesday">Tuesday</option>
	                                	<option value="Wednesday">Wednesday</option>
	                                	<option value="Thursday">Thursday</option>
	                                	<option value="Friday">Friday</option>
	                                	<option value="Saturday">Saturday</option>
	                                	<option value="Sunday">Sunday</option>
	                                </select>
	                            </div>
	                            <div class="col-md-2">
	                                <select class="form-control" name="time_second_choice_2">
	                                	<option value="3:00">3:00</option>
	                                	<option value="4:00">4:00</option>
	                                	<option value="5:00">5:00</option>
	                                	<option value="6:00">6:00</option>
	                                	<option value="7:00">7:00</option>
	                                	<option value="8:00">8:00</option>
	                                </select>
	                            </div>
	                            <div class="col-md-2">
	                                <select class="form-control" name="time_second_choice_3">
	                                	<option value="a.m">AM</option>
	                                	<option value="p.m">PM</option>
	                                </select>
	                            </div>
	                        </div>
                        </div>


                        <!--third choice-->
                        <div class="row">
							<div class="form-group">
	                            <label class="control-label col-md-3">Preferred Day/Time 1st Choice:</label>
	                            <div class="col-md-2">
	                                <select class="form-control" name="time_third_choice_1">
	                                	<option value="Tuesday">Tuesday</option>
	                                	<option value="Wednesday">Wednesday</option>
	                                	<option value="Thursday">Thursday</option>
	                                	<option value="Friday">Friday</option>
	                                	<option value="Saturday">Saturday</option>
	                                	<option value="Sunday">Sunday</option>
	                                </select>
	                            </div>
	                            <div class="col-md-2">
	                                <select class="form-control" name="time_third_choice_2">
	                                	<option value="3:00">3:00</option>
	                                	<option value="4:00">4:00</option>
	                                	<option value="5:00">5:00</option>
	                                	<option value="6:00">6:00</option>
	                                	<option value="7:00">7:00</option>
	                                	<option value="8:00">8:00</option>
	                                </select>
	                            </div>
	                            <div class="col-md-2">
	                                <select class="form-control" name="time_third_choice_3">
	                                	<option value="a.m">AM</option>
	                                	<option value="p.m">PM</option>
	                                </select>
	                            </div>
	                        </div>
                        </div>
                        <div class="form-group">
		                    <button type="submit" class="btn btn-primary center-block">
		                        Continue
		                    </button>
		            	</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection