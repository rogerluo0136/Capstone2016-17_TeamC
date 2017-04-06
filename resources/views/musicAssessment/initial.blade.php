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
    <h1>Music Therapy Assessment</h1>
    <p class="lead" style="width:80%; color: white;">
        Please select the assessment below and submit your form. A staff member will call you directly to schedule the assessment. After the assessment is completed, you may choose to have your child participate in a full season music program.  
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
			  <div class="progress-bar no-color" style="width: 25%; min-width: 2em;">
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
			
			<div class="well">
				@if(is_null($children))
					<h4>All of your child(ren) have registered for assessment. Please contact John Taylor for futher information.</h4>
				@else
					<form class="form-horizontal" role="form" method="POST" action="{{ URL::action('UserChildMusicAssessmentController@further', Auth::user()->id)}}">
						{!! csrf_field() !!}
						<div class="row">
							<div class="col-md-1">
								<h5>Child:</h5>
							</div>
							<div class="col-md-4">
								<select class="form-control" name="child_id">
									@foreach($children as $child)
										<option value="{{$child->id}}">{{$child->first_name}} {{$child->last_name}} </option>
									@endforeach
								</select>
							</div>
						</div>
						</br>
						<div class="panel panel-default">
							<div class="panel-heading">Music Therapy Assessment</div>
							<div class="panel-body">
								<p>Age: Up to 21</p>
								<p>Duration: 45 mins</p>
								<p>Price: $80 for any time of the year</p>
							</div>
						</div>
						<div class="form-group">
		                    <button type="submit" class="btn btn-primary center-block">
		                        Continue
		                    </button>
		            	</div>
					</form>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection